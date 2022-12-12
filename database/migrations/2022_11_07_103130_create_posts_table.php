<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 150);
            $table->text("shortContent");
            $table->text("content");
            $table->integer("status");
            $table->integer('hot')->nullable();
            $table->string("thumbnail", 200);
            $table->unsignedBigInteger("author_id");
            $table->unsignedBigInteger("approved_id")->nullable();
            $table->foreignId('cate_id')->constrained('categories');
            $table->dateTime("created_date");
            $table->dateTime("approved_date")->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
