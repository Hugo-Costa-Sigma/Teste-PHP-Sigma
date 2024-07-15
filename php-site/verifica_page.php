 <?php
        $modulo = Url::getURL( 0 );
 
        if( $modulo == null )
            $modulo = "home";
 
        if( file_exists( "cont/" . $modulo . ".php" ) )
            require "cont/" . $modulo . ".php";
        else
            require "cont/404.php";
 ?>