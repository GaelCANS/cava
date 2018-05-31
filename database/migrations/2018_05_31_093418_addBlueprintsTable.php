<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlueprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blueprints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('intro');
            $table->smallInteger('note_min');
            $table->smallInteger('note_max');
            $table->date('begin');
            $table->date('end');
            $table->text('emails');
            $table->integer('user_id');
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
        Schema::drop('blueprints');
    }
}
