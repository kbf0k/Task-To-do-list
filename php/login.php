<?php

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email_login_digitado']) && isset($_POST['senha_login_digitado'])) {
        $email_login = $_POST['email_login_digitado'];
        $senha_login = $_POST['senha_login_digitado'];

        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuario = ?");
        $stmt->bind_param('s', $email_login);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario_logado = $result->fetch_assoc();
            if (password_verify($senha_login, $usuario_logado['senha_usuario'])) {
                session_start();
                $_SESSION['id_sessao'] = $usuario_logado['id_usuario'];
                $_SESSION['email_usuario'] = $usuario_logado['email_usuario'];
                $_SESSION['tipo_sessao'] = $usuario_logado['tipo_usuario'];
                header('Location:inicio.php');
            } else {
                $login_errado = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <script src="../login.js" defer></script>
    <title>Login</title>
</head>

<body>
    <main>
        <div id="container">
            <form method="POST" id="form_login">
                <img src="../img/logo.png" alt="" id="logo">
                <h1>Entrar</h1>
                <div class="inputbox">
                    <input type="email" name="email_login_digitado" required placeholder="">
                    <span>Email</span>
                </div>
                <div class="inputbox">
                    <input type="password" name="senha_login_digitado" required placeholder="">
                    <span>Senha</span>
                </div>
                <div class="conta">
                    <p>Nao tem uma conta?</p>
                    <a href="cadastro.php" id="criar_conta">Criar Conta</a>
                </div>
                <button type="submit" id="entrar_button">Entrar</button>
            </form>
        </div>
    </main>
</body>

</html>