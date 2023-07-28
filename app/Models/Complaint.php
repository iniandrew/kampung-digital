<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Complaint extends Model
{
    use HasFactory;

    PUBLIC CONST STATUS_NEED_REVIEW = 'need_review';
    PUBLIC CONST STATUS_IN_PROGRESS = 'in_progress';
    PUBLIC CONST STATUS_CLOSED = 'closed';
    PUBLIC CONST STATUS_REJECTED = 'rejected';

    protected $table = 'complaints';

    protected $fillable = [
        'title',
        'content',
        'attachment',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function response(): HasOne
    {
        return $this->hasOne(ComplaintResponse::class, 'complaint_id', 'id');
    }

    public function proof(): Attribute
    {
        return new Attribute(fn () => url('storage/' . $this->attachment));
    }
}
