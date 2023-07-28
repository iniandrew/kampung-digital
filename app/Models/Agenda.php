<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    public const STATUS_ARCHIVE = 'Arsip';
    public const STATUS_COMMING_SOON = 'Segera';
    public const STATUS_DONE = 'Selesai';

    protected $table = 'agendas';

    protected $fillable = [
        'title',
        'content',
        'start_date',
        'end_date',
        'venue',
        'status',
        'user_id',
        'start_time',
        'end_time'
    ];

    protected $guarded = ['id'];
}
