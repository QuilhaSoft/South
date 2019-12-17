<?php
include 'api/config.inc.php';
session_start();

$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
    'limit' => '6',
    'page' => '0',
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
} else {
    $filter = array(
        'filter[6][field]' => 'imoveis_publicar_interno',
        'filter[6][operand]' => '=',
        'filter[6][value]' => 'P',
    );
    $data = array_merge($data, $filter);
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
$data = array(
    'client_id' => $client_id,
    'key' => $keyPass,
    'codigo' => 1, //codigo da empresa no sistema podendo ser 2 se houver filial
);

$url = $servidor . '/api/empresa/search';
$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
//var_dump($response_json);
curl_close($ch);
$responseEmpresa = json_decode($response_json, true);
//var_dump($responseEmpresa); 
//exit;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title  -->
        <title>South - Real Estate Agency Template | Home</title>

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
        <?php if (!isset($_POST['finalidade'])) { ?>
            <!-- ##### Hero Area Start ##### -->
            <section class="hero-area">
                <div class="hero-slides owl-carousel">
                    <!-- Single Hero Slide -->
                    <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/hero1.jpg);">
                        <div class="container h-100">
                            <div class="row h-100 align-items-center">
                                <div class="col-12">
                                    <div class="hero-slides-content">
                                        <h2 data-animation="fadeInUp" data-delay="100ms">Find your home</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Hero Slide -->
                    <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/hero2.jpg);">
                        <div class="container h-100">
                            <div class="row h-100 align-items-center">
                                <div class="col-12">
                                    <div class="hero-slides-content">
                                        <h2 data-animation="fadeInUp" data-delay="100ms">Find your dream house</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Hero Slide -->
                    <div class="single-hero-slide bg-img" style="background-image: url(img/bg-img/hero3.jpg);">
                        <div class="container h-100">
                            <div class="row h-100 align-items-center">
                                <div class="col-12">
                                    <div class="hero-slides-content">
                                        <h2 data-animation="fadeInUp" data-delay="100ms">Find your perfect house</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ##### Hero Area End ##### -->
        <?php } else { ?>
            <div class="row">
                <div class="col-12" style="height: 200px"></div>
            </div>
        <?php } ?>        

        <?php
        
        include 'searchArea.php';
        ?>
        <!-- ##### Featured Properties Area Start ##### -->
        <section class="featured-properties-area section-padding-100-50">
            <div class="container">
                <div class="row" style="height: 50px">
                    <div class="col-12">
                        <div class="section-heading wow fadeInUp">
                            <?php
                            if (isset($_POST['finalidade'])) {
                                if ($_POST['finalidade'] == 'imoveis_publicar_venda') {
                                    echo "Imóveis para Venda";
                                } else {
                                    echo "Imóveis para Locação";
                                }
                            } else {
                                echo "Destaques de Venda";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
<?php
$_POST['finalidade'] = 'comprar';
include './searchBlock.php';
?>
                </div>


                <?php
                $data = array(
                    'client_id' => $client_id,
                    'key' => $keyPass,
                    'limit' => '6',
                    'page' => '0',
                    'order' => 'imoveis_suites DESC,imoveis_publicar_destaque DESC'
                );
                    $filter = array(
                        'filter[4][field]' => 'imoveis_publicar_locacao',
                        'filter[4][operand]' => '=',
                        'filter[4][value]' => 'S',
                    );
                    $data = array_merge($data, $filter);

                    $filter = array(
                        'filter[5][field]' => 'imoveis_publicar_destaque',
                        'filter[5][operand]' => '=',
                        'filter[5][value]' => 'S',
                    );
                    if (isset($_SESSION['interno'])) {
                        $filter = array(
                            'filter[6][field]' => 'imoveis_publicar_interno',
                            'filter[6][operand]' => 'IN',
                            'filter[6][value]' => array("I","P"),
                        );
                        $data = array_merge($data, $filter);
                    } else {
                        $filter = array(
                            'filter[6][field]' => 'imoveis_publicar_interno',
                            'filter[6][operand]' => '=',
                            'filter[6][value]' => 'P',
                        );
                        $data = array_merge($data, $filter);
                    }

                    $data = array_merge($data, $filter);
                    $url =  $servidor . '/api/imovel/search';
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url . "/?" . http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response_json = curl_exec($ch);
                    curl_close($ch);
                    $response = json_decode($response_json, true);
                    ?>
                <div class="row" style="height: 50px">
                        <div class="col-12">
                            <div class="section-heading wow fadeInUp">
                                Destaques de Locação
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $_POST['finalidade'] = 'alugar';
                        include './searchBlock.php';
                        ?>
                    </div>
                    
            </div>
        </section>
        <!-- ##### Featured Properties Area End ##### -->

        <!-- ##### Call To Action Area Start ##### -->
        <section class="call-to-action-area bg-fixed bg-overlay-black" style="background-image: url(img/bg-img/cta.jpg)">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-12">
                        <div class="cta-content text-center">
                            <h2 class="wow fadeInUp" data-wow-delay="300ms">Are you looking for a place to rent?</h2>
                            <h6 class="wow fadeInUp" data-wow-delay="400ms">Suspendisse dictum enim sit amet libero malesuada feugiat.</h6>
                            <a href="#" class="btn south-btn mt-50 wow fadeInUp" data-wow-delay="500ms">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Call To Action Area End ##### -->

        <!-- ##### Testimonials Area Start ##### -->
        <section class="south-testimonials-area section-padding-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                            <h2>Client testimonials</h2>
                            <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="testimonials-slides owl-carousel wow fadeInUp" data-wow-delay="500ms">

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide text-center">
                                <h5>Perfect Home for me</h5>
                                <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>

                                <div class="testimonial-author-info">
                                    <img src="img/bg-img/feature6.jpg" alt="">
                                    <p>Daiane Smith, <span>Customer</span></p>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide text-center">
                                <h5>Perfect Home for me</h5>
                                <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>

                                <div class="testimonial-author-info">
                                    <img src="img/bg-img/feature6.jpg" alt="">
                                    <p>Daiane Smith, <span>Customer</span></p>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide text-center">
                                <h5>Perfect Home for me</h5>
                                <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>

                                <div class="testimonial-author-info">
                                    <img src="img/bg-img/feature6.jpg" alt="">
                                    <p>Daiane Smith, <span>Customer</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Testimonials Area End ##### -->

        <!-- ##### Editor Area Start ##### -->
        <section class="south-editor-area d-flex align-items-center">
            <!-- Editor Content -->
            <div class="editor-content-area">
                <!-- Section Heading -->
                <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                    <img src="img/icons/prize.png" alt="">
                    <h2>jeremy Scott</h2>
                    <p>Realtor</p>
                </div>
                <p class="wow fadeInUp" data-wow-delay="500ms">Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odiomattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Curabitur rhoncus auctor eleifend. Fusce venenatis diam urna, eu pharetra arcu varius ac. Etiam cursus turpis lectus, id iaculis risus tempor id. Phasellus fringilla nisl sed sem scelerisque, eget aliquam magna vehicula.</p>
                <div class="address wow fadeInUp" data-wow-delay="750ms">
                    <h6><img src="img/icons/phone-call.png" alt=""> +45 677 8993000 223</h6>
                    <h6><img src="img/icons/envelope.png" alt=""> office@template.com</h6>
                </div>
                <div class="signature mt-50 wow fadeInUp" data-wow-delay="1000ms">
                    <img src="img/core-img/signature.png" alt="">
                </div>
            </div>

            <!-- Editor Thumbnail -->
            <div class="editor-thumbnail">
                <img src="img/bg-img/editor.jpg" alt="">
            </div>
        </section>
        <!-- ##### Editor Area End ##### -->

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