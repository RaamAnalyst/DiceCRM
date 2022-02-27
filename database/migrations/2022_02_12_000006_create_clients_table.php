<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_number');
            $table->string('gst_vat');
            $table->string('company_name');
            $table->string('address');
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('company_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
