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
        Schema::create('document_identity_operation', function (Blueprint $table) {
            $table->id();

            $table->string('document_id');
            $table->foreign('document_id')
                ->references('id')
                ->on('documents');

            $table->string('identity_id');
            $table->foreign('identity_id')
                ->references('id')
                ->on('identities');
            
            $table->string('operation_id');
            $table->foreign('operation_id')
                ->references('id')
                ->on('operations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_identity_operation');
    }
};
