<?php
require __DIR__ . '/conexao.php';

$mensagem = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $acao = $_POST['acao'] ?? '';
    $id = (int) ($_POST['id'] ?? 0);
    $titulo = trim($_POST['titulo'] ?? '');

    if ($acao === 'adicionar') {
        if ($titulo === '') {
            $mensagem = 'Digite uma tarefa.';
        } else {
            $sql = $mysqli->prepare('INSERT INTO tarefas (titulo) VALUES (?)');
            $sql->bind_param('s', $titulo);
            $sql->execute();
        }
    }

    if ($acao === 'concluir') {
        $sql = $mysqli->prepare('UPDATE tarefas SET concluida = NOT concluida WHERE id = ?');
        $sql->bind_param('i', $id);
        $sql->execute();
    }

    if ($acao === 'editar') {
        if ($titulo === '') {
            $mensagem = 'O título não pode ficar vazio.';
        } else {
            $sql = $mysqli->prepare('UPDATE tarefas SET titulo = ? WHERE id = ?');
            $sql->bind_param('si', $titulo, $id);
            $sql->execute();
        }
    }

    if ($acao === 'excluir') {
        $sql = $mysqli->prepare('DELETE FROM tarefas WHERE id = ?');
        $sql->bind_param('i', $id);
        $sql->execute();
    }
}

$resultado = $mysqli->query('SELECT * FROM tarefas ORDER BY concluida, id DESC');
$tarefas = $resultado->fetch_all(MYSQLI_ASSOC);
$concluidas = count(array_filter($tarefas, fn($t) => $t['concluida']));
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minhas tarefas</title>
    <style>
        body {
            max-width: 700px;
            margin: 35px auto;
            padding: 0 15px;
            font-family: Arial;
            background: #f5f1ea;
        }

        main {
            background: white;
            padding: 28px;
            border-radius: 12px;
        }

        form {
            display: flex;
            gap: 7px;
            margin: 7px 0;
        }

        input {
            padding: 8px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            padding: 8px 11px;
            border: 0;
            border-radius: 5px;
            background: #985a35;
            color: white;
            cursor: pointer;
        }

        .nova input {
            flex: 1;
        }

        ul {
            padding: 0;
            list-style: none;
        }

        li {
            display: flex;
            align-items: center;
            gap: 7px;
            border-bottom: 1px solid #eee;
            padding: 8px 0;
        }

        li span {
            flex: 1;
        }

        .concluida span {
            color: #777;
            text-decoration: line-through;
        }

        .excluir {
            background: #ab493b;
        }

        .erro {
            color: #b23c2d;
        }
    </style>
</head>

<body>
    <main>
        <h1>Minhas tarefas</h1>

        <form method="post" class="nova">
            <input name="titulo" maxlength="120" placeholder="Nova tarefa" required>
            <input type="hidden" name="acao" value="adicionar">
            <button>Adicionar</button>
        </form>


        <p><?= count($tarefas) ?> tarefa(s) · <?= $concluidas ?> concluída(s)</p>

        <?php if ($mensagem): ?>
            <p class="erro"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>

        <ul>
            <?php foreach ($tarefas as $tarefa): ?>
                <li class="<?= $tarefa['concluida'] ? 'concluida' : '' ?>">

                    <form method="post">
                        <input type="hidden" name="acao" value="concluir">
                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                        <button><?= $tarefa['concluida'] ? '↩' : '✓' ?></button>
                    </form>

                    
                    <span><?= htmlspecialchars($tarefa['titulo']) ?></span>

                    
                    <form method="post">
                        <input name="titulo" value="<?= htmlspecialchars($tarefa['titulo']) ?>" required>
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                        <button>Salvar</button>
                    </form>

                    
                    <form method="post" onsubmit="return confirm('Excluir tarefa?')">
                        <input type="hidden" name="acao" value="excluir">
                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                        <button class="excluir">Excluir</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (empty($tarefas)): ?>
            <p>Nenhuma tarefa cadastrada.</p>
        <?php endif; ?>
    </main>
</body>

</html>