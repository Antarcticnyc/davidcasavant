<?php
/*
Template Name: Archive About
*/
?> 

<?php get_header(); ?>


<header class="group">
  <div id="archive-logo"><a href="<?php echo site_url(); ?>/archive-home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/davidcasavant_logos-10.png"></a></div>
  <?php wp_nav_menu( array( 'theme_location' => 'archive_nav' ) ); ?>
    <div id="mobile-nav-icon">
      <span></span>
      <span></span>
      <span></span>
  </div>
</header>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="page-wrap" class="aboutArchive row">
      <div class="small-12 medium-6 columns hide-for-small">
        
          <?php the_post_thumbnail();?>
      </div>
      <div class="small-12 medium-6 columns">
        <?php the_content(); ?>
      </div>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
