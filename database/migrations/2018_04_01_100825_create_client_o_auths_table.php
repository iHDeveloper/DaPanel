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
            $table->string('client_id');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->string('state');
            $table->string('code');
            $table->string('panel_id');
            $table->string('type');
            $table->macAddress('ip');
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
