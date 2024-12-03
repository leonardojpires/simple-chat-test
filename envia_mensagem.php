<?php

session_name(name: 'chat_teste');
session_start();

date_default_timezone_set(timezoneId: "Europe/Lisbon");

require_once 'caminho.php'; // Ficheiro que contém o caminho do ficheiro de database

$nomeOld = $_SESSION['nome_old']; // Guarda o nome antigo
$nomeNew = $_SESSION['dados_user']['nome']; // Guarda o novo nome
$id = $_SESSION['dados_user']['id'];
$tempo = time(); // Serve como o identificador único de cada mensagem | Podes usar para mostrar a hora em que foi escrito

$nome = str_replace(search: '#', replace: '-', subject: $nomeNew);
$mensagem = str_replace(search: '#', replace: '-', subject: $_POST['mensagem']);

$geral = $id . '#' . $nome . '#' . $mensagem . '#' . $tempo . '#' . date(format: "h:i:s d-m-Y") . PHP_EOL;

$ficheiro_dados = fopen(filename: $caminho, mode: 'a');

fwrite(stream: $ficheiro_dados, data: $geral);
fclose(stream: $ficheiro_dados);

header(header: 'Location: escrever_mensagem.php');
