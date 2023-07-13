<?php

namespace App\Actions;

use App\Concerns\Validation;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleAction
{
    use Validation;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getQuery()
    {
        // $query = LKS::query();
        // $query->where('office_id', $this->request->user()->office_id);
        // $query->latest();

        // return $query;
    }

    public function create(): bool
    {
        $filteredRequest = $this->validate($this->request->all(), $this->rules());

        $this->people = new People();
        $this->people->nik = $filteredRequest['nik'];
        $this->people->family_card_number = $filteredRequest['family_card_number'];
        $this->people->name = $filteredRequest['name'];
        $this->people->date_of_birth = $filteredRequest['date_of_birth'];
        $this->people->place_of_birth = $filteredRequest['place_of_birth'];
        $this->people->married_status = $filteredRequest['married_status'];
        $this->people->address = $filteredRequest['address'];
        $this->people->phone_number = $filteredRequest['phone_number'];
        $this->people->religion = $filteredRequest['religion'];
        $this->people->gender = $filteredRequest['gender'];
        $this->people->job = $filteredRequest['job'];
        $this->people->account = 0;

        $result = $this->people->save();
        return $result;
    }

    public function update($people): bool{
        $filteredRequest = collect($this->validate($this->request->all(), $this->rules($people)));

        $people->family_card_number = $filteredRequest['family_card_number'];
        $people->nik = $filteredRequest['nik'];
        $people->name = $filteredRequest['name'];
        $people->date_of_birth = $filteredRequest['date_of_birth'];
        $people->place_of_birth = $filteredRequest['place_of_birth'];
        $people->married_status = $filteredRequest['married_status'];
        $people->address = $filteredRequest['address'];
        $people->phone_number = $filteredRequest['phone_number'];
        $people->religion = $filteredRequest['religion'];
        $people->gender = $filteredRequest['gender'];
        $people->job = $filteredRequest['job'];

        $result = $people->save();
        return $result;
    }

    private function rules(?People $people = null): array
    {
        return [
            'name' => 'required',
            'nik' => 'required|max_digits:16|unique:peoples,nik,' . $people?->id,
            'family_card_number' => 'required|max_digits:16|unique:peoples,family_card_number,' . $people?->id,
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'married_status' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'job' => 'required',
        ];
    }
}
