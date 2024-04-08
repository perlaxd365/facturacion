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

            $table->string('tipoOperacion')->nullable();
            
            $table->string('tipoDoc');
            $table->string('serie');
            $table->string('correlativo');

            $table->date('fechaEmision');


            $table->string('tipDocAfectado')->nullable();
            $table->string('numDocfectado')->nullable();
            $table->string('codMotivo')->nullable();
            $table->string('desMotivo')->nullable();


            $table->json('formaPago')->nullable();
            $table->json('cuotas')->nullable();

            $table->string('tipoMoneda');

            $table->json('company');

            $table->json('client');

            //Montos
            $table->float('mtoOperGravadas')->default(0);
            $table->float('mtoOperExoneradas')->default(0);
            $table->float('mtoOperInafectas')->default(0);
            $table->float('mtoOperExportacion')->default(0);
            $table->float('mtoOperGratuitas')->default(0);
            $table->float('mtoBaseIvap')->default(0);

            //Impuestos
            $table->float('mtoIGV')->default(0);
            $table->float('mtoIGVGratuitas')->default(0);
            $table->float('mtoIvap')->default(0);
            $table->float('icbper')->default(0);
            $table->float('totalImpuestos')->default(0);

            //Totales
            $table->float('valorVenta')->default(0);
            $table->float('subTotal')->default(0);
            $table->float('redondeo')->default(0);
            $table->float('mtoImpVenta')->default(0);

            $table->json('anticipos')->nullable();

            $table->json('detraccion')->nullable();

            $table->json('details');
            $table->json('legends');

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
            $table->foreignId('branch_id')
                ->constrained()
                ->onDelete('cascade');

            $table->boolean('production')->default(false);

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
