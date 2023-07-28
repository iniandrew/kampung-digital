<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    public const STATUS_ARCHIVE = 'arsip';
    public const STATUS_COMMING_SOON = 'segera';
    public const STATUS_DONE = 'selesai';

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
