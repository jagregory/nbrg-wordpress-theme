<?php
/**
 * Template Name: Single Post Home
 *
 * @package WordPress
 * @subpackage Premier
 * @since Premier 1.0
 */

get_header(); ?>

<div id="content" class="site-content" role="main">
  <div class="row">
    <div class="large-7 columns home-post-list">
      <?php
      // show the home page content
      while ( have_posts() ) {
        the_post();
        get_template_part( 'content', 'page' );
      }
   
      // show the latest post
      query_posts( 'posts_per_page=1' );
      while ( have_posts() ) {
        the_post();
        get_template_part( 'content', get_post_type() );
      }
      ?>
      <a href="/posts" class="more-link"><span class="icon-book"></span>Read more recent news</a>
    </div>
    <div class="large-5 columns">
      <?php if ( is_active_sidebar( 'single-post-home' ) ) : ?>
      <div id="homepage-widgets" class="homepage-widgets widget-area">
        <?php dynamic_sidebar( 'single-post-home' ); ?>
      </div><!-- #homepage-widgets -->
      <?php endif; ?>
      <?php do_action('themeboy_after_content'); ?>
    </div>
  </div><!-- .row -->
</div><!-- #content -->

<?php get_footer();
