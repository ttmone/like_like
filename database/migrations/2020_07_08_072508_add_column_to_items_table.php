<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            // 従来の記法
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('theme_id');
            $table->foreign('theme_id')->references('id')->on('themes');
            // 簡潔なメソッド、らしいけどエラーで動かず。
            // $table->foreign('user_id')->constrained();
            // $table->foreign('theme_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_theme_id_foreign');
            $table->dropForeign('items_user_id_foreign');
            $table->dropColumn(['theme_id', 'user_id']);
        });
        Schema::enableForeignKeyConstraints();
    }
}
