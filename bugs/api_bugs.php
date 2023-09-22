<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$conn = new mysqli("localhost", "root", "", "bugtracker");

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

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

$conn->close();
?>
