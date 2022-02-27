<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('assign_user_id')->nullable();
            $table->foreign('assign_user_id', 'assign_user_fk_3305962')->references('id')->on('users');
            $table->unsignedBigInteger('assign_client_id')->nullable();
            $table->foreign('assign_client_id', 'assign_client_fk_3305963')->references('id')->on('clients');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3305965')->references('id')->on('statuses');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3305969')->references('id')->on('users');
        });
    }
}
