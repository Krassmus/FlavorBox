<?php

class InitPlugin extends Migration {
    
    public function up() {
        DBManager::get()->exec("
            CREATE TABLE `flavorbox_courseinfo` (
                `seminar_id` varchar(32) NOT NULL DEFAULT '',
                `header_font` varchar(60) DEFAULT NULL,
                `body_font` varchar(60) DEFAULT NULL,
                `background` varchar(128) DEFAULT NULL,
                `css` text,
                `box_id` varchar(32) DEFAULT NULL,
                `chdate` int(11) DEFAULT NULL,
                `mkdate` int(11) DEFAULT NULL,
                PRIMARY KEY (`seminar_id`)
            ) ENGINE=InnoDB
        ");
    }

    public function down() {
        DBManager::get()->exec("
            DROP TABLE `flavorbox_courseinfo`
        ");
    }

}