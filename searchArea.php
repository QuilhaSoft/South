<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        <!-- ##### Advance Search Area Start ##### -->
        <div class="south-search-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="advanced-search-form">
                            <!-- Search Title -->
                            <div class="search-title">
                                <p>Encontre seu imovél</p>
                            </div>
                            <!-- Search Form -->
                            <form action="lista-imoveis.php" method="post" id="advanceSearch">
                                <div class="row">

                                    <div class="col-12 col-md-4 col-lg-2">
                                        <div class="form-group">
                                            <span class="card-title">Por Código</span><br>
                                            <input type="text" class="form-control" id="imoveis_codigo" name="imoveis_codigo">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <span class="card-title">Finalidade</span><br>
                                            <select class="form-control" id="finalidade" name="finalidade">
                                                <?php 
                                                $selectedAlugar = ($_POST['finalidade'] == 'alugar')?'SELECTED':''; 
                                                $selectedComprar = ($_POST['finalidade'] == 'comprar')?'SELECTED':''; 
                                                ?>
                                                <option value="alugar">Alugar</option>
                                                <option value="comprar">Comprar</option>

                                            </select>
                                            <input type="hidden" name="page" value="0" id="page">
                                        </div>
                                    </div>



                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <span class="card-title">Cidades</span><br>
                                            <select class="form-control" id="cities" name="cidades_codigo">
                                                <option value="todas">Todas</option>
                                                <?php
                                                foreach ($responseCidades as $key => $value) {
                                                    $selected = ($_POST['cidades_codigo'] == $value['cidades_codigo'])?'SELECTED':'';
                                                    echo "<option value='{$value['cidades_codigo']}' {$selected}>{$value['cidades_nome']}</option>";
                                                }
                                                ?>    
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-12 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <span class="card-title">Tipo do Imóvel</span><br>
                                            <select class="form-control" id="catagories" name="imoveis_tipo_codigo">
                                                <option value="todos">Todos</option>
                                                <?php
                                                foreach ($responseTipos as $key => $value) {
                                                     $selected = ($_POST['imoveis_tipo_codigo'] == $value['imoveis_tipo_codigo'])?'SELECTED':'';
                                                    echo "<option value='{$value['imoveis_tipo_codigo']}'  {$selected}>{$value['imoveis_tipo_nome']}</option>";
                                                }
                                                ?>    
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-4 col-xl-2">
                                        <div class="form-group">
                                            <span class="card-title">Quartos</span><br>
                                            <select class="form-control" id="bedrooms" name="imoveis_quartos">
                                                <option value="0">Qualquer</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option velua="5+">5+</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4 col-xl-2">
                                        <div class="form-group">
                                            <span class="card-title">Banheiros</span><br>
                                            <select class="form-control" id="bathrooms" name="imoveis_banheiros">
                                                <option value="0">Qualquer</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option velua="5+">5+</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-8 col-lg-12 col-xl-5 d-flex">
                                        <!-- Space Range -->
                                        <div class="slider-range">
                                            <div data-min="120" data-max="820" data-unit=" sq. ft" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="120" data-value-max="820">
                                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                            </div>
                                            <div class="range">120 sq. ft - 820 sq. ft</div>
                                        </div>

                                        <!-- Distance Range -->
                                        <div class="slider-range">
                                            <div data-min="10" data-max="1300" data-unit=" mil" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="10" data-value-max="1300">
                                                <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                                <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                            </div>
                                            <div class="range">10 mil - 1300 mil</div>
                                        </div>
                                    </div>

                                    <div class="col-12 search-form-second-steps">
                                        <div class="row">





                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between align-items-end">
                                        <!-- More Filter -->
                                        <div class="more-filter">

                                        </div>
                                        <!-- Submit -->
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn south-btn">Procurar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ##### Advance Search Area End ##### -->

