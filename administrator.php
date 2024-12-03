<?php

session_name(name: 'chat_teste');
session_start();

if (!isset($_SESSION['dados_user']['nome'])) {
    header(header: 'Location: index.php');
    exit; // Se o utilizador não tiver definido um nom  e, ele será redirecionado para a página index.php
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])) {
    header(header: 'Location: envia_mensagem.php');
    exit; // Envia a mensagem do utilizador para ser processada no envia_mensagem.php
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['admin']) && $_POST['admin'] == "0112") {
    $_SESSION['dados_user']['admin'] = true;
    header(header: 'Location: escrever_mensagem.php');
}
else {
    echo "Código inválido!";
    echo '<br>';
    echo "<a href='escrever_mensagem.php'>Voltar</a>";
}