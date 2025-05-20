<?php
include 'config.php';
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conexao->prepare("DELETE FROM tarefas WHERE id_tarefa = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: inicio.php?msg=excluida");
    exit;
} else {
    header("Location: inicio.php");
    exit;
}
