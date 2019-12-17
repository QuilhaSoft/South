<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './config.inc.php';
if ($_POST['key'] == $keyPass) {
    //exit;
    //$imoveis_codigo = $_POST['imoveis_codigo'];
    unlink($_POST['imoveis_imagem_capa']);
    echo json_encode('sucess');
}
