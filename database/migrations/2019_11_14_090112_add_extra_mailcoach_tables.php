<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraMailcoachTables extends Migration
{
    public function up()
    {
        Schema::table('email_lists', function (Blueprint $table) {
            $table->string('redirect_after_already_subscribed')->nullable();
            $table->string('redirect_after_pending')->nullable();
            $table->string('redirect_after_subscribed')->nullable();
        });
    }
}
