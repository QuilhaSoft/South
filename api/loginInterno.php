<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './config.inc.php';
$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
    'login' => $_POST['login'],
    'pass' => $_POST['pass'],
    'empresa' => 1
);
//var_dump($data);
$url = $servidor . '/api/usuario/login';
$ch = curl_init();
//curl_setopt($ch, CURLOPT_GET, true);
curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response = json_decode($response_json, true);
//var_dump($response);

if($response=='ok'){
    session_start();
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['interno'] = true;
    echo "ok";
}

