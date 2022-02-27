<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task_title');
            $table->longText('task_description')->nullable();
            $table->date('deadline');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
