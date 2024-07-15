<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Backoffice</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if (Url::getURL(0) == 'Listagem_Menus') {echo 'active';}?>" href="<?php echo URL::getBase(); ?>Listagem_Menus">Menus<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (Url::getURL(0) == 'Listagem_Img') {echo 'active';}?>" href="<?php echo URL::getBase(); ?>Listagem_Img">Imagens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (Url::getURL(0) == 'Listagem_Banner') {echo 'active';}?>" href="<?php echo URL::getBase(); ?>Listagem_Banner">Banners</a>
                </li>
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">Footer</a>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo URL::getBase(); ?>Listagem_Links">Links</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="<?php echo URL::getBase(); ?>Listagem_Redes">Redes</a></li>
                </ul>
            </ul>
        </div>
    </nav>
</header>