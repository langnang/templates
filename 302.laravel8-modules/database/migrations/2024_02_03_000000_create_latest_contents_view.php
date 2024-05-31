<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestContentsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            CREATE VIEW `_latest_contents` AS
            SELECT
                `u`.`id` AS `user_id`,
                `u`.`name` AS `user_name`,
                `r`.`id` AS `role_id`,
                `r`.`name` AS `role_name`
            FROM
                `users` `u`
            JOIN `roles` `r` ON `u`.`role_id` = `r`.`id`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("DROP VIEW IF EXISTS `_latest_contents`");
    }
}
