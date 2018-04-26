<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientOAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_o_auths', function (Blueprint $table) {
            $table->increments('id');
            $table->macAddress('ip');
            $table->string('clientid');
            $table->string('type');
            $table->uuid('state');
            $table->uuid('token');
            $table->string('panel_id');
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
        Schema::dropIfExists('client_o_auths');
    }
}
