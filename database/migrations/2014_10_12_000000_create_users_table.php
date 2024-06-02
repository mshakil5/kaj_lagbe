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
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('is_type')->default(0);
            /* Users: 0=>User, 1=>Admin, 2=>Staff */
            $table->string('phone')->nullable();
            $table->string('address_first_line')->nullable();
            $table->string('address_second_line')->nullable();
            $table->string('address_third_line')->nullable();
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('photo')->nullable();
            $table->string('about')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('whatsapp')->nullable();
            $table->boolean('status')->default(1);
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
