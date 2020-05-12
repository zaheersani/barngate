<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buy a horse, cattle, sheep, goat, pig and pets through a friendly experience. Visit us!">
    <meta name="author" content="Fernando Aguilar Víquez">
    <meta name="robots" content="noindex, nofollow">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="https://blog.barngate.com/wp-content/uploads/2019/07/favicon.png" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-4' ); ?></a>

    <header id="masthead" class="site-header <?php if ( get_theme_mod( 'sticky_header', 0 ) ) : echo 'sticky-top'; endif; ?>">
        <nav class="navbar text-center-m">

            <div class="table" style="margin-bottom: 0;">
                <div class="d-md-table-cell">
                    <img width="120" height="110" src="https://barngate.com/images/logos/logo-barngate.svg">
                </div>
                <div class="d-md-table-cell">
                    <ul class="superior">
                        <!--<li class="text-underline"><a href="#">Register to Buy</a> </li>
                        <li class="text-underline"><a href="#">Sale</a> </li>-->
                        <li class="btn-blue"><a href="https://barngate.com/" target="_blank">Barngate.com</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

	<div id="content" class="site-content">
