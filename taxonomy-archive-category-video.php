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

<div id="page-wrap" class="group">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="post">
		<?php if( get_field('video') ): ?>
	<iframe src="https://player.vimeo.com/video/<?php the_field('video'); ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<p><?php the_title(); ?><br>
		<?php if( get_field('caption') ): ?>
			<?php the_field('caption'); ?>
		<?php endif; ?></p>
	<?php endif; ?>		
</article>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
