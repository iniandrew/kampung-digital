<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;
    protected $table = "danas";
    protected $fillable = [
        'users_id', 'kategori', 'rincian', 'bukti_nota', 'tanggal_transaksi', 'total', 'created_at', 'updated_at'
    ];

    protected $guarded = ['id'];
}
