<?php



require('inc/inc.php');
$galeria = isset($_GET['galeria']) ? $_GET['galeria'] : '';
$imagen = isset($_GET['imagen']) ? $_GET['imagen'] : '';
MiGaLeRiA::mostrar($galeria, $imagen);

?>
