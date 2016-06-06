<?php
/*
Template Name: Stylist About
*/
?> 

<?php get_header(); ?>


<header id="stylist-header" class="group">
  <div id="stylist-logo"><a href="<?php echo site_url(); ?>/stylist-home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/davidcasavant_logo_stylist_portfolio.png"></a></div>
  <?php wp_nav_menu( array( 'theme_location' => 'stylist_nav' ) ); ?>
    <div id="mobile-nav-icon">
      <span></span>
      <span></span>
      <span></span>
  </div>
</header>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="row about">
      <div class="small-12 columns picDiv">
        <?php the_content(); ?>
      </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
