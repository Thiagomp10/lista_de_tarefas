<?php require '../includes/config.php'; ?>
<?php include '../templates/header.php'; ?>

    <form method="POST">
        <h2>Login</h2>
        <label for="username">Usuário</label>
        <input type="text" name="username" name="Usuário" required>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
        <button type="submit">Entrar</button>
    </form>
    <a href="register.php">Não possui cadastro? Clique aqui</a>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hash);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($senha, $hash)) {
        $_SESSION['usuario_id'] = $id;
        header("Location: home.php");
        exit;
    } else {
        echo "<p>Usuário ou senha inválidos.</p>";
    }
}
?>

<?php include '../templates/footer.php'; ?>
