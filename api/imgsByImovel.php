<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './config.inc.php';
if ($_POST['key'] == "4867470d714171799a53417446ae7d3e") {
    header('Access-Control-Allow-Origin: '.$servidor);
    
    //exit;
    $imoveis_codigo = $_POST['imoveis_codigo'];
    $files = glob("img.imoveis/".$imoveis_codigo . "*.{jpeg,jpg,png}", GLOB_BRACE);
    echo json_encode($files);
}
