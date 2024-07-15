<?php

include 'conexao.php';

$menus = array();
$sqlMenus = "Select * from menus";
$stmtMenus = sqlsrv_query($conn, $sqlMenus);
if ($stmtMenus === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmtMenus, SQLSRV_FETCH_NUMERIC)) {
    $menus[] = $row[1];
}
sqlsrv_free_stmt($stmtMenus);

sqlsrv_close($conn);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($menus as $menu) { ?>
                    <li class="nav-item">
                        <a class="nav-link active fs-5 m-2 mx-4" aria-current="page">
                            <?php echo htmlspecialchars($menu); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>