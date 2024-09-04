<?php

use App\Enums\CeliacCardStatusEnum;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('celiac_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->tinyInteger('status')->index()->default(CeliacCardStatusEnum::pending->value);
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->date('dob');
            $table->boolean('is_saudi');
            $table->string('residency_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address');
            $table->tinyInteger('gender');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celiac_cards');
    }
};
