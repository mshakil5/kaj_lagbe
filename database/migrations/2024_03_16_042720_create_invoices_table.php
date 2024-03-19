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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id')->nullable();
            $table->foreign('work_id')->references('id')->on('works')->onDelete('cascade');
            $table->string('invoiceid')->nullable();
            $table->string('date')->nullable();
            $table->decimal('amount', 10, 2)->default(0)->nullable();
            $table->string('img')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
