<?php

use App\Models\User;
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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('custom_name')->nullable();
            $table->string('name');
            $table->string('ext', 10);
            $table->string('url');
            $table->string('type')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('mime')->nullable();
            $table->string('duration')->nullable();
            $table->string('size')->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->longText('notes')->nullable();
            $table->nullableMorphs('fileable');
            $table->datetime('date')->nullable();
            $table->boolean("is_active")->default(BooleanEnum::true->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
