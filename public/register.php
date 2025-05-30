<?php require '../includes/config.php'; ?>
<?php include '../templates/header.php'; ?>

<form method="POST">
    <h2>Cadastro</h2>
    <label for="username">Usuário</label>
    <input type="text" name="username" name="Usuário" required>
    <label for="senha">Senha</label>
    <input type="password" name="senha" name="Senha" required>
    <button type="submit">Registrar</button>
</form>
<a href="login.php">Voltar ao login</a>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (username, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $senha);
    $stmt->execute();
    echo "<script>
    alert('Usuário registrado com sucesso!');
    window.location.href = 'login.php';
    </script>";
 exit;
}
?>

<?php include '../templates/footer.php'; ?>
