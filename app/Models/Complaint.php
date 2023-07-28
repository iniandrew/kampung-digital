<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
