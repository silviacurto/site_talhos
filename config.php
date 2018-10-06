<?php

session_start();

$config["DATABASE_HOST"] = "example_host";
$config["DATABASE_NAME"] = "example";
$config["DATABASE_USERNAME"] = "example_user";
$config["DATABASE_PASSWORD"] = "example_password";

$db = new PDO(sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", $config["DATABASE_HOST"], $config["DATABASE_NAME"]),
$config["DATABASE_USERNAME"], $config["DATABASE_PASSWORD"]);

