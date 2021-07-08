<?php get_header(); ?>

<main id="main">
  <?php 
    if (have_posts()) :

      while (have_posts()) : the_post();

      get_template_part( 'content', 'single' );

      endwhile;

      else :
          echo 'Inget innehåll hittat!';

    endif; 
  ?>
</main>

<?php get_footer(); ?>