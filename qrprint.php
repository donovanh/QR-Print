<?php
/*
Plugin Name: QR Print
Plugin URI: http://hop.ie/qr
Description: Generates a QR code and includes it in the printed version of pages/posts
Version: 0.3
Author: Donovan Hutchinson
Author URI: http://hop.ie
*/

// Add in some specific CSS to ensure it only appears on print
function insertPrintOnlyCSS() {
	echo '
<!-- QR Print Styles -->
<style type="text/css">
.QRprintonly {display:none;}
</style>
	';
	echo '
<style type="text/css" media="print">
.QRprintonly {display:block !important;}
</style>
	';
}


function insertQRCode() {
 	$permalink = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
 	// QR code url
 	$qr_code_url = 'http://chart.apis.google.com/chart?chs=200x200&cht=qr&chld=|0&chl='.urlencode($permalink);
 	echo '
<!-- QR Print -->
<div class="QRprintonly">
	<p>Printed from: '.$permalink.'</p>
	<p>Scan to visit this page:</p>
	<img src="'.$qr_code_url.'" />
</div>
';
}

add_action('wp_head', 'insertPrintOnlyCSS');
add_action('wp_footer', 'insertQRCode');

?>
