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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('slug', 100)->unique();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('display_on_home')->default(0);
            $table->tinyInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes(); 

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
