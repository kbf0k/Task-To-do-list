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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav>
        <img src="../img/logo.png" id="logo" alt="">
        <ul>
            <li><a href="inicio.php">Gerenciador de Tarefas</a></li>
            <li><a href="adicionar_tarefas.php">Adicionar Tarefas</a></li>
            <li><a href="#" id="logout">Sair</a></li>
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
                    <span id="status">Prioridade da Tarefa</span>
                    <select name="prioridade_tarefa" required>
                        <option value="Baixa">Baixa</option>
                        <option value="Média">Média</option>
                        <option value="Alta">Alta</option>
                    </select>
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
                    <span id="status">Status</span>
                    <select name="status_tarefa" required>
                        <option value="A fazer">A fazer</option>
                        <option value="Fazendo">Fazendo</option>
                        <option value="Finalizado">Finalizado</option>
                    </select>
                </div>

                <div class="inputbox">
                    <button type="submit" id="entrar_button">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const logoutBtn = document.getElementById('logout');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', () => {
                Swal.fire({
                    title: "Você deseja sair?",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim, sair",
                    confirmButtonColor: "#3085d6",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('logout.php', {
                            method: 'POST'
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    }
                });
            });
        }
    });
</script>