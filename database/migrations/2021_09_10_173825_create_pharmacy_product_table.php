<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('pharmacy_id');
            $table->boolean('status')->default(0);
            $table->integer('quantity')->default(0);
            $table->float('price')->default(0);
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
            $table->unique(['product_id', 'pharmacy_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pharmacy_product');
    }
}
