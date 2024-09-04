<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_number')->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->tinyInteger('type')->index();

            $table->date('scheduled_date')->index();
            $table->time('scheduled_time')->index();

            $table->string('patient_name');
            $table->string('patient_phone');
            $table->tinyInteger('gender');
            $table->string('email');
            $table->date('dob');
            $table->boolean('is_saudi')->default(1);
            $table->string('national_id')->nullable();
            $table->string('residency_number')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
