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

<body <?php body_class( "site" ); ?>>
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
  
  <div class="doodle">
    <svg width="41px" height="82px" viewBox="0 0 41 82" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
      <g id="Page-2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="iPhone-8" transform="translate(-6.000000, -302.000000)" stroke="#353232">
          <g id="Nav-Menu" transform="translate(6.000000, 302.000000)">
            <path class="path" stroke= “#000000” d="M41.5471152,56.2205478 C58.7195827,39.605151 57.3610014,28.811803 37.4713713,23.8405039 C-4.02223755,22.7317761 -23.0474477,30.2430441 -19.6042593,46.374308 C-14.4394766,70.5712038 50.0235756,48.2115805 58.9619536,41.7333944 C67.9003317,35.2552084 46.694508,18.7013327 9.91499511,21.2679874 C-26.8645177,23.834642 -15.7067613,58.1348619 9.91499511,60.7919565 C26.996166,62.563353 42.1293125,53.0227669 55.3144346,32.1701984" id="Path" transform="translate(20.500000, 41.000000) rotate(-90.000000) translate(-20.500000, -41.000000) "></path>
          </g>
        </g>
      </g>
    </svg>
  </div>

  <main id="main" class="site__main">
