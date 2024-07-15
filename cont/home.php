<?php

    include 'conexao.php';

    $imagens = array();
    $sqlImagens = "Select * from imagens";
    $stmtImagens = sqlsrv_query($conn, $sqlImagens);
    if ($stmtImagens === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmtImagens, SQLSRV_FETCH_NUMERIC)) {
        $imagens[] = $row[1];
    }
    sqlsrv_free_stmt($stmtImagens);

    $banner = array();
    $sqlBanner = "Select * from banners";
    $stmtBanner = sqlsrv_query($conn, $sqlBanner);
    if ($stmtBanner === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    while ($row = sqlsrv_fetch_array($stmtBanner, SQLSRV_FETCH_NUMERIC)) {
        $banner[] = $row[1];
    }

    sqlsrv_close($conn);
    ?>
<div id="carousel" class="carousel slide">
  <div class="carousel-inner">
    <?php foreach ($banner as $index => $bannerpath) { ?>
      <div class="carousel-item <?php if ($index === 0) { ?> active <?php } ?>">
        <img src="<?php echo htmlspecialchars($bannerpath); ?>" class="d-block w-100 ">
      </div>
    <?php } ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<ul class="Imagens">
  <?php foreach ($imagens as $imagem) { ?>
    <li>
      <img src="<?php echo htmlspecialchars($imagem); ?>">
    </li>
  <?php } ?>
</ul>
</div>