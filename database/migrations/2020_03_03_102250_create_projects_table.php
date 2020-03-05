<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->date('realisation_date');
            $table->enum('status', ['WAITING', 'IN_PROGRESS', 'DONE'])->default('WAITING');
            $table->string('client_name');
            $table->string('contact_firstname');
            $table->string('contact_lastname');
            $table->string('contact_phone_number');
            $table->float('budget_min');
            $table->float('budget_max');
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('users');
            $table->unsignedBigInteger('referent_id');
            $table->foreign('referent_id')->references('id')->on('users');
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
        Schema::dropIfExists('projects');
    }
}
