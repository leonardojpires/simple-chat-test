<?php

session_name(name: 'chat_teste');
session_start();

require_once 'caminho.php';

$nomeOld = $_SESSION['nome_old'];
$nomeNew = $_SESSION['dados_user']['nome'];
$id = $_SESSION['dados_user']['id'];
$tempo = time();

$nome = str_replace(search: '#', replace: '-', subject: $nomeNew);
$mensagem = str_replace(search: '#', replace: '-', subject: $_POST['mensagem']);

$geral = $id . '#' . $nome . '#' . $mensagem . '#' . $tempo . PHP_EOL;

$ficheiro_dados = fopen(filename: $caminho, mode: 'a');

fwrite(stream: $ficheiro_dados, data: $geral);
fclose(stream: $ficheiro_dados);

header(header: 'Location: escrever_mensagem.php');
