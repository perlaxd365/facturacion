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
        Schema::create('guides', function (Blueprint $table) {
            $table->id();

            $table->string('tipoDoc');

            $table->string('serie');
            $table->string('correlativo');

            $table->date('fechaEmision');

            $table->json('company');
            $table->json('destinatario');
            $table->json('envio');
            $table->json('details');

            //Response
            $table->string('xml_path')->nullable();
            $table->string('hash')->nullable();
            $table->boolean('send_xml')->default(false);

            //Sunat response
            $table->boolean('sunat_success')->nullable();
            $table->json('sunat_error')->nullable();
            $table->string('sunat_cdr_path')->nullable();

            //cdrResponse
            $table->string('cdr_code')->nullable();
            $table->json('cdr_notes')->nullable();
            $table->string('cdr_description')->nullable();

            //PDF
            $table->string('pdf_path')->nullable();

            //Branch
            $table->foreignId('branch_id')->constrained();

            $table->boolean('production')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};
