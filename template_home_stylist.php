<?php
/*
Template Name: Stylist Home
*/
?>


<?php get_header(); ?>
<header id="stylist-header" class="group">
	<div id="stylist-logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/davidcasavant_logo_stylist_portfolio.svg"></a></div>
	<?php wp_nav_menu( array( 'theme_location' => 'stylist_nav' ) ); ?>
    <div id="mobile-nav-icon">
	    <span></span>
	    <span></span>
	    <span></span>
	</div>
</header>


<div id="home-img">
	<?php if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	} 
	?>
</div>


<?php get_footer(); ?>
