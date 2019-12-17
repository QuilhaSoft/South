<?php
include '../api/config.inc.php';
session_start();
if (isset($_POST['login'])) {
    $data = array(
        'client_id' => $client_id,
        'key' => $keyPass,
        'codigo' => 1, //codigo da empresa no sistema podendo ser 2 se houver filial
        'login' => $_POST['login'], //codigo da empresa no sistema podendo ser 2 se houver filial
        'pass' => $_POST['pass'], //codigo da empresa no sistema podendo ser 2 se houver filial
    );

    $url = $servidor . '/api/usuario/loginProprietarioLocatario';
    $ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    
    if ($response == 'erro') {
        header('Location: index.php?errorlogin=true');
    } else {
        if ($response['proprietarios_codigo'] != '') {
            $_SESSION['proprietarios_codigo'] = $response['proprietarios_codigo'];
        }
        if ($response['locatarios_codigo'] != '') {
            $_SESSION['locatarios_codigo'] = $response['locatarios_codigo'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link href="/areadocliente/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <title>Imobiliária  -  Acesso exclusivo para clientes</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><image src="/areadocliente/images/icons/android-icon-36x36.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <?php if (isset($_SESSION['proprietarios_codigo'])) { ?>
                        <li class="nav-item active">
                            
                                <a class="nav-link" href="/areadocliente/proprietario/relatorio">Extrato</a>
                        </li>
                        <li class="nav-item active">
                                <a class="nav-link" href="#">IRRF</a>
                        </li>
                        
                    <?php } ?>
                    <?php if (isset($_SESSION['locatarios_codigo'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Locatário
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <div class="container">
            <?php 
            if(isset($_GET['loadpage'])){
                if(file_exists ( "php/".$_GET['loadpage'] . ".php")){ 
                        require "php/".$_GET['loadpage'] . ".php";
                }else{
                    echo "<h1>Pagina não encontrada</h1>";
                }
            }?>
        </div>
        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="/areadocliente/bootstrap/js/jquery.js"></script>
        <script src="/areadocliente/bootstrap/js/popper.min.js"></script>
        <script src="/areadocliente/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>