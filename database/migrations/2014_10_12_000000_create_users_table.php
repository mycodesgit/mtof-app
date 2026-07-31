<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['1', '2'])->default('1');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('ext')->nullable();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert default Superadmin user
        DB::table('users')->insert([
            'fname' => 'Super',
            'mname' => null,
            'lname' => 'Admin',
            'ext' => null,
            'username' => 'superadmin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => '1',
            'remember_token' => Str::random(60),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
