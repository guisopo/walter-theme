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

<body style="opacity: 0" <?php body_class( "site" ); ?>>
<?php wp_body_open(); ?>

  <header class="site__header">

    <div class="site__logo">

      <a href="<?php echo esc_url( home_url( '/') ); ?>">
        <?php walter_site_name(); ?>
      </a>

    </div>

  </header><!-- .page__header-->

  <!-- We create the nav outside the header because if not
  it will jump when scrolling in safar-iphone -->
  <?php
    $menu_args = array(
      'theme_loaction'  => 'primary',
      'menu_id'         => 'menu-list',
      'menu_class'      => 'menu-list',
      'container'       => 'nav',
      'container_class' => 'site__nav',
      'container_id'    => 'site__nav',
    );

    wp_nav_menu( $menu_args );
  ?>

  <main id="main" class="site__main">
