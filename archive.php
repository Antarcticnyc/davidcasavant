<?php get_header(); ?>

<header class="row">
	<div id="mainLogo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/davidcasavant_logos-10.png"></div>
	<?php wp_nav_menu( array( 'theme_location' => 'archive_nav' ) ); ?>
</header>
archive
<?php  $terms = get_terms( 'archive_category' );
 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
     echo '<ul>';
     foreach ( $terms as $term ) {
       echo '<li><a href="' . get_term_link( $term ) . '"/>' . $term->name . '</a></li>';
        
     }
     echo '</ul>';
 } ?>

 <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
  <div id="container">
    <div id="content" role="main">

      <h1 class="page-title"><?php echo $term->name; ?> Archives</h1>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php the_post_thumbnail(); ?>
  <!--your content goes here-->
 
  <!--your content goes here-->
    
 <?php endwhile; else: ?>
    <h3>Sorry, no matched your criteria.</h3>
 <?php endif; ?>

<?php get_footer(); ?>
