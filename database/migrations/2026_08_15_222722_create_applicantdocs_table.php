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
        Schema::create('applicantdocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appID')->constrained('applicants')->onDelete('cascade');
            $table->foreignId('docID')->constrained('documents')->onDelete('cascade');
            $table->string('postedBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicantdocs');
    }
};
