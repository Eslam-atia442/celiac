<?php

use App\Enums\FoodBasketRequestStatusEnum;
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
        Schema::create('food_basket_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->tinyInteger('status')->index()->default(FoodBasketRequestStatusEnum::pending->value);
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->date('dob');
            $table->boolean('is_saudi')->nullable();
            $table->string('identity_number')->nullable();

            $table->boolean('is_visitor')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('campaign_number')->nullable();
            $table->date('transaction_date')->nullable();

            $table->tinyInteger('gender');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_basket_requests');
    }
};
