<?php

	//Proteksi Halaman
	if(	$this->session->userdata('email') == '' && 
		$this->session->userdata('role') == '' || 
		$this->session->userdata('role') != 'Kontributor') {
		$this->session->set_flashdata('sukses','<strong>Eits!</strong> Anda melanggar otorisasi.');
		redirect(base_url('auth'));
	}

echo '<!DOCTYPE html>'.PHP_EOL;
echo '<html lang="en">'.PHP_EOL;

	include(APPPATH.'views/layouts/head.php');

	//Wrapper
	echo '<body id="page-top">'.PHP_EOL;
	echo '<div id="wrapper">'.PHP_EOL;
	include(APPPATH.'views/layouts/crew_sidebar.php');
	include(APPPATH.'views/layouts/navbar.php');
	include(APPPATH.'views/layouts/content.php');
	include(APPPATH.'views/layouts/footer.php');
	echo '</div>'.PHP_EOL;

	include(APPPATH.'views/layouts/scripts.php');

echo '</body>'.PHP_EOL;
echo '</html>'.PHP_EOL;

?>