<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Validator;

trait Validation
{
    public function validate(array $inputs, array $rules): array
    {
        return Validator::make($inputs, $rules)->validate();
    }
}
