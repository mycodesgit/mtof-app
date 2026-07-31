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
        Schema::create('appname', function (Blueprint $table) {
            $table->id();
            $table->string('application_headername')->default('App Name');
            $table->text('application_fullname')->default('Municipal Tricycle Operators Franchising System');
            $table->text('application_desc')->default('The official management platform for municipal tricycle franchise operations — records, permits, fees, and compliance tracking in one secure workspace.');
            $table->text('application_about')->nullable();
            $table->string('application_category')->default('LOCAL GOVERNMENT UNIT');
            $table->string('application_email')->nullable();
            $table->string('application_contactno')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appname');
    }
};
