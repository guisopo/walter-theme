<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Walter
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="https://use.typekit.net/bkd1ksv.css">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <div class="site">

    <header class="site__header">

      <div class="header__logo">

        <a href="<?php echo esc_url( home_url( '/') ); ?>">
          <?php walter_site_name(); ?>
        </a>

      </div>
  
    </header><!-- .page__header-->

    <nav class="site__nav">
      <?php
        $menu_args = array(
          'theme_loaction' => 'primary',
          'menu_class'     => 'nav-menu'
        );

        wp_nav_menu( $menu_args );
      ?>
    </nav>
  
    <main id="main" class="site__main">