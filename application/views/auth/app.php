<?php

$this->session->sess_destroy();

echo '<!DOCTYPE html>';
echo '<html lang="en">';

	include(APPPATH.'views/layouts/head.php');

	//Wrapper
	echo '<body class="bg-gradient-primary">';
	include(APPPATH.'views/layouts/content.php');

	include(APPPATH.'views/layouts/scripts.php');

echo '</body>';
echo '</html>';

?>