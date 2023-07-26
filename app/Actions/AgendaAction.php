<?php

namespace App\Actions;

use App\Concerns\Validation;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaAction
{
    use Validation;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $this->agenda = new Agenda();
        $this->agenda->user_id = $filteredRequest['user_id'];
        $this->agenda->title = $filteredRequest['title'];
        $this->agenda->content = $filteredRequest['content'];
        $this->agenda->start_date = $filteredRequest['start_date'];
        $this->agenda->end_date = $filteredRequest['end_date'];
        $this->agenda->venue_status = $filteredRequest['venue_status'];
        $this->agenda->status = $filteredRequest['status'];

        $result = $this->agenda->save();
        return $result;
    }

    public function update($agenda): bool{
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($agenda)));

        $agenda->user_id = $filteredRequest['user_id'];
        $agenda->title = $filteredRequest['title'];
        $agenda->content = $filteredRequest['content'];
        $agenda->start_date = $filteredRequest['start_date'];
        $agenda->end_date = $filteredRequest['end_date'];
        $agenda->venue_status = $filteredRequest['venue_status'];
        $agenda->status = $filteredRequest['status'];

        $result = $agenda->save();
        return $result;
    }

    private function rules(?agenda $agenda = null): array
    {
        return [
            'user_id' => 'required',
            'title' => 'required|max_digits:16|unique:agenda,title,' . $agenda?->id,
            'content' => 'required|max_digits:16|unique:agenda,content,' . $content?->id,
            'start_date' => 'required|date',
            'end_date' => 'end_date',
            'venue_status' => 'required',
            'status' => 'required',
        ];
    }
}
