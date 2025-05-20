<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_cadastro = $_POST['nome_cadastro_digitado'];
    $email_cadastro = $_POST['email_cadastro_digitado'];
    $senha_cadastro = $_POST['senha_cadastro_digitado'];

    $senha_criptografada = password_hash($senha_cadastro, PASSWORD_DEFAULT);

    $stmt = $conexao->prepare("INSERT INTO usuarios(nome_usuario,email_usuario,senha_usuario) VALUES(?,?,?)");
    $stmt->bind_param('sss', $nome_cadastro, $email_cadastro, $senha_criptografada);
    $stmt->execute();
    $result = $stmt->get_result();

    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cadastro</title>
</head>

<body>
    <main>
        <div id="container">
            <form method="POST" id="form_cadastro">
                <a href="login.php" id="voltar">Voltar</a>
                <h1>Cadastrar</h1>
                <div class="inputbox">
                    <input type="nome" name="nome_cadastro_digitado" required placeholder="">
                    <span>Digite seu nome</span>
                </div>
                <div class="inputbox">
                    <input type="email" name="email_cadastro_digitado" required placeholder="">
                    <span>Digite seu email</span>
                </div>
                <div class="inputbox">
                    <input type="password" name="senha_cadastro_digitado" required placeholder="">
                    <span>Criar senha</span>
                </div>
                <button type="submit" id="entrar_button">Criar Conta</button>
            </form>
        </div>
    </main>
</body>
<?php if (isset($cadastro_errado) && $cadastro_errado): ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "Credenciais inválidas",
            text: "Verifique email e senha digitados",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'login.php';
            }
        });
    </script>
<?php endif; ?>

</html>