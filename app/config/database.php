<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$sql = <<<SQL
    CREATE TABLE IF NOT EXISTS `user` (
        `user_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `dir_name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `pwd` VARCHAR(255) NOT NULL,
        `role` VARCHAR(255) NOT NULL,
        `cookie` VARCHAR(255) NOT NULL DEFAULT '',
        `time_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `is_delete` TINYINT(1) NOT NULL DEFAULT 0
    );

    CREATE TABLE IF NOT EXISTS `user_lang` (
        `user_id` INT(11) NOT NULL,
        `user_name` VARCHAR(255) NOT NULL,
        `real_name` VARCHAR(255) NOT NULL DEFAULT '',
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `public_lang` (
        `user_id` INT(11) NOT NULL,
        `address` VARCHAR(255) NOT NULL DEFAULT '',
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `artist_lang` (
        `user_id` INT(11) NOT NULL,
        `approve` TINYINT(1) NOT NULL DEFAULT 0,
        `description` TEXT NOT NULL DEFAULT '',
        `img_path` VARCHAR(255) NOT NULL DEFAULT '',
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `rec_center` (
        `center_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `center_name` VARCHAR(255) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS `recyclable` (
        `rec_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT(11) NOT NULL,
        `dir_name` VARCHAR(255) NOT NULL,
        `center_id` INT(11) NOT NULL,
        `rec_status` VARCHAR(255) NOT NULL,
        `rec_point` INT(11) NOT NULL DEFAULT 0,
        `rec_time` TIMESTAMP NOT NULL,
        `time_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `is_delete` TINYINT(1) NOT NULL DEFAULT 0,
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (`center_id`) REFERENCES `rec_center`(`center_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `rec_lang` (
        `rec_id` INT(11) NOT NULL,
        `rec_name` VARCHAR(255) NOT NULL,
        `weight` FLOAT NOT NULL,
        `img_path` VARCHAR(255) NOT NULL,
        FOREIGN KEY (`rec_id`) REFERENCES `recyclable`(`rec_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `orders` (
        `order_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT(11) NOT NULL,
        `order_status` VARCHAR(255) NOT NULL,
        `rec_point_used` INT(11) NOT NULL DEFAULT 0,
        `time_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `product` (
        `prod_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `user_id` INT(11) NOT NULL,
        `dir_name` VARCHAR(255) NOT NULL,
        `price` FLOAT NOT NULL,
        `quantity` INT(11) NOT NULL,
        `time_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `is_delete` TINYINT(1) NOT NULL DEFAULT 0,
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `prod_lang` (
        `prod_id` INT(11) NOT NULL,
        `prod_name` VARCHAR(255) NOT NULL,
        `description` TEXT NOT NULL,
        `img_path` VARCHAR(255) NOT NULL,
        FOREIGN KEY (`prod_id`) REFERENCES `product`(`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `order_item` (
        `order_item_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `order_id` INT(11) NOT NULL,
        `prod_id` INT(11) NOT NULL,
        `quantity` INT(11) NOT NULL,
        FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (`prod_id`) REFERENCES `product`(`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );

    CREATE TABLE IF NOT EXISTS `cart` (
        `prod_id` INT(11) NOT NULL,
        `user_id` INT(11) NOT NULL,
        `quantity` INT(11) NOT NULL,
        `time_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`prod_id`) REFERENCES `product`(`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );
SQL;
