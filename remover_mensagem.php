<?php

session_name(name: 'chat_teste');
session_start();

require 'caminho.php';

$user_id = $_POST['user_id'];
$timestamp = $_POST['timestamp'];
$message = $_POST['message'];

if (!isset($user_id, $timestamp, $message)) {
    header(header: 'Location: ver_mensagens.php');
    exit; // Manda o utilizador de volta para ver_mensagens.php caso a mensagem não exista (most likely)
}

$lines = file($caminho, FILE_IGNORE_NEW_LINES);

$linhas_filtradas = array_filter($lines, function($line) use ($user_id, $timestamp, $message) {
    list($line_user_id, , $line_message, $line_timestamp) = explode('#', $line);
    return !($line_user_id == $user_id && $line_message == $message && $line_timestamp == $timestamp);
});

file_put_contents($caminho, implode("\n", $linhas_filtradas)); // Aqui, o delimitador é \n porque está a dividir as linhas, já que \n é um newline, e usar o # causaria problemas, visto que já está a ser usado para separar dentro das mensagens

header(header: 'Location: ver_mensagens.php');