<!DOCTYPE html>
<html lang="<?php echo SIGLAS_LENGUAJE; ?>">
<head>
    <!--************************************************
    *         Creado con Pela Framework V1.1           *
    *  https://github.com/PelaFramework/PelaFramework  *
    *           www.sistemasbco.com.ar                 *
    *************************************************-->

	<meta charset="utf-8">
	<title><?php echo $data['titulo'].' - '.TITULO_WEB; ?></title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://localhost/app/Plantillas/default/css/style.css" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</head>
<body>
<?php

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=<?php echo DIR;?>><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?=echoActiveClassIfRequestMatches("Admin")?>><a href="<?php echo DIR;?>Admin">Inicio <span class="sr-only">(current)</span></a></li>
                    <li <?=echoActiveClassIfRequestMatches("Consorcios")?>><a href="<?php echo DIR;?>Admin/Consorcios">Consorcios</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $data['id'] ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Cambiar contraseña</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo DIR;?>Logout">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
