<?php

namespace App\Actions;

use App\Concerns\HandleAttachment;
use App\Concerns\Validation;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintAction
{
    use Validation;
    use HandleAttachment;

    public function __construct(
        protected ?Request $request = null
    ) {
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
            'attachment' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $complaint->response()->create([
            'content' => $filteredRequest['content'],
            'attachment' => $this->storePhoto($this->request->file('attachment'), 500, 'complaints'),
            'user_id' => auth()->user()->id
        ]);

        $complaint->status = Complaint::STATUS_CLOSED;

        return $complaint->save();
    }

    private function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'status' => 'nullable|string|in:need_review,in_progress,revision,rejected,closed',
        ];
    }
}
