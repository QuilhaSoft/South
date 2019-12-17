<?php
include 'api/config.inc.php';
session_start();
$page = isset($_POST['page']) ? ($_POST['page'] - 1) : 0;
$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
    'limit' => '3',
    'page' => $page,
    'order' => 'imoveis_suites DESC,imoveis_publicar_destaque DESC'
);

if (isset($_POST['imoveis_quartos'])) {
    if ($_POST['imoveis_quartos'] != 0 && $_POST['imoveis_quartos'] != '+5') {
        $filter = array(
            'filter[0][field]' => 'imoveis_quartos',
            'filter[0][operand]' => '=',
            'filter[0][value]' => $_POST['imoveis_quartos'],
        );
        $data = array_merge($data, $filter);
    } elseif ($_POST['imoveis_quartos'] == '+5') {
        $filter = array(
            'filter[0][field]' => 'imoveis_quartos',
            'filter[0][operand]' => '>',
            'filter[0][value]' => 5,
        );
        $data = array_merge($data, $filter);
    }
}
if (isset($_POST['imoveis_banheiros'])) {
    if ($_POST['imoveis_banheiros'] != 0 && $_POST['imoveis_banheiros'] != '+5') {
        $filter = array(
            'filter[1][field]' => 'imoveis_banheiros',
            'filter[1][operand]' => '=',
            'filter[1][value]' => $_POST['imoveis_banheiros'],
        );
        $data = array_merge($data, $filter);
    } elseif ($_POST['imoveis_banheiros'] == '+5') {
        $filter = array(
            'filter[1][field]' => 'imoveis_banheiros',
            'filter[1][operand]' => '>',
            'filter[1][value]' => 5,
        );
        $data = array_merge($data, $filter);
    }
}
if (isset($_POST['imoveis_tipo_codigo'])) {
    if ($_POST['imoveis_tipo_codigo'] != 0 && $_POST['imoveis_tipo_codigo'] != 'todos') {
        $filter = array(
            'filter[2][field]' => 'imoveis_tipo_codigo',
            'filter[2][operand]' => '=',
            'filter[2][value]' => $_POST['imoveis_tipo_codigo'],
        );
        $data = array_merge($data, $filter);
    }
}

if (isset($_POST['cidades_codigo'])) {
    if ($_POST['cidades_codigo'] != 0 && $_POST['cidades_codigo'] != 'todas') {
        $filter = array(
            'filter[3][field]' => 'cidades_codigo',
            'filter[3][operand]' => '=',
            'filter[3][value]' => $_POST['cidades_codigo'],
        );
        $data = array_merge($data, $filter);
    }
}
if (isset($_POST['finalidade'])) {
    if ($_POST['finalidade'] == 'comprar') {
        $filter = array(
            'filter[4][field]' => 'imoveis_publicar_venda',
            'filter[4][operand]' => '=',
            'filter[4][value]' => 'S',
        );
        $data = array_merge($data, $filter);
    } elseif ($_POST['finalidade'] == 'alugar') {
        $filter = array(
            'filter[4][field]' => 'imoveis_publicar_locacao',
            'filter[4][operand]' => '=',
            'filter[4][value]' => 'S',
        );
        $data = array_merge($data, $filter);
    }
} else {
    $filter = array(
        'filter[4][field]' => 'imoveis_publicar_venda',
        'filter[4][operand]' => '=',
        'filter[4][value]' => 'S',
    );
    $data = array_merge($data, $filter);

    $filter = array(
        'filter[5][field]' => 'imoveis_publicar_destaque',
        'filter[5][operand]' => '=',
        'filter[5][value]' => 'S',
    );
    $data = array_merge($data, $filter);
}

if (isset($_SESSION['interno'])) {
    $filter = array(
        'filter[6][field]' => 'imoveis_publicar_interno',
        'filter[6][operand]' => 'IN',
        'filter[6][value]' => array("I","P"),
    );
    $data = array_merge($data, $filter);
} else{
    $filter = array(
        'filter[6][field]' => 'imoveis_publicar_interno',
        'filter[6][operand]' => '=',
        'filter[6][value]' => 'P',
    );
    $data = array_merge($data, $filter);
}
if (isset($_POST['imoveis_codigo'])) {
    if ($_POST['imoveis_codigo'] != '') {
        $filter = array(
            'filter[7][field]' => 'imoveis_codigo',
            'filter[7][operand]' => '=',
            'filter[7][value]' => $_POST['imoveis_codigo'],
        );
        $data = array_merge($data, $filter);
    }
}



$url = $servidor . '/api/imovel/search';
$ch = curl_init();
//curl_setopt($ch, CURLOPT_GET, true);
curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response = json_decode($response_json, true);
//var_dump($response_json);  
//exit;
//
//var_dump($data);


$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
);

$url = $servidor . '/api/imovel/tipos';
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
//var_dump($response_json);
curl_close($ch);
$responseTipos = json_decode($response_json, true);
//var_dump($responseTipos[0]['imoveis_tipo_codigo']); 
//exit;

$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
);

