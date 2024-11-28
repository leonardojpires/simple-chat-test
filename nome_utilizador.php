<?php

session_name(name: 'chat_teste');
unset($_SESSION['nome']);
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_SESSION['dados_user']['id'])) {
    $_SESSION['dados_user'] = [
        'id' => uniqid(),
        'nome' => $_POST['nome']
    ];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['dados_user']['nome'] = $_POST['nome'];
}


if (isset($_SESSION['nome'])) {
    $_SESSION['nome_old'] = $_SESSION['dados_user']['nome'];
}

include 'ver_mensagens.php';
atualizarNomeUtilizador(mensagens: $mensagens);

header(header: 'Location: escrever_mensagem.php');
