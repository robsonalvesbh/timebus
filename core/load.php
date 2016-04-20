<?php

spl_autoload_register(function ($class_name) {
   if ( file_exists( PATH_APP.$class_name.'.php' ) )
		require( PATH_APP.$class_name.'.php' );
   else
   	echo "Ocorreu um erro inesperado, favor contactar o administrador do site";exit;


});
