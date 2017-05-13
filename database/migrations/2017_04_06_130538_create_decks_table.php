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
            $table->integer('owner_id')->nullable();
            $table->integer('views')->nullable();
            $table->integer('likes')->nullable();
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
        Schema::dropIfExists('decks');
    }
}
