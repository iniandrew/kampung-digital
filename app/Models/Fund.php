<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $table = 'funds';

    protected $fillable = [
        'category',
        'body',
        'amount',
        'transaction_date',
        'attachment',
        'user_id',
    ];
}
