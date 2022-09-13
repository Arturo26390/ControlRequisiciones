<?php
	$nombre = $_GET["nombre"].".pdf";
	if (file_exists("../../../CapturaRequisiciones/Requisiciones-PDF/".$nombre)) {
        $downloadfilename = basename($nombre);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $downloadfilename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize("../../../CapturaRequisiciones/Requisiciones-PDF/".$nombre));
        ob_clean();
        flush();
        readfile("../../../CapturaRequisiciones/Requisiciones-PDF/".$nombre);
        unlink("../../../CapturaRequisiciones/Requisiciones-PDF/".$nombre);
        exit;
    }
?>