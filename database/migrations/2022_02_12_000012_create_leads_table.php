<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lead_title');
            $table->longText('lead_description')->nullable();
            $table->datetime('deadline');
            $table->string('qualified');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
