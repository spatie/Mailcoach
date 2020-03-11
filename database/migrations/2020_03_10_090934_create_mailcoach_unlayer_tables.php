<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailcoachUnlayerTables extends Migration
{
    public function up()
    {
        Schema::create('mailcoach_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('mailcoach_campaign_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('upload_id');
            $table->timestamps();

            $table
                ->foreign('campaign_id')
                ->references('id')->on('mailcoach_campaigns')
                ->onDelete('cascade');

            $table
                ->foreign('upload_id')
                ->references('id')->on('mailcoach_uploads')
                ->onDelete('cascade');
        });

        Schema::create('mailcoach_template_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('upload_id');
            $table->timestamps();

            $table
                ->foreign('template_id')
                ->references('id')->on('mailcoach_templates')
                ->onDelete('cascade');

            $table
                ->foreign('upload_id')
                ->references('id')->on('mailcoach_uploads')
                ->onDelete('cascade');
        });
    }
}
