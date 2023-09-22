<?php
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];

$conn = new mysqli("localhost", "root", "", "bugtracker");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "INSERT INTO bugs (titulo, descricao, status) VALUES (?, ?, 'Aberto')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $titulo, $descricao);

if ($stmt->execute()) {
    $destinatario = "seu_email@example.com";
    $assunto = "Novo Bug Relatado";
    $mensagem = "Um novo bug foi relatado:\n\nTítulo: $titulo\nDescrição: $descricao";
    mail($destinatario, $assunto, $mensagem);
    
    echo "Bug relatado com sucesso!";
} else {
    echo "Erro ao relatar o bug: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
