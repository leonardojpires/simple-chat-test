<?php

    session_name(name: 'chat_teste');
    session_start();

    require 'caminho.php';

    if (!isset($_SESSION['dados_user'])) {
        header(header: 'Location: index.php');
    }

    $ficheiro_dados = fopen(filename: $caminho, mode: 'r');
    $mensagens = [];

    while (!feof(stream: $ficheiro_dados)) {
        $registro = fgets(stream: $ficheiro_dados);
        $registro_dados = explode(separator: '#', string: $registro);

        if (count(value: $registro_dados) < 2) {
            continue;   
        }

        if ($registro_dados[0] == $_SESSION['dados_user']['id'] && $registro_dados[1] !== $_SESSION['dados_user']['nome']) {
            $registro_dados[1] = $_SESSION['dados_user']['nome'];
        }

        $mensagens[] = $registro_dados;

    }
    fclose(stream: $ficheiro_dados);

    function atualizarNomeUtilizador($mensagens): void {
        global $caminho;
        $ficheiro_dados = fopen(filename: $caminho, mode: 'w');
        foreach($mensagens as $mensagem) {
            fwrite(stream: $ficheiro_dados, data: implode(separator: '#', array: $mensagem) . PHP_EOL);
        }
        fclose(stream: $ficheiro_dados);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Teste</title>
    <style>
        div {
            margin-bottom: 1rem;
        }

        div p {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php if (!empty($mensagens)) { ?>
        <?php foreach($mensagens as $mensagem) { ?>
            <div>
                <p><b><?= $mensagem[1]?> </b><small><i><?= $mensagem[4] ?></i></small></p>
                <p><?= $mensagem[2] ?></p>
                <?php if($_SESSION['dados_user']['id'] == $mensagem[0]) { ?>
                    <form action="remover_mensagem.php" method="POST">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars(string: $mensagem[0]) ?>">
                        <input type="hidden" name="timestamp" value="<?= htmlspecialchars(string: $mensagem[3]) ?>">
                        <input type="hidden" name="message" value="<?= htmlspecialchars(string: $mensagem[2]) ?>">
                        <button type="submit">Apagar mensagem [X]</button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div>
            <p><b>Nenhuma mensagem foi enviada ainda.</b></p>
        </div>
    <?php } ?>
    <br>
    <br>
    <a style="position:absolute; right: 10px; top: 5px;" href="index.php">Voltar</a>
</body>
</html>