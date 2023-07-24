<?php

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->string('attachment')->nullable();
            $table->enum('status', [Complaint::STATUS_NEED_REVIEW, Complaint::STATUS_IN_PROGRESS, Complaint::STATUS_REVISION, Complaint::STATUS_REJECTED, Complaint::STATUS_CLOSED])->default(Complaint::STATUS_NEED_REVIEW);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
