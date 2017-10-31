<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 140)->nullable();
            $table->text('description')->nullable();
            $table->string('format')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('wip')->default( false );
            $table->string('colors')->nullable();
            $table->longText('decklist')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('cardcount')->nullable();
            $table->integer('views')->nullable();
            $table->integer('likes')->nullable();
            $table->timestamps();

            // add foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decks');
    }
}
