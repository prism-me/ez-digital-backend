<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('web_url');
            $table->string('cms_url')->nullable();
            $table->string('cpanel_url')->nullable();
            $table->string('cms_username')->nullable();
            $table->string('cms_password')->nullable();
            $table->string('cpanel_username')->nullable();
            $table->string('cpanel_password')->nullable();
            $table->integer('site_id')->nullable();
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
        Schema::dropIfExists('project');
    }
}
