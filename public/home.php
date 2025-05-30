<?php
require '../includes/config.php';
require '../includes/auth.php';
include '../templates/header.php';

$id_usuario = $_SESSION['usuario_id'];

$busca = "";
if (!empty($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $sql = "SELECT * FROM tarefas WHERE usuario_id = ? AND (titulo LIKE ? OR descricao LIKE ?) ORDER BY data_criacao DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_usuario, $search, $search);
} else {
    $sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
}

$stmt->execute();
$tarefas = $stmt->get_result();
?>

<a href="logout.php">Logout</a><br>
<a href="add_task.php">Nova Tarefa</a>

<form method="GET">
    <input type="text" name="search" placeholder="Buscar tarefa...">
    <button type="submit">Buscar</button>
</form>

<h2>Minhas Tarefas</h2>
<?php if ($tarefas->num_rows > 0): ?>
<?php while ($tarefa = $tarefas->fetch_assoc()): ?>
    <div class="task">
        <strong><?= htmlspecialchars($tarefa['titulo']) ?></strong><br>
        <?= htmlspecialchars($tarefa['descricao']) ?><br>
        <small><?= $tarefa['data_criacao'] ?></small><br>
        <a href="edit_task.php?id=<?= $tarefa['id'] ?>">Editar</a> |
        <a href="delete_task.php?id=<?= $tarefa['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
    </div>
    <hr>
<?php endwhile; ?>

<?php else: ?>
    <p>Nenhuma tarefa encontrada.</p>
<?php endif; ?>

<?php include '../templates/footer.php'; ?>
