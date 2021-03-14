<?php

require_once('cli.php');

$persistence = new system\mvc\Persistence();

$database = app_config('database','database');

$sql[0] = "CREATE DATABASE IF NOT EXISTS `{$database}` DEFAULT CHARACTER SET = 'utf8' DEFAULT COLLATE 'utf8_general_ci'";
$sql[1] = "USE " . $database;
$sql[2] = "DROP TABLE IF EXISTS `products`";
$sql[3] = "CREATE TABLE `{$database}`.`products` (
        `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(50) NOT NULL,
        `sku` VARCHAR(50) NOT NULL,
        `price` DECIMAL(15,2) NOT NULL DEFAULT 00.00,
        `description` VARCHAR(100) NOT NULL,
        `amount` INT NOT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
        UNIQUE INDEX `sku_UNIQUE` (`sku` ASC) VISIBLE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8;";

$sql[4] = "DROP TABLE IF EXISTS `categories`";	
$sql[5] = "CREATE TABLE `{$database}`.`categories` (
        `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `code` VARCHAR(45) NOT NULL,
        `name` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
        UNIQUE INDEX `code_UNIQUE` (`code` ASC) VISIBLE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8;";

$sql[6] = "DROP TABLE IF EXISTS `products_vs_categories`";	
$sql[7] = "CREATE TABLE `webjump`.`products_vs_categories` (
        `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_categories` BIGINT(20) UNSIGNED NOT NULL,
        `id_products` BIGINT(20) UNSIGNED NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
        INDEX `fk_categories_idx` (`id_categories` ASC) VISIBLE,
        INDEX `fk_products_idx` (`id_products` ASC) VISIBLE,
        CONSTRAINT `fk_categories`
            FOREIGN KEY (`id_categories`)
            REFERENCES `webjump`.`categories` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        CONSTRAINT `fk_products`
            FOREIGN KEY (`id_products`)
            REFERENCES `webjump`.`products` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8;";


foreach($sql as $stm)	
    $persistence->queryApply($stm);
