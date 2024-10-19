<?php

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
        Schema::create('content_folder', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_folder_id')->nullable()->constrained('main_folder');
            $table->foreignId('sub_folder_id')->nullable()->constrained('sub_folder');
            $table->string('name_content')->default('New File');
            $table->enum('type_content',['IMAGE','DOCUMENT'])->default('IMAGE');
            $table->text('content_location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_folder');
    }
};
