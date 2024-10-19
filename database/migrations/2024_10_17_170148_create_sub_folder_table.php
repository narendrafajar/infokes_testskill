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
        Schema::create('sub_folder', function (Blueprint $table) {
            $table->id();
            $table->text('sub_folder_image');
            $table->foreignId('main_folder_id')->nullable()->constrained('main_folder');
            $table->integer('parent_folder')->default(0);
            $table->string('sub_folder_name')->default('New Folder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_folder');
    }
};
