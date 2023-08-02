<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fund extends Model
{
    use HasFactory;

    PUBLIC CONST INCOME = 'Pemasukan';
    PUBLIC CONST OUTCOME = 'Pengeluaran';

    protected $table = 'funds';

    protected $fillable = [
        'category',
        'body',
        'amount',
        'transaction_date',
        'attachment',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
