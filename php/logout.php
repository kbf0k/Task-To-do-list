<?php
session_start();
session_unset(); // Limpa as variáveis de sessão
session_destroy(); // Destroi a sessão atual
header('Location: login.php');
exit();
