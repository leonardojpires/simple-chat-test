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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Teste</title>
    <style>
        input {
            padding: 5px;
        }
    </style>
</head>
<body>
    <form action="envia_mensagem.php" method="POST">
        <textarea placeholder="Escreve a tua mensagem" name="mensagem" id="mensagem" minlength="1" rows="4" cols="50" required></textarea>
        <br><br>
        <input type='submit' name="enviar" value="Enviar">
        <br>
        <p>O teu nome: <?= htmlspecialchars(string: $_SESSION['dados_user']['nome']) ?></p>
        <input type='button' value='Alterar nome' onclick="window.location.href='alterar_nome.php'"></input>
        <br><br>
        <a href="ver_mensagens.php">Ver mensagens</a>
        <br><br>
    </form>
    <form action="administrator.php" method="POST">
            <input type="text" name="admin" placeholder="Insere o código de admin">
            <input type="submit" value="Entrar">
        </form>
</body>
</html>
