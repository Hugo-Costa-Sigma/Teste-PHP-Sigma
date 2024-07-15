<?php

session_start();
include("conexao.php");

if (!isset($_SESSION["login"])) {
    die("Acesso negado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "";
    $params = array();

    if (isset($_POST['Menu_novo'])) {
        $menu_novo = $_POST['Menu_novo'];
        $query = "INSERT INTO Menus (text_content) VALUES (?)";
        $params = array($menu_novo);
    } elseif (isset($_POST['imagem_nova'])) {
        $imagem_nova = $_POST['imagem_nova'];
        $query = "INSERT INTO imagens (url_imagens) VALUES (?)";
        $params = array($imagem_nova);
    } elseif (isset($_POST['banner_novo'])) {
        $banner_novo = $_POST['banner_novo'];
        $query = "INSERT INTO banners (url_banners) VALUES (?)";
        $params = array($banner_novo);
    } elseif (isset($_POST['link_name_novo']) && isset($_POST['link_url_novo'])) {
        $link_name = $_POST['link_name_novo'];
        $link_url = $_POST['link_url_novo'];
        $query = "INSERT INTO footer (link_name, link_url) VALUES (?, ?)";
        $params = array($link_name, $link_url);
    } elseif (isset($_POST['rede_name_novo']) && isset($_POST['rede_url_novo'])) {
        $rede_name = $_POST['rede_name_novo'];
        $rede_url = $_POST['rede_url_novo'];
        $query = "INSERT INTO footer (rede_name, rede_url) VALUES (?, ?)";
        $params = array($rede_name, $rede_url);
    }

    if ($query !== "" && !empty($params)) {
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            echo "Sucesso";
        }
    } else {
        echo "Dados inválidos.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

