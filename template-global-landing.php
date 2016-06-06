<?php
/*
Template Name: Global Landing
*/
?>

<?php get_header(); ?>
<div id="global-landing" class="cycle-slideshow" data-cycle-slides="> div" data-cycle-manual-fx="fadeout">
	<?php 
		$images = get_field('images');
			if( $images ): ?>
				<?php foreach( $images as $image ): ?>
		    		<div style="background:url(<?php echo $image['sizes']['large']; ?>) no-repeat center; background-size:cover;"></div>
				<?php endforeach; ?>
			<?php endif; ?>
</div>


<div class="inner landLogo">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/davidcasavant_logo_landing-page.png">
      <div id="inlineLinks">
        <a href="stylist-home">Stylist Portfolio</a>
        <a id="linkOver" href="archive-home">the david casavant archive</a>
      </div>
</div>





<?php get_footer(); ?>
