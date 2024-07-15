<?php

include("conexao.php");

class Deleter {
    private $delete_id;
    private $delete_table;
    private $conn;

    public function __construct($delete_id, $delete_table, $conn) {
        $this->delete_id = $delete_id;
        $this->delete_table = $delete_table;
        $this->conn = $conn;
    }

    public function deleteRecord() {
        if (empty($this->delete_id) || empty($this->delete_table)) {
            die("Delete ID or Table is not specified.");
        }

        $sql = "DELETE FROM " . $this->delete_table . " WHERE id = ?";
        $params = array($this->delete_id);
        $stmt = sqlsrv_query($this->conn, $sql, $params);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            echo "Apagado com Sucesso";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id']) && isset($_POST['delete_table'])) {
        $delete_id = $_POST['delete_id'];
        $delete_table = $_POST['delete_table'];

        $deleter = new Deleter($delete_id, $delete_table, $conn);
        $deleter->deleteRecord();
    } else {
        die("Delete ID or Table is not specified.");
    }
} else {
    echo "Invalid request method.";
}
?>