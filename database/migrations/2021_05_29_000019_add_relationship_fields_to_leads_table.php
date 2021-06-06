<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeadsTable extends Migration
{
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->unsignedBigInteger('assign_user_id')->nullable();
            $table->foreign('assign_user_id', 'assign_user_fk_3305984')->references('id')->on('users');
            $table->unsignedBigInteger('assign_client_id')->nullable();
            $table->foreign('assign_client_id', 'assign_client_fk_3305985')->references('id')->on('clients');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3305987')->references('id')->on('statuses');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3305992')->references('id')->on('users');
        });
    }
}
