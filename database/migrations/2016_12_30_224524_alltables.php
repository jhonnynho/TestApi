<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role_id');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('role');
        }); 

        Schema::create('tasks', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->date('due_date');
            $table->integer('assigned_to');
            $table->integer('created_by');
            $table->integer('priority');
        });

        Schema::create('priorities', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('roles');
        Schema::drop('tasks');
        Schema::drop('priorities');  
    }
}
