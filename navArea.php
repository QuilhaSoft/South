<!-- Classy Menu -->
<nav class="classy-navbar justify-content-between" id="southNav">

    <!-- Logo -->
    <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>

    <!-- Navbar Toggler -->
    <div class="classy-navbar-toggler">
        <span class="navbarToggler"><span></span><span></span><span></span></span>
    </div>

    <!-- Menu -->
    <div class="classy-menu">

        <!-- close btn -->
        <div class="classycloseIcon">
            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
        </div>

        <!-- Nav Start -->
        <div class="classynav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="#">Listings</a>
                            <ul class="dropdown">
                                <li><a href="single-listings.html">Single Listings</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Blog</a>
                            <ul class="dropdown">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="single-blog.html">Single Blog</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="elements.html">Elements</a></li>
                    </ul>
                </li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="lista-imoveis.php">Imoveis</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="#">Mega Menu</a>
                    <div class="megamenu">
                        <ul class="single-mega cn-col-4">
                            <li class="title">Headline 1</li>
                            <li><a href="#">Mega Menu Item 1</a></li>
                            <li><a href="#">Mega Menu Item 2</a></li>
                            <li><a href="#">Mega Menu Item 3</a></li>
                            <li><a href="#">Mega Menu Item 4</a></li>
                            <li><a href="#">Mega Menu Item 5</a></li>
                        </ul>
                        <ul class="single-mega cn-col-4">
                            <li class="title">Headline 2</li>
                            <li><a href="#">Mega Menu Item 1</a></li>
                            <li><a href="#">Mega Menu Item 2</a></li>
                            <li><a href="#">Mega Menu Item 3</a></li>
                            <li><a href="#">Mega Menu Item 4</a></li>
                            <li><a href="#">Mega Menu Item 5</a></li>
                        </ul>
                        <ul class="single-mega cn-col-4">
                            <li class="title">Headline 3</li>
                            <li><a href="#">Mega Menu Item 1</a></li>
                            <li><a href="#">Mega Menu Item 2</a></li>
                            <li><a href="#">Mega Menu Item 3</a></li>
                            <li><a href="#">Mega Menu Item 4</a></li>
                            <li><a href="#">Mega Menu Item 5</a></li>
                        </ul>
                        <ul class="single-mega cn-col-4">
                            <li class="title">Headline 4</li>
                            <li><a href="#">Mega Menu Item 1</a></li>
                            <li><a href="#">Mega Menu Item 2</a></li>
                            <li><a href="#">Mega Menu Item 3</a></li>
                            <li><a href="#">Mega Menu Item 4</a></li>
                            <li><a href="#">Mega Menu Item 5</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul>

            <!-- Search Form -->
            <div class="south-search-form">
                <form action="#" method="post" id="formLoginInterno">
                    <input type="text" name="login" id="login" style="max-width: 200px" placeholder="Insira seu login de usuário ...">
                    <input type="password" name="pass" id="pass" style="max-width: 200px" placeholder="Insira sua senha ...">
                    <button type="button" id="btnLogarInterno"><i class="fa fa-send" aria-hidden="false"></i></button>
                </form>
            </div>

            <!-- Search Button -->
            <?php if (isset($_SESSION['interno'])){?>
            <a href="#" class="searchbtn"><i class="fa fa-sign-out" aria-hidden="true" style="color: greenyellow"></i></a>
            <?php }else{ ?>
            <a href="#" class="searchbtn"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
            <?php } ?>
        </div>
        <!-- Nav End -->
    </div>
</nav>
