<?php

session_name(name: 'chat_teste');
session_start();

if (isset($_SESSION['dados_user']['nome'])) {
    header(header: 'Location: escrever_mensagem.php');
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
    <form action="nome_utilizador.php" method="POST">
        <input placeholder="Insere o teu nome" name="nome" id="nome" type="text" required min_length="1">
        <br>
        <br>
        <input type="submit" value='Prosseguir'></input>
    </form>
</body>
</html>