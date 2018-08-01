<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);

$arrayPaginas = array(
    "home" => "View/home.php", //Página inicial
    "usuario" => "View/UsuarioView/UsuarioView.php",
    "cliente" => "View/ClienteView/ClienteView.php",
    "visualizarusuario" => "View/UsuarioView/VisualizarView.php",
    "visualizarcliente" => "View/ClienteView/VisualizarView.php",
);

if ($pagina) {
    $encontrou = false;

    foreach ($arrayPaginas as $page => $key) {
        if ($pagina == $page) {
            $encontrou = true;
            require_once($key);
        }
    }

    if (!$encontrou) {
        require_once("View/home.php");
    }
} else {
    require_once("View/home.php");
}
?>