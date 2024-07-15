<?php

    include 'conexao.php';

    $links = array();
    $redes = array();
    $sqlFooter = "Select * from footer";
    $stmtFooter = sqlsrv_query($conn, $sqlFooter);
    if ($stmtFooter === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmtFooter, SQLSRV_FETCH_ASSOC)) {
        if (!empty($row['link_name']) && !empty($row['link_url'])) {
            $links[$row['link_name']] = $row['link_url'];
        }
        if (!empty($row['rede_name']) && !empty($row['rede_url'])) {
            $redes[$row['rede_name']] = $row['rede_url'];
        }
    }

    sqlsrv_close($conn);
    ?>
<footer class="bg-dark text-white py-5">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-12">
                <div class="mb-4 text-center" class="Utilidade">
                    <h2 class="fs-4">Links Úteis</h2>
                    <?php foreach ($links as $site => $url) { ?>
                        <a href="<?php echo $url ?>" target="_blank" class="text-white fs-6"><?php echo $site ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="Redes">
                    <h2 class="fs-4">Redes sociais</h2>
                    <?php foreach ($redes as $site => $url) { ?>
                        <a href="<?php echo $url ?>" target="_blank" rel="noopener noreferrer"
                            class="text-white fs-6 no-underline"><i class=" <?php echo $site ?>"></i></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</footer>