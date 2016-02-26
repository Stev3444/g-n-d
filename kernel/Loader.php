<?php

/**
 * Kümmert sich um die automatische Einbindung der richtigen Klassen. D.h. bei Verwendung von "use" werden die passenden Klassen automatisch nachgeladen.
 * (http://php.net/manual/de/function.spl-autoload-register.php)
 */

function loader($classname) {
	$path = str_replace("\\", "/", $classname).".php";

	if (file_exists($path)) {
		require_once($path);
	}
}

spl_autoload_register("loader");