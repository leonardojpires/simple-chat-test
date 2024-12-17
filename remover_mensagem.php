<?php

session_start();

require 'caminho.php';

$user_id = $_POST['user_id'];
$timestamp = $_POST['timestamp'];
$message = $_POST['message'];

if (!isset($user_id, $timestamp, $message)) {
    header(header: 'Location: ver_mensagens.php');
    exit; // Manda o utilizador de volta para ver_mensagens.php caso a mensagem não exista (most likely)
}

$lines = file(filename: $caminho, flags: FILE_IGNORE_NEW_LINES);

$linhas_filtradas = array_filter(array: $lines, callback: function($line) use ($user_id, $timestamp, $message): bool {
    $parts = explode(separator: '#', string: $line); // Divide a linha em 4 partes diferentes - ele vai criar 4 partes, cada uma dividida por onde seriam os # 
    if (count(value: $parts) >= 4) {
        list($line_user_id, , $line_message, $line_timestamp) = explode(separator: '#', string: $line);
        return !($line_user_id == $user_id && $line_message == $message && $line_timestamp == $timestamp);
    }
    return true;
});

file_put_contents(filename: $caminho, data: implode(separator: "\n", array: $linhas_filtradas)); // Aqui, o delimitador é \n porque está a dividir as linhas, já que \n é um newline, e usar o # causaria problemas, visto que já está a ser usado para separar dentro das mensagens

header(header: 'Location: ver_mensagens.php');