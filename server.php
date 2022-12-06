<?php
// (A) SETTINGS - CHANGE TO YOUR OWN !
error_reporting(E_ALL & ~E_NOTICE);
define("DB_HOST", "localhost");
define("DB_NAME", "users");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "arioliev3");

// (B) CONNECT TO DATABASE
try {
  $pdo = new PDO(
    "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, 
    DB_USER, DB_PASSWORD
  );
} catch (Exception $ex) { exit($ex->getMessage()); }

// (C) GET USERS
$stmt = $pdo->prepare("SELECT * FROM `all_users`");
$stmt->execute();
$users = $stmt->fetchAll();
foreach ($users as $u) {
  printf("<div>[%u] %s</div>", $u['user_id'], $u['user_name']);
}

// (D) CLOSE DATABASE CONNECTION
$pdo = null;
$stmt = null;