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
        Schema::create('short_videos', function (Blueprint $table) {
            $table->id();
            $table->string("link", 30);
            $table->string("title", 450);
            $table->string("thumbnail", 300);
            $table->integer("status");
            $table->integer("hot")->nullable();
            $table->dateTime("approved_date")->nullable();
            $table->foreignId('cate_id')->constrained('categories');
            $table->foreignId('author_id')->constrained('users');
            $table->foreignId('approved_id')->constrained('users')->nullable();
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
        Schema::dropIfExists('short_videos');
    }
};
