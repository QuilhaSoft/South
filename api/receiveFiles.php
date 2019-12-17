<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './config.inc.php';
if ($_SERVER['HTTP_ORIGIN'] == $servidor) {
    header('Access-Control-Allow-Origin: '.$servidor);
    //var_dump($_FILES);
    //exit;
    $imoveis_codigo = $_POST['imoveis_codigo'];
    $files = glob("../img.imoveis/".$imoveis_codigo . "*.{jpeg,jpg,png}", GLOB_BRACE);
    $nuberOFoldImages = count($files);
    $nuberOFoldImages ++;
    if (isset($_FILES['images'])) {
        foreach ($_FILES['images']['name'] as $key => $value) {
            $errors = array();
            //var_dump($_FILES);
            $file_name = $_FILES['images']['name'][$key];
            $file_size = $_FILES['images']['size'][$key];
            $file_tmp = $_FILES['images']['tmp_name'][$key];
            $file_type = $_FILES['images']['type'][$key];
            $arrayName = explode('.', $file_name);
            $file_ext = strtolower(end($arrayName));

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }

            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "img.imoveis/" . $imoveis_codigo."_".$nuberOFoldImages.date('Yds').".".$file_ext);
                echo "Success";
                $nuberOFoldImages++;
            } else {
                print_r($errors);
            }
        }
    }
}