$url = $servidor . '/api/imovel/cidades';
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
//var_dump($response_json);
curl_close($ch);
$responseCidades = json_decode($response_json, true);
//var_dump($responseCidades); 
//exit;
?><!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title  -->
        <title>South - Real Estate Agency Template | Listings</title>

        <!-- Favicon  -->
        <link rel="icon" href="img/core-img/favicon.ico">

        <!-- Style CSS -->
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <!-- Preloader -->
        <div id="preloader">
            <div class="south-load"></div>
        </div>

        <!-- ##### Header Area Start ##### -->
        <header class="header-area">

            <!-- Top Header Area -->
            <?php include 'topHeaderArea.php'; ?>

            <!-- Main Header Area -->
            <div class="main-header-area" id="stickyHeader">
                <div class="classy-nav-container breakpoint-off">
                    <?php include 'navArea.php'; ?> 

                </div>
            </div>
        </header>
        <!-- ##### Header Area End ##### -->


        <div class="row">
            <div class="col-12" style="height: 200px; background-color: #000"></div>
        </div>

        <?php
        include 'searchArea.php';
        ?>

        <!-- ##### Listing Content Wrapper Area Start ##### -->
        <section class="listings-content-wrapper section-padding-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="listings-top-meta d-flex justify-content-between mb-100">
                            <div class="view-area d-flex align-items-center">
                                <span>View as:</span>
                                <div class="grid_view ml-15"><a href="#" class="active"><i class="fa fa-th" aria-hidden="true"></i></a></div>
                                <div class="list_view ml-15"><a href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                            </div>
                            <div class="order-by-area d-flex align-items-center">
                                <span class="mr-15">Order by:</span>
                                <select>
                                    <option selected>Default</option>
                                    <option value="1">Newest</option>
                                    <option value="2">Sales</option>
                                    <option value="3">Ratings</option>
                                    <option value="3">Popularity</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <?php include './searchBlock.php';
                    ?>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="south-pagination d-flex justify-content-end">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">

                                    <?php
                                    $total = $total_imoveis;
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
                                            echo ' <li class="page-item"><a class="page-link" active>' . $i . ' </a></li>';
                                        else
                                            echo ' <li class="page-item"><a class="page-link">' . $i . ' </a></li>';
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Listing Content Wrapper Area End ##### -->

        <!-- ##### Footer Area Start ##### -->
        <footer class="footer-area section-padding-100-0 bg-img gradient-background-overlay" style="background-image: url(img/bg-img/cta.jpg);">
            <!-- Main Footer Area -->
            <div class="main-footer-area">
                <div class="container">
                    <div class="row">

                        <!-- Single Footer Widget -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="footer-widget-area mb-100">
                                <!-- Widget Title -->
                                <div class="widget-title">
                                    <h6>About Us</h6>
                                </div>

                                <img src="img/bg-img/footer.jpg" alt="">
                                <div class="footer-logo my-4">
                                    <img src="img/core-img/logo.png" alt="">
                                </div>
                                <p>Integer nec bibendum lacus. Suspen disse dictum enim sit amet libero males uada feugiat. Praesent malesuada.</p>
                            </div>
                        </div>

                        <!-- Single Footer Widget -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="footer-widget-area mb-100">
                                <!-- Widget Title -->
                                <div class="widget-title">
                                    <h6>Hours</h6>
                                </div>
                                <!-- Office Hours -->
                                <div class="weekly-office-hours">
                                    <ul>
                                        <li class="d-flex align-items-center justify-content-between"><span>Monday - Friday</span> <span>09 AM - 19 PM</span></li>
                                        <li class="d-flex align-items-center justify-content-between"><span>Saturday</span> <span>09 AM - 14 PM</span></li>
                                        <li class="d-flex align-items-center justify-content-between"><span>Sunday</span> <span>Closed</span></li>
                                    </ul>
                                </div>
                                <!-- Address -->
                                <div class="address">
                                    <h6><img src="img/icons/phone-call.png" alt=""> +45 677 8993000 223</h6>
                                    <h6><img src="img/icons/envelope.png" alt=""> office@template.com</h6>
                                    <h6><img src="img/icons/location.png" alt=""> Main Str. no 45-46, b3, 56832, Los Angeles, CA</h6>
                                </div>
                            </div>
                        </div>

                        <!-- Single Footer Widget -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="footer-widget-area mb-100">
                                <!-- Widget Title -->
                                <div class="widget-title">
                                    <h6>Useful Links</h6>
                                </div>
                                <!-- Nav -->
                                <ul class="useful-links-nav d-flex align-items-center">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Properties</a></li>
                                    <li><a href="#">Listings</a></li>
                                    <li><a href="#">Testimonials</a></li>
                                    <li><a href="#">Properties</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Testimonials</a></li>
                                    <li><a href="#">Contact</a></li>
                                    <li><a href="#">Elements</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Single Footer Widget -->
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="footer-widget-area mb-100">
                                <!-- Widget Title -->
                                <div class="widget-title">
                                    <h6>Featured Properties</h6>
                                </div>
                                <!-- Featured Properties Slides -->
                                <div class="featured-properties-slides owl-carousel">
                                    <!-- Single Slide -->
                                    <div class="single-featured-properties-slide">
                                        <a href="#"><img src="img/bg-img/fea-product.jpg" alt=""></a>
                                    </div>
                                    <!-- Single Slide -->
                                    <div class="single-featured-properties-slide">
                                        <a href="#"><img src="img/bg-img/fea-product.jpg" alt=""></a>
                                    </div>
                                    <!-- Single Slide -->
                                    <div class="single-featured-properties-slide">
                                        <a href="#"><img src="img/bg-img/fea-product.jpg" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Copywrite Text -->
            <div class="copywrite-text d-flex align-items-center justify-content-center">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </footer>
        <!-- ##### Footer Area End ##### -->

        <!-- jQuery (Necessary for All JavaScript Plugins) -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <!-- Popper js -->
        <script src="js/popper.min.js"></script>
        <!-- Bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Plugins js -->
        <script src="js/plugins.js"></script>
        <script src="js/classy-nav.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <!-- Active js -->
        <script src="js/active.js"></script>
    </body>

</html>