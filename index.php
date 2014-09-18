<?php
/**
 * The main template file
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
      <?php do_action('themeboy_before_content'); ?>
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
      <?php do_action('themeboy_before_pagination'); ?>
      <?php endif; ?>

      <nav id="post-nav">
        <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'nbrg' ) ); ?></div>
        <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'nbrg' ) ); ?></div>
      </nav>

      <?php do_action('themeboy_after_content'); ?>
    </div><!-- .columns -->

    <div class="large-4 columns">
      <?php get_sidebar( 'content' ); ?>
      <?php get_sidebar(); ?>
    </div><!-- .columns -->

  </div><!-- .row -->
</div><!-- #content -->

<?php get_footer();
