<?php
class Editor {
    private $edit_id;

    public function __construct($edit_id) {
        $this->edit_id = $edit_id;
    }

    public function editLinks($Link_name, $Link_url) {

        include("conexao.php");


        $sql = "Update footer set link_name='', link_url = '' WHERE id=" . $this->edit_id;
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === TRUE) {
            echo "Record edited successfully";
            header('Location: ' . URL::getBase() . 'Listagem_Links.php');
            exit();
        } else {
            die(print_r(sqlsrv_errors(), true));
        }

    }
    public function editRedes($rede_name, $rede_url) {

        include("conexao.php");


        $sql = "Update footer set rede_name='', rede_url = '' WHERE id=" . $this->edit_id;
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === TRUE) {
            echo "Record edited successfully";
            header('Location: ' . URL::getBase() . 'Listagem_Redes.php');
            exit();
        } else {
            die(print_r(sqlsrv_errors(), true));
        }

    }   
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit_id = $_POST['edit_id'];
    $edit_type = isset($_POST['edit_type']) ? $_POST['edit_type'] : null;

    $editor = new Editor($edit_id);
    if ($edit_type == 'link') {
        $link_name = $_POST['link_name'];
        $link_url = $_POST['link_url'];
        $editor->editLinks($link_name, $link_url);
    } elseif ($edit_type == 'rede') {
        $rede_name = $_POST['rede_name'];
        $rede_url = $_POST['rede_url'];
        $editor->editRedes($rede_name, $rede_url);
    }else {
        echo('Edit type is not specified.') ;
    }
}