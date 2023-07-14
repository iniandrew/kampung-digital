<?php

use App\Models\People;
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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('family_card_number')->unique();
            $table->string('name');
            $table->string('date_of_birth');
            $table->string('place_of_birth');
            $table->enum('married_status', [People::STATUS_MARRIED, People::STATUS_SINGLE]);
            $table->string("address");
            $table->string("phone_number");
            $table->enum("religion", [People::RELIGION_ISLAM, People::RELIGION_PROTESTANT, People::RELIGION_CATHOLIC, People::RELIGION_BUDDHA, People::RELIGION_HINDU, People::RELIGION_KONGHUCU]);
            $table->enum("gender", [People::GENDER_MALE, People::GENDER_FEMALE]);
            $table->string("job");
            $table->boolean("account")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoples');
    }
};
