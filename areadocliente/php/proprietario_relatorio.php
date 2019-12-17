<?php
$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
    'codigo' => 1, //codigo da empresa no sistema podendo ser 2 se houver filial
    'group' => 'imoveis_codigo'
);
if ($_SESSION['proprietarios_codigo'] != '') {
    $data['proprietarios_codigo'] = $_SESSION['proprietarios_codigo'];
} else {
    header('Location: /areadocliente/index.php?errorlogin=true');
}


$url = $servidor . '/api/locacao/listbyproprietario';
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
//var_dump($response_json);
curl_close($ch);
$response = json_decode($response_json, true);

?>
<div class="container container-fluid">
    <span class="nav-link">Extrato do proprietário</span>
</div>
<form method="post" action="/areadocliente/php/extratoproprietario.php">
    <div class="container-fluid">

        <div class="form-group">
            <label for="imoveis_codigo">Imovel</label>
            <select name="imoveis_codigo" class="form-control" id="imoveis_codigo">
                <option value="todos" selected>Todos</option>
                <?php
                foreach ($response as $imovel) {
                    echo '<option value="' . $imovel['imoveis_codigo'] . '" >' . $imovel['imoveis_referencia'] . '</option>';
                }
                ?>

            </select>
        </div>
        <div class="form-group">
            <label for="dta_repasse_inicial">Data inicial</label>
            <input type="date" name="dta_repasse_inicial" id="dta_repasse_inicial" class="form-control" required="required">
        </div>
        <div class="form-group">
            <label for="dta_repasse_final">Data final</label>
            <input type="date" name="dta_repasse_final" id="dta_repasse_final" class="form-control" required="required">
        </div>
            <button  id="btnGerar" class="btn">Gerar</button>
    </div>

</form>

<!--<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Locação</th>
            <th scope="col">Imóvel</th>
            <th scope="col">Locatario</th>
            <th scope="col">Vrl Aluguel</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach ($response as $locacao) {
    $total = $locacao['total_locacoes'];
    ?>
                <tr>
                    <th scope="row"><?php echo $locacao['locacoes_codigo']; ?></th>
                    <td><?php echo $locacao['imoveis_referencia']; ?></td>
                    <td><?php echo $locacao['locatarios_nome']; ?></td>
                    <td><?php echo $locacao['vlr_aluguel']; ?></td>
                </tr>
<?php } ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

<?php
$paginaAtual = isset($_POST['page']) ? $_POST['page'] : 1;
$resultadosPorPagina = 3;
$proximaPagina = ($paginaAtual * $resultadosPorPagina) - $resultadosPorPagina;
$quantidadeDeLinks = ceil($total / $resultadosPorPagina);

for ($i = $paginaAtual - 3, $limiteDeLinks = $i + 6; $i <= $limiteDeLinks; $i++) {
    if ($i < 1) {
        $i = 1;
        $limiteDeLinks = 7;
    }
    if ($limiteDeLinks > $quantidadeDeLinks) {
        $limiteDeLinks = $quantidadeDeLinks;
        $i = $limiteDeLinks - 6;
    }
    if ($i < 1) {
        $i = 1;
        $limiteDeLinks = $quantidadeDeLinks;
    }

    if ($i == $paginaAtual)
        echo '<span class="page-link">       ' . $i . '       <span class="sr-only">(current)</span>      </span>';
    else
        echo ' <li class="page-item"><a class="page-link">' . $i . ' </a></li>';
}
?>


        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>-->
</nav>