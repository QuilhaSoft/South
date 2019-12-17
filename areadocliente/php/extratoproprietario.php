<?php
include '../../api/config.inc.php';
session_start();
header("Content-type:application/pdf");
$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
    'codigo' => 1, //codigo da empresa no sistema podendo ser 2 se houver filial
    'proprietarios_codigo' => $_SESSION['proprietarios_codigo'],
);
if ($_SESSION['proprietarios_codigo'] != '') {
    $data['proprietarios_codigo'] = $_SESSION['proprietarios_codigo'];
} else {
    header('Location: /areadocliente/index.php?errorlogin=true');
}

$data  = array_merge($data,$_POST);

$url = $servidor . '/api/proprietario/extrato';
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
//var_dump($response_json);
curl_close($ch);
//$response = json_decode($response_json, true);
echo $response_json;
exit;