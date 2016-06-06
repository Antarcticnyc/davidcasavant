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

<div id="page-wrap" data-scroll-speed="5" class="group">
	<div id="max" style="display:none"><?php $max = $wp_query->max_num_pages; echo $max;?></div>
	
	<div class="next group">
		<section class="group">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
			<article class="post">
				<div class="placeholder"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Images/loading.gif"></div>
				<div class="imgHolder">
					<?php the_post_thumbnail('large'); ?>
				</div>
				<p><?php the_title(); ?><br>
				<?php if( get_field('caption') ): ?>
					<?php the_field('caption'); ?>
				<?php endif; ?></p>
			</article>
			<?php endwhile; endif; ?>
			
		</section>
	
	</div>
	
</div> <!-- end of #page-wrap -->
<div class="scroll-loader"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Images/loading.gif"></div>
<?php get_footer(); ?>
