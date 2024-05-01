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
            $table->string('email')->unique();
            $table->string('password');
            $table->date('DOB');
            $table->unsignedBigInteger('Designation_Id')->nullable();
            $table->unsignedBigInteger('Role_Id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('Designation_Id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('Role_Id')->references('id')->on('roles')->onDelete('cascade');
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
