<?php

use App\Enums\JobRequestStatusEnum;
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
        Schema::create('job_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->tinyInteger('status')->index()->default(JobRequestStatusEnum::pending->value);
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->date('dob');
            $table->boolean('is_saudi');
            $table->boolean('is_infected');
            $table->string('residency_number')->nullable();
            $table->string('national_id')->nullable();
            $table->tinyInteger('gender');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_requests');
    }
};
