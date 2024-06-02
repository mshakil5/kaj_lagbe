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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('orderid')->nullable();
            $table->string('date')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address_first_line')->nullable();
            $table->string('address_second_line')->nullable();
            $table->string('address_third_line')->nullable();
            $table->string('town')->nullable();
            $table->longText('post_code')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->where('is_type', 2)->onDelete('cascade');
            $table->boolean('status')->default(1);
            //1 = new, 2 = in progress, 3 = completed, 4 = cancelled
            $table->boolean('is_new')->default(1);
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
