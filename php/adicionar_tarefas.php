<?php
include 'config.php';
session_start();

if (!isset($_SESSION['id_sessao'])) {
    header('Location:login.php');
}
$id_usuario = intval($_SESSION['id_sessao']);

$tarefa_aceita = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao_tarefa = $_POST['descricao_tarefa'];
    $prioridade_tarefa = $_POST['prioridade_tarefa'];
    $setor_tarefa = $_POST['setor_tarefa'];
    $data_tarefa = $_POST['data_tarefa'];
    $status_tarefa = $_POST['status_tarefa'];

    $stmt = $conexao->prepare("INSERT INTO tarefas
        (descricao_tarefa, prioridade_tarefa, setor_empresa_tarefa, data_cadastro_tarefa, status_tarefa, fk_usuario_id) 
        VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param('sssssi', $descricao_tarefa, $prioridade_tarefa, $setor_tarefa, $data_tarefa, $status_tarefa, $id_usuario);
    $stmt->execute();
    $tarefa_aceita = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Tarefa</title>
    <link rel="stylesheet" href="../style/adicionar_tarefas.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav>
        <img src="../img/logo.png" id="logo" alt="Logo da Empresa">
        <ul>
            <li><a href="inicio.php">Gerenciador de Tarefas</a></li>
            <li><a href="adicionar_tarefas.php">Adicionar Tarefas</a></li>
            <li><a href="#" id="logout">Sair</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <form method="POST" id="form_cadastro">
                <h1>Criar Tarefa</h1>

                <div class="inputbox">
                    <span id="status">Descrição</span>
                    <input type="text" name="descricao_tarefa" required>
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
                    <input type="text" name="setor_tarefa" required>
                    <span>Setor da Empresa</span>
                </div>

                <div class="inputbox">
                    <input type="date" name="data_tarefa" required>
                    <span>Data</span>
                </div>

                <div class="inputbox">
                    <span id="status">Status</span>
                    <select name="status_tarefa" required>
                        <option value="A fazer">A fazer</option>
                    </select>
                </div>

                <button type="submit" id="entrar_button">Criar Tarefa</button>
            </form>
        </div>
    </main>

    <footer></footer>

    <?php if ($tarefa_aceita): ?>
        <script>
            Swal.fire({
                title: "Tarefa criada com sucesso!",
                text: "Parabéns, sua tarefa foi cadastrada. Você será redirecionado para o painel.",
                icon: "success",
                confirmButtonColor: "#520283"
            }).then(() => {
                window.location.href = 'inicio.php';
            });
        </script>
    <?php endif; ?>

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
</body>

</html>