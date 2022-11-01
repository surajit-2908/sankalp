<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('key_person')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('industry')->nullable();
            $table->text('enquiry')->nullable();
            $table->enum('enquiry_status', ['1','0'])->default('1');
            $table->enum('order_status', ['1','0'])->default('1');
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
        Schema::dropIfExists('enquiries');
    }
}
