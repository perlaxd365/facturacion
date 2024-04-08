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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('domain')->unique();
            $table->integer('regimen');
            
            $table->string('ruc')->unique();
            $table->string('razonSocial');
            $table->string('nombreComercial');
            
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('user_sol')->nullable();
            $table->string('password_sol')->nullable();
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
            $table->text('certificate')->nullable();
            $table->string('certificate_path')->nullable();

            $table->string('square_image_path')->nullable();
            $table->string('rectangle_image_path')->nullable();

            $table->boolean('production')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
