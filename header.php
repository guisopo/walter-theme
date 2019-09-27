<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Folio
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <div class="page">

    <header class="page__header header">

      <div class="header__logo">

        <a href="<?php echo esc_url( home_url( '/') ); ?>">
          <?php bloginfo( 'name' ); ?>
        </a>

      </div>
  
    </header><!-- .page__header-->
  
    <main id="main" class="page__main">