<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_id'])) {
    $idExcluir = intval($_POST['excluir_id']);
    $stmtExcluir = $conexao->prepare("DELETE FROM tarefas WHERE id_tarefa = ?");
    $stmtExcluir->bind_param("i", $idExcluir);
    $stmtExcluir->execute();
}

// Buscar tarefas com nome do usuário via JOIN
$stmt = $conexao->prepare("
    SELECT t.*, u.nome_usuario 
    FROM tarefas t
    LEFT JOIN usuarios u ON t.fk_usuario_id = u.id_usuario
");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../style/inicio.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Inicio</title>
</head>

<body>
    <nav>
        <img src="../img/logo.png" id="logo" alt="" />
        <ul>
            <li><a href="inicio.php">Gerenciador de tarefas</a></li>
            <li><a href="adicionar_tarefas.php">Adicionar tarefas</a></li>
            <li><a href="#" id="logout">Sair</a></li>
        </ul>
    </nav>
    <main>
        <div class="container">
            <h1 id="titulo">Tarefas</h1>
            <div class="tarefas">
                <?php if ($result->num_rows > 0) {
                    while ($usuario = $result->fetch_assoc()) {
                        echo '<div class="a_fazer">';
                        echo '<div class="info">';
                        echo '<h3>Descrição:</h3><p>' . htmlspecialchars($usuario['descricao_tarefa']) . '</p>';
                        echo '</div>';
                        echo '<div class="info">';
                        echo '<h3>Setor da empresa:</h3><p>' . htmlspecialchars($usuario['setor_empresa_tarefa']) . '</p>';
                        echo '</div>';
                        echo '<div class="info">';
                        echo '<h3>Prioridade:</h3><p>' . htmlspecialchars($usuario['prioridade_tarefa']) . '</p>';
                        echo '</div>';
                        echo '<div class="info">';
                        echo '<h3>Data:</h3><p>' . htmlspecialchars($usuario['data_cadastro_tarefa']) . '</p>';
                        echo '</div>';
                        echo '<div class="info">';
                        echo '<h3>Status:</h3><p>' . htmlspecialchars($usuario['status_tarefa']) . '</p>';
                        echo '</div>';
                        echo '<div class="info">';
                        echo '<h3>Responsável:</h3><p>' . htmlspecialchars($usuario['nome_usuario'] ?? 'Usuário não encontrado') . '</p>';
                        echo '</div>';

                        // Botões
                        echo '<div class="botoes">';
                        echo '<a href="editar_tarefa.php?id=' . intval($usuario['id_tarefa']) . '" class="btn editar">Editar</a>';
                        echo '<a href="#" data-id="' . intval($usuario['id_tarefa']) . '" class="btn excluir">Excluir</a>';
                        echo '</div>';

                        echo '</div>';
                    }
                } else {
                    echo '<p>Nenhuma tarefa cadastrada.</p>';
                } ?>
            </div>
        </div>
    </main>

    <form id="formExcluir" method="POST" style="display: none;">
        <input type="hidden" name="excluir_id" id="excluir_id" />
    </form>

    <footer></footer>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const botoesExcluir = document.querySelectorAll(".btn.excluir");
            botoesExcluir.forEach(botao => {
                botao.addEventListener("click", (e) => {
                    e.preventDefault();
                    const tarefaId = botao.getAttribute("data-id");

                    Swal.fire({
                        title: "Deseja excluir esta tarefa?",
                        text: "Essa ação não pode ser desfeita!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sim, excluir",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById("excluir_id").value = tarefaId;
                            document.getElementById("formExcluir").submit();
                        }
                    });
                });
            });
        });
    </script>
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