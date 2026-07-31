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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('brgy')->nullable();
            $table->string('tin_no')->nullable();

            // Vehicle Information
            $table->string('mtof_make')->nullable();
            $table->string('mtof_color')->nullable();
            $table->string('mtof_cc')->nullable();
            $table->string('motor_no')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('body_no')->nullable();
            $table->string('route_no')->nullable();
            $table->string('color_code')->nullable();

            // Registration Details
            $table->string('cr_no')->nullable();
            $table->string('or_no')->nullable();
            $table->date('or_date')->nullable();
            $table->date('date_acq')->nullable();
            $table->date('valid')->nullable();

            // Driver Information
            $table->string('drivers_name')->nullable();
            $table->string('driver_license')->nullable();

            // Other Details
            $table->string('mtof_id')->nullable();
            $table->string('p_name')->nullable();
            
            $table->string('status')->nullable();
            $table->string('status1')->nullable();

            $table->date('date_issued')->nullable();
            $table->date('date_expired')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
