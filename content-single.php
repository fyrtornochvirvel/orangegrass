<article class="post single">
  <?php
    if (has_post_thumbnail()) {
      $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'post-background' );
      $thumbnail_url = $thumbnail_data[0]; ?>
  
      <div class="hero" style="background-image: url('<?php echo $thumbnail_url ?>')"></div>
    
  <?php }
    else { ?>
  
      <div class="hero-fallback"></div>
  
  <?php } ?>
  <div class="entry-content">
    <header class="entry-meta">
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
      <p class="entry-date"><?php the_time('j F Y'); ?> av <?php the_author(); ?></p>
      <p class="entry-tags"><?php the_tags( '', '', '<br />' ); ?></p>
    </header>
    <section class="entry-post">
      <?php the_content(); ?>
    </section>
    <section class="entry-comment">
     <?php comments_template(); ?>
    </section>
  </div>
</article>