<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_lines', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('supplier_id')->nullable();
            $table->decimal('qty',10,0)->nullable();
            $table->string('description')->nullable();
            $table->decimal('line_price',10,2)->nullable();
            $table->decimal('line_net',10,2)->nullable();
            $table->decimal('line_tax',10,2)->nullable();
            $table->string('line_tax_exempt')->nullable();
            $table->decimal('line_total',10,2)->nullable();
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
        Schema::dropIfExists('purchases_lines');
    }
}
