<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'title',
        'content',
        'start_date',
        'end_date',
        'venue',
        'status',
        'user_id',
    ];
}
