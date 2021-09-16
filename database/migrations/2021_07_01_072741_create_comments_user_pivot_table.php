<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comments_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->index('comments_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments_user_pivot');
    }
}
