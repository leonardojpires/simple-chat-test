<?php

session_start();
require 'caminho.php';

header('Content-Type: application/json');

if (file_exists($caminho)) {
    $lastModified = filemtime($caminho);
    echo json_encode(['last_modified' => $lastModified]);
}
else {
    echo json_encode(['last_modified' => 0]);
}