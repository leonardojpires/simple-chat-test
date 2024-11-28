<?php

session_name(name: 'chat_teste');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Teste - Alterar nome</title>
    <style>
        input {
            padding: 5px;
        }
    </style>
</head>
<body>
    <form action="nome_utilizador.php" method="POST">
        <input placeholder="Insere o teu nome" name="nome" id="nome" type="text" required min_length="1" value="<?= htmlspecialchars(string: $_SESSION['dados_user']['nome']) ?>">
        <br>
        <br>
        <input type="submit" value="Alterar nome"></input>
    </form>
    <br>
    <a href="escrever_mensagem.php">Voltar</a>
</body>
</html>