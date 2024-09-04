<?php

use App\Enums\BooleanEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1=>scientific_research - 2=>translated_book - 3=> guidance_manual');
            $table->tinyInteger('file_type')->nullable()->comment('1=>general - 2=>Gluten sensitivity');
            $table->text('description')->nullable();
            $table->string('author_name')->nullable();
            $table->boolean('is_active')->default(BooleanEnum::true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_libraries');
    }
};
