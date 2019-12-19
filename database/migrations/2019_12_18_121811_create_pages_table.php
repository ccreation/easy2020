<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("client_id");
            $table->integer("user_id");
            $table->integer("website_id")->default(0);
            $table->string("slug");
            $table->string("name")->nullable();
            $table->string("name_en")->nullable();
            $table->integer("status")->default(0);
            $table->longText("html_content_ar")->nullable();
            $table->longText("html_content_en")->nullable();
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
        Schema::dropIfExists('pages');
    }
}
