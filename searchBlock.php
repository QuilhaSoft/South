<?php
if (isset($response['noResults'])) {
    echo "Não Existem imoveis em destaque";
} else {
    foreach ($response as $imovel) {
        $imovel = (object) $imovel;
        $total_imoveis = $imovel->total_imoveis;
        if (!isset($imovel->imoveis_imagem_capa)) {
            $files = glob("api/img.imoveis/" . $imovel->imoveis_codigo . "*.{jpeg,jpg,png}", GLOB_BRACE);
            $imovel->imoveis_imagem_capa = $files[0];
        } else {
            $imovel->imoveis_imagem_capa = 'api/' . $imovel->imoveis_imagem_capa;
        }
        ?>
        <!-- Single Featured Property -->
        <div class="col-12 col-md-6 col-xl-4 imovel" id='<?php echo $imovel->imoveis_codigo; ?>' finalidade="<?php echo $_POST['finalidade']; ?>">
            <div class="single-featured-property mb-50 wow fadeInUp" data-wow-delay="100ms">
                <!-- Property Thumbnail -->
                <div class="property-thumb">
                    <img src="<?php echo $imovel->imoveis_imagem_capa; ?>" alt="">


                    <div class="list-price">
                        <p><?php echo ($_POST['finalidade'] == 'alugar') ? ' R$ ' . number_format($imovel->imoveis_valor_aluguel, 2, ',', '') : ' R$ ' . number_format($imovel->imoveis_valor, 2, ',', ''); ?></p>
                    </div>
                </div>
                <!-- Property Content -->
                <div class="property-content">
                    <h5><?php echo (isset($imovel->imoveis_texto_promocional)) ? $imovel->imoveis_texto_promocional : $imovel->imoveis_referencia; ?></h5>
                    <p class="location"><img src="img/icons/location.png" alt=""><?php echo (isset($imovel->imoveis_referencia)) ? $imovel->imoveis_referencia : ''; ?></p>
                    <p>Cod.: <?php echo $imovel->imoveis_codigo; ?></p>
                    <div class="property-meta-data d-flex align-items-end justify-content-between">
                        <div class="bathroom">
                            <img src="img/icons/bathtub.png" alt="">
                            <span><?php echo (isset($imovel->imoveis_banheiros)) ? $imovel->imoveis_banheiros : 0; ?></span>
                        </div>
                        <div class="garage">
                            <img src="img/icons/garage.png" alt="">
                            <span><?php echo (isset($imovel->imoveis_garagens)) ? $imovel->imoveis_garagens : 0; ?></span>
                        </div>
                        <div class="space">
                            <img src="img/icons/space.png" alt="">
                            <span><?php echo (isset($imovel->imoveis_area_util)) ? $imovel->imoveis_area_util : 0.00; ?>m<sup>2</sup></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>