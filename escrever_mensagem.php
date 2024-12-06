<?php

session_start();

    if (!isset($_SESSION['dados_user']['nome'])) {
        header(header: 'Location: index.php');
        exit; // Se o utilizador não tiver definido um nom  e, ele será redirecionado para a página index.php
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
    <p>O teu nome: <?= htmlspecialchars(string: $_SESSION['dados_user']['nome']) ?></p>
    <button onclick="window.location.href='alterar_nome.php'">Alterar nome</button>
    <br><br>
    <a href="ver_mensagens.php">Ver mensagens</a>
    <br><br>
    <form action="administrator.php" method="POST">
        <input type="text" name="admin" placeholder="Insere o código de admin">
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
