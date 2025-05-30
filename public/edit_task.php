<?php
require '../includes/config.php'; require '../includes/auth.php'; include '../templates/header.php';

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

$tarefa = $conn->query("SELECT * FROM tarefas WHERE id=$id AND usuario_id=$usuario_id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $stmt = $conn->prepare("UPDATE tarefas SET titulo=?, descricao=? WHERE id=? AND usuario_id=?");
    $stmt->bind_param("ssii", $titulo, $descricao, $id, $usuario_id);
    $stmt->execute();
    header("Location: home.php");
    exit;
}
?>

<form method="POST">
    <h2>Editar Tarefa</h2>
    <input type="text" name="titulo" value="<?= $tarefa['titulo'] ?>" required>
    <textarea name="descricao" required><?= $tarefa['descricao'] ?></textarea>
    <button type="submit">Atualizar</button>
</form>

<?php include '../templates/footer.php'; ?>
