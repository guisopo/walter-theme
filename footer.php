<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Folio
 */
?>

      </main><!-- #main -->
      
      <footer id="footer">
        <?php
          $menu_args = array(
            'theme_loaction' => 'primary',
            'menu_class'     => 'nav-menu'
          );

          wp_nav_menu( $menu_args );
        ?>
      </footer>

    </div><!-- #page -->

    <?php wp_footer(); ?>

  </body>
</html>