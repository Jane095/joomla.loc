<!DOCTYPE html>
<html style="margin-top: 0 !important;">
<head>
    <title><?php bloginfo('name');?></title>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <?php wp_head(); ?>
</head>
<body>
    <!--Header-->
    <header id="header">
        <div class="container">
            <div class="logo">
                <a href="#">
                    <img src="<?php bloginfo('template_url'); ?>/images/logo.jpg" alt="galyna master">
                    <h1>GALYNA <br/>MASTER</h1>
                </a>
            </div>
            <address class="top-address">
                <i class="fa fa-phone" aria-hidden container="true"></i><a href="tel:0544227714">054 4227714</a>; Израиль, Ришон ЛеЦион (Rishon LeTsiyon)
            </address>
            <nav class="navigation">
                <ul class="nav">
                    <?php wp_nav_menu (array('theme_location' => 'menu', 'container'=> 'false')); ?>
                </ul>
            </nav>

            <div class="menuwrapp_mobile">
                <a class="mobilemenu_toggle" href="#" >
                    <img src="<?php bloginfo('template_url'); ?>/images/mobile-menu-button.png" alt="toggle">
                    <?php _e (''); ?></a>

                <?php if ( has_nav_menu ( 'primary' ) ) { ?>
                    <?php wp_nav_menu ( array ('container'=> '', 'theme_location' => 'primary mobile', 'items_wrap' => '
                                <ul class="menu_mobile">%3$s</ul>' ) ); ?>
                <?php } else { ?>
                    <?php wp_nav_menu ( array ( 'menu_class' => 'menu_mobile' ) ); ?>
                <?php } ?>
            </div>

        </div>

        <div id="slider-wrap">
            <div class="slogan">Опыт &bull; качество &bull; доверие</div>
            <div class="slider">
                <div class="slide">
                    <?php if ( function_exists( 'easingslider' ) ) { easingslider( 49 ); } ?>
            </div>
        </div>
    </header>
    <!--END OF HEADER-->