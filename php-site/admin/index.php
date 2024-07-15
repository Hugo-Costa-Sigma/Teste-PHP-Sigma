<?php
include("class/conexao.php");
require_once('url.php');

?>

<!doctype html>
<html lang="en">
<?php
session_start();

?>

<head>
    <title>BackOffice</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <?php if (!isset($_SESSION["login"])) { ?>
        <script> window.location.replace("https://localhost/php-site/admin/login.php"); </script>
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <?php
    ?>

</head>


<style>
    .navbar {
        padding-left: 20px;
    }

    .nav-link {
        color: white;
    }

    .delete-form {
        display: inline;
    }

    .delete-button {
        margin-left: 20px;
        margin-right: 20px;
    }

    input[type="text"],
    input[type="url"] {
        width: calc(100% - 20px);
        padding: 5px;
        margin-top: 5px;
        margin-bottom: 5px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        display: inline;
    }

    .coluna th {
        justify-content: center;
        align-content: center;
        text-align: center;
    }

    .Caixa {
        text-align: center;
    }

    .pies {
        display: flex;
        justify-content: center;
        align-content: center;
        text-align: center;
    }

    .Cabecalho {
        justify-content: center;
        align-content: center;
        text-align: center;
    }

    .record {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .record .btn {
        margin-left: 10px;
    }
    .active {
        background-color: #000 !important;
    }
</style>
<body>
    <?php
    $modulo = Url::getURL(0);
    if( $modulo == null )
    $modulo = "Listagem_Menus";
    
    if (file_exists("cont/" . $modulo . ".php")) {
        include ('cont/menu.php');
    } ?>
     <?php require_once ('verifica_page.php'); ?>
</body>
</html>