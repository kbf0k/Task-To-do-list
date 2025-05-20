<?php
include 'config.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: inicio.php");
    exit;
}

$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao_tarefa'];
    $prioridade = $_POST['prioridade_tarefa'];
    $setor = $_POST['setor_tarefa'];
    $data = $_POST['data_tarefa'];
    $status = $_POST['status_tarefa'];

    $stmt = $conexao->prepare("UPDATE tarefas SET descricao_tarefa = ?, prioridade_tarefa = ?, setor_empresa_tarefa = ?, data_cadastro_tarefa = ?, status_tarefa = ? WHERE id_tarefa = ?");
    $stmt->bind_param("sssssi", $descricao, $prioridade, $setor, $data, $status, $id);
    $stmt->execute();

    header("Location: inicio.php?msg=editada");
    exit;
}

$stmt = $conexao->prepare("SELECT * FROM tarefas WHERE id_tarefa = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tarefa = $result->fetch_assoc();

if (!$tarefa) {
    header("Location: inicio.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../style/editar_tarefas.css">
</head>

<body>
    <nav>
        <img src="../img/logo.png" id="logo" alt="">
        <ul>
            <li><a href="inicio.php">Gerenciador de tarefas</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <h1>Editar Tarefa</h1>
            <form method="POST" id="form_cadastro">

                <div class="inputbox">
                    <input type="text" name="descricao_tarefa" value="<?= htmlspecialchars($tarefa['descricao_tarefa']) ?>" required>
                    <span>Descrição:</span>
                </div>

                <div class="inputbox">
                    <input type="text" name="prioridade_tarefa" value="<?= htmlspecialchars($tarefa['prioridade_tarefa']) ?>" required>
                    <span>Prioridade:</span>
                </div>

                <div class="inputbox">
                    <input type="text" name="setor_tarefa" value="<?= htmlspecialchars($tarefa['setor_empresa_tarefa']) ?>" required>
                    <span>Setor:</span>
                </div>

                <div class="inputbox">
                    <input type="date" name="data_tarefa" value="<?= htmlspecialchars($tarefa['data_cadastro_tarefa']) ?>" required>
                    <span>Data:</span>
                </div>

                <div class="inputbox">
                    <input type="text" name="status_tarefa" value="<?= htmlspecialchars($tarefa['status_tarefa']) ?>" required>
                    <span>Status:</span>
                </div>

                <div class="inputbox">
                    <button type="submit" id="entrar_button">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>