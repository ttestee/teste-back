<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$conn = new mysqli("localhost", "root", "", "bugtracker");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Obtenha a lista de bugs
    $sql = "SELECT * FROM bugs";
    $result = $conn->query($sql);

    $bugs = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bugs[] = $row;
        }
    }

    header('Content-Type: application/json');
    echo json_encode($bugs);
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Receba os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Insira o novo bug no banco de dados
    $sql = "INSERT INTO bugs (titulo, descricao, status) VALUES (?, ?, 'Aberto')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $titulo, $descricao);

    if ($stmt->execute()) {
        echo "Bug relatado com sucesso!";
    } else {
        echo "Erro ao relatar o bug: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
