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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('google_id');
            $table->string('google_token');
            $table->string('google_refresh_token')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user'); // user atau admin
            $table->string('user_id', 8)->unique(); // ID random 8 digit
            $table->rememberToken();
            // $table->timestamp('last_absent_at')->nullable();
            $table->timestamps();
        });
    }

    // put cara run dekremmah?
    // terminal
    //php artisan serve?yes bik npm run dev, oke
// oke

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
