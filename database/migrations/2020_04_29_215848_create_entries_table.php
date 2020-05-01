<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            // $table->engine = 'InnoDB'; // TODO 必要？
            $table->bigIncrements('id');
            $table->string('power_phrase')->nullable(false)->default('');
            $table->string('source')->nullable(false)->default('');
            // $table->text('episode'); // textにはデフォルト値を設定できない
            $table->string('episode', 1000)->nullable(false)->default('');
            // $table->integer('user_id')->unsigned(); // TODO 必要？
            $table->integer('user_id')->nullable(false)->default(0);
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users'); //外部キー制約　TODO エラーになる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
