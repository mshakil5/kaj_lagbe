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
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->unsignedBigInteger('work_id')->nullable(); 
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('staff_id')->references('id')->on('users')->where('is_type', 2)->onDelete('cascade');
            $table->foreign('work_id')->references('id')->on('works')->onDelete('cascade');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
