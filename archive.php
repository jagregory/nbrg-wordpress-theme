<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage NBRG
 * @since NBRG 1.0.11
 */

get_header(); ?>

<div id="content" class="site-content" role="main">
  <div class="row">
    <div class="large-8 columns">
      <?php if ( have_posts() ) : ?>
      <div class="row post-list">
        <?php
          while ( have_posts() ) {
            the_post();
            get_template_part( 'content', get_post_format() );
          }
        ?>
      </div><!-- .row -->
      <?php else : ?>
      <?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
      <?php
      global $wp_query;
      $num_posts = $wp_query->found_posts;
      ?>
    </div><!-- .columns -->

    <div class="large-4 columns">
      <?php get_sidebar( 'content' ); ?>
      <?php get_sidebar(); ?>
    </div><!-- .columns -->

  </div><!-- .row -->
</div><!-- #content -->

<?php get_footer();
