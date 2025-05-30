<?php
require '../includes/config.php'; require '../includes/auth.php';

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

$conn->query("DELETE FROM tarefas WHERE id = $id AND usuario_id = $usuario_id");
header("Location: home.php");
