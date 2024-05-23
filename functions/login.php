<?php
function getPDO() {
    $config = require 'config.php';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        return new PDO("mysql:host={$config['servername']};dbname={$config['dbname']};charset=utf8", $config['username'], $config['password'], $options);
    } catch (PDOException $e) {
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
        die("Connection failed: " . $e->getMessage());
    }
}

?>