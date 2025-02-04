<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRqSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rq_suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('req_quotation_id');
            $table->foreign('req_quotation_id')->references('req_quotation_id')->on('request_quotation');
            $table->string('supplier_id');
            $table->foreign('supplier_id')->references('supplier_id')->on('suppliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rq_suppliers', function(Blueprint $table) {
            $table->dropForeign('rq_suppliers_req_quotation_id_foreign');
            $table->dropForeign('rq_suppliers_supplier_id_foreign');
        });
        
        Schema::dropIfExists('rq_suppliers');
    }
}
