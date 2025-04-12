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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->integer('country_code')->nullable()->default(0);
            $table->string('mobile_number', 50)->nullable();
            $table->string('profile_photo', 255)->nullable();
            $table->string('password', 255);
            $table->string('remember_token', 255)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->timestamp('last_login_at')->nullable();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
