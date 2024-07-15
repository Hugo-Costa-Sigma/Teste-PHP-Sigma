 <?php
        $modulo = Url::getURL(0);
        if( $modulo == null )
            $modulo = "Listagem_Menus";
 
        if( file_exists( "cont/" . $modulo . ".php" ) )
            require "cont/" . $modulo . ".php";
        else
            require "cont/404.php";
 ?>