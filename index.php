<?php get_header(); ?>

<main id="main">
  <?php 
    if (have_posts()) :

      while (have_posts()) : the_post();

          get_template_part( 'content', get_post_format() );

      endwhile;

      else :
          echo 'Inget innehåll hittat!';

    endif; 
  ?>
</main>

<div class="pagination">
  <?php echo paginate_links(array( 'prev_text' => __('<i class="fa fa-chevron-left"></i>'), 'next_text' => __('<i class="fa fa-chevron-right"></i>'), )); ?>
</div>

<?php get_footer(); ?>