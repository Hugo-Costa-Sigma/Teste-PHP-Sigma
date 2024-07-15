<?php
session_start();

include("conexao.php");

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$response = array('success' => false, 'message' => '');

if ($username === '' || $password === '') {
    $response['message'] = ' Username ou password não podem estar vazios.';
} else {
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $params = array($username);

    $getResults = sqlsrv_query($conn, $sql, $params);

    if ($getResults === false) {
        $response['message'] = 'Database query failed.';
    } else {
        $user = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC);

        if (!$user) {
            $response['message'] = ' Username não encontrado.';
            $response['error'] = true;
        } elseif (!password_verify($password, $user['password'])) {
            $response['message'] = ' Password incorreta.';
            $response['error'] = true;            
        } else {
            $_SESSION['login'] = $user['username'];
            $response['success'] = true;
            $response['message'] = 'Login successful.';
        }
    }
}

echo json_encode($response);

sqlsrv_close($conn);
?>
