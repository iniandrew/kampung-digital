<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    public const RELIGION_ISLAM = 'Islam';
    public const RELIGION_PROTESTANT = 'Kristen Protestan';
    public const RELIGION_CATHOLIC = 'Kristen Katolik';
    public const RELIGION_HINDU = 'Hindu';
    public const RELIGION_BUDDHA = 'Buddha';
    public const RELIGION_KONGHUCU = 'Konghucu';

    public const GENDER_MALE = 'Laki-Laki';
    public const GENDER_FEMALE = 'Perempuan';

    public const STATUS_MARRIED = "Menikah";
    public const STATUS_SINGLE = "Lajang";

    protected $table = "peoples";

    protected $fillable = [
        "nik",
        "family_card_number",
        "name",
        "date_of_birth",
        "place_of_birth",
        "married_status",
        "address",
        "phone_number",
        "religion",
        "gender",
        "job",
        "account"
    ];
}
