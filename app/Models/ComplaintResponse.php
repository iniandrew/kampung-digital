<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintResponse extends Model
{
    use HasFactory;

    protected $table = 'complaint_responses';

    protected $fillable = [
        'content',
        'attachment',
        'complaint_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaint_id', 'id');
    }

    public function proof(): Attribute
    {
        return new Attribute(fn () => url('storage/' . $this->attachment));
    }
}
