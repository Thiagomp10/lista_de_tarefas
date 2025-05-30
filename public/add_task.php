<?php require '../includes/config.php'; require '../includes/auth.php'; include '../templates/header.php'; ?>

<form method="POST">
    <h2>Nova Tarefa</h2>
    <label for="titulo">Título</label>
    <input type="text" name="titulo" name="Título" required>
    <label for="nome">Descrição</label>
    <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea>
    <button type="submit">Salvar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = date("Y-m-d");
    $usuario_id = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao, data_criacao, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $titulo, $descricao, $data, $usuario_id);
    $stmt->execute();
    header("Location: home.php");
}
?>

<?php include '../templates/footer.php'; ?>
