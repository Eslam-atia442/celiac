<?php

use App\Enums\BooleanEnum;
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
        Schema::create('medical_consulting', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('civil_id')->nullable();
            $table->date('birthdate')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->text('consulting')->nullable();
            $table->text('reply_message')->nullable();
            $table->boolean('is_reply')->default(BooleanEnum::false);
            $table->foreignId('reply_user_id')->nullable()->constrained('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_consulting');
    }
};
