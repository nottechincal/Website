<?php
/*
Template Name: Redirect: page-privacy
Consolidated into /privacy-policy/ — see inc/locations.php.
*/
header('HTTP/1.1 301 Moved Permanently');
header('Location: https://www.rapidtechsolutions.au/privacy-policy/', true, 301);
exit;
