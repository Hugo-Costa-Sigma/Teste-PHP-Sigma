<?php
if(URL::getURL(0) == "" ) {
    $caminho = "home";
}
?>

<style>
    section {
        height: 100vh;
    }
</style>

<section class="d-flex justify-content-center 
                 align-items-center">
    <div class="col-md-12 text-center">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>
            A página que procura não existe.
        </p>
        <div class="btn">
            <a type="button" href="<?php echo URL::getBase(); ?><?php echo $caminho; ?>" class="btn btn-outline-dark">Voltar ao Site</a>
        </div>
    </div>
</section>