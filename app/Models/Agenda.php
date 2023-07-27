<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    public const TITLE_KERJA_BAKTI = 'Kerja Bakti';
    public const TITLE_MAKAN = 'Makan';
    public const TITLE_KONDANGAN = 'Kondangan';
    public const TITLE_LOMBA = 'Lomba';
    public const TITLE_KARANG_TARUNA = 'Karang Taruna';
    public const TITLE_PENTAS_SENI = 'Pentas Seni';

    public const STATUS_DONE = 'Sudah';
    public const STATUS_NOT_YET = 'Belum';

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
