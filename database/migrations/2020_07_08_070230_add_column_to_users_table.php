<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('slack_id');
            $table->renameColumn('name', 'user_name');
            $table->integer('introduced_count');
            $table->boolean('introduced_last_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['slack_id', 'introduced_count', 'introduced_last_time']);
            $table->renameColumn('user_name', 'name');
        });
    }
}
