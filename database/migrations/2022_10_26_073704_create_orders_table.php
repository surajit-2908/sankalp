<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->string('company_name_id')->nullable();
            $table->string('quantity', 10)->nullable();
            $table->string('order_confirmed', 20)->nullable();
            $table->string('order_confirmed_items', 20)->nullable();
            $table->text('order_confirmed_remarks')->nullable();
            $table->string('production', 20)->nullable();
            $table->string('production_items', 20)->nullable();
            $table->text('production_remarks')->nullable();
            $table->string('packaging', 20)->nullable();
            $table->string('packaging_items', 20)->nullable();
            $table->text('packaging_remarks')->nullable();
            $table->string('delivery', 20)->nullable();
            $table->string('delivery_items', 20)->nullable();
            $table->text('delivery_remarks')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
