<?php
date_default_timezone_set('America/Sao_Paulo');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit(0);
}


error_reporting(E_ALL); 

$host = $_SERVER['HTTP_HOST'];

switch ($host) {
    case 'testes':
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "teste";
        break;

    case 'smkassist.com.br':
        $servername = "sql100.unaux.com";
        $username = "unaux_31132569";
        $password = "Cpf@0545";
        $dbname = "unaux_31132569_App";
        break;

    default:
        http_response_code(400); // Bad Request
        exit(json_encode(['error' => 'Host não reconhecido']));
}

$login = 'leyed';

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        exit(json_encode(['error' => 'Erro de conexão com o banco de dados']));
    }

    $query = "SELECT * FROM `usuario` WHERE `login` = ?;";
    $stmt = $conn->prepare($query);

    $stmt->bind_param("s", $login);
    $stmt->execute();

    $result = $stmt->get_result();

    $results = $result->fetch_assoc();

    $gene = 'teste generico';

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            echo json_encode(['testado', 'GET', $_SERVER, $results, $gene]);
            break;

        case 'POST':
            echo json_encode(['testado', 'POST', $_SERVER, $results, $gene]);
            break;

        default:
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Método não permitido']);
            break;
    }
    var_dump($stmt, $result, $results);
} catch (\Throwable $th) {
    echo $th;
}
?>