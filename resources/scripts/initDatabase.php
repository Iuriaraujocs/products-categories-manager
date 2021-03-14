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
        `img_path` VARCHAR(100), 
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
        `code` VARCHAR(50) NOT NULL,
        `name` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
        UNIQUE INDEX `code_UNIQUE` (`code` ASC) VISIBLE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8;";

$sql[6] = "DROP TABLE IF EXISTS `products_vs_categories`";	
$sql[7] = "CREATE TABLE `{$database}`.`products_vs_categories` (
        `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `id_category` BIGINT(20) UNSIGNED NOT NULL,
        `id_product` BIGINT(20) UNSIGNED NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
        INDEX `fk_category_idx` (`id_category` ASC) VISIBLE,
        INDEX `fk_product_idx` (`id_product` ASC) VISIBLE,
        CONSTRAINT `fk_category`
            FOREIGN KEY (`id_category`)
            REFERENCES `{$database}`.`categories` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
        CONSTRAINT `fk_product`
            FOREIGN KEY (`id_product`)
            REFERENCES `{$database}`.`products` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE)
        ENGINE = InnoDB
        DEFAULT CHARACTER SET = utf8;";


foreach($sql as $stm)	
    $persistence->queryApply($stm);
