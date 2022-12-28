<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('sub_cat_id')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->text('operation')->nullable();
            $table->text('feautres')->nullable();
            $table->text('special_options')->nullable();
            $table->text('technical_specifications')->nullable();
            $table->text('applications')->nullable();
            $table->text('brochure')->nullable();
            $table->text('youtube_link')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
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
        Schema::dropIfExists('products');
    }
}
