<?php

namespace App\Actions;

use App\Concerns\HandleAttachment;
use App\Concerns\Validation;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ComplaintAction
{
    use Validation;
    use HandleAttachment;

    public function __construct(
        protected ?Request $request = null
    ) {
    }

    public function getLatestComplaints(): Collection|array
    {
        $query = Complaint::query();

        if (auth()->user()?->isAdministrator()) {
            $query->where('status', Complaint::STATUS_NEED_REVIEW);
            $query->orWhere('status', Complaint::STATUS_IN_PROGRESS);
        }

        $query->where('status', Complaint::STATUS_IN_PROGRESS);
        $query->orWhere('status', Complaint::STATUS_CLOSED);

        return $query->latest()->limit(5)->get();
    }

    public function getAllComplaints(): Collection
    {
        $query = Complaint::query();

        if (! auth()->user()?->isAdministrator()) {
            $query->where('status', Complaint::STATUS_IN_PROGRESS);
            $query->orWhere('status', Complaint::STATUS_CLOSED);
        }

        return $query->get();
    }

    public function getComplaintByReporter(): Collection|array
    {
        $query = Complaint::query();
        $query->where('user_id', $this->request->user()->id);

        return $query->get();
    }

    public function create(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $complaint = new Complaint();
        $complaint->fill($filteredRequest);
        $complaint->user_id = $this->request->user()->id;

        if ($this->request->hasFile('attachment') ?? false) {
            $complaint->attachment = $this->storePhoto($this->request->file('attachment'), 500, 'complaints');
        }

        return $complaint->save();
    }

    public function edit(Complaint $complaint): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules($complaint));

        $complaint->fill($filteredRequest);

        if ($this->request->hasFile('attachment') ?? false) {
            $this->deleteAttachment($complaint->attachment);
            $complaint->attachment = $this->storePhoto($this->request->file('attachment'), 500, 'complaints');
        }

        return $complaint->save();
    }

    public function review(Complaint $complaint): bool
    {
        $filteredRequest = $this->validate($this->request->all(), [
            'review' => 'required|string|in:approve,reject',
        ]);

        $complaint->status = $filteredRequest['review'] === 'approve'
            ? Complaint::STATUS_IN_PROGRESS
            : Complaint::STATUS_REJECTED;

        return $complaint->save();
    }

    public function respond(Complaint $complaint): bool
    {
        $filteredRequest = $this->validate($this->request->all(), [
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $attachment = $this->request->hasFile('attachment')
            ? $this->storePhoto($this->request->file('attachment'), 500, 'complaints')
            : null;

        $complaint->response()->create([
            'content' => $filteredRequest['content'],
            'attachment' => $attachment,
            'user_id' => auth()->user()->id
        ]);

        $complaint->status = Complaint::STATUS_CLOSED;

        return $complaint->save();
    }

    private function rules(Complaint $complaint = null): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'file|mimes:png,jpg,jpeg|max:2048|' . ($complaint ? 'nullable' : 'required'),
            'status' => 'nullable|string|in:need_review,in_progress,revision,rejected,closed',
        ];
    }
}
