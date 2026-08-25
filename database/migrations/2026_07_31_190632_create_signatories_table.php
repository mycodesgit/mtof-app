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
        Schema::create('signatories', function (Blueprint $table) {
            $table->id();
            $table->string('sigfname');
            $table->string('sigmname')->nullable();
            $table->string('siglname');
            $table->string('sigext')->nullable();
            $table->foreignId('sigposition')->constrained('positions');
            $table->foreignId('postedBy')->constrained('users');
            $table->enum('status', ['1', '2'])->default('1');
            $table->string('formassign')->nullable();
            $table->enum('signatory_role', ['Processed', 'Verified', 'Noted'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatories');
    }
};
