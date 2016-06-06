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
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/davidcasavant_logo_stylist_portfolio.png">
      <p style="margin-top: 30px">Page Not Found</p>
      <div id="inlineLinks">
        <a class="notfound" href="stylist-home" style="color:black">Stylist Portfolio</a>
        <a class="notfound" id="linkOver" href="archive-home" style="color:black">the david casavant archive</a>
      </div>
</div>





<?php get_footer(); ?>