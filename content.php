<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage NBRG
 * @since NBRG 1.0.1
 */

$is_normal_post = ( 'post' == get_post_type() );
$is_sp_core = in_array( get_post_type(), array( 'sp_event', 'sp_calendar', 'sp_team', 'sp_table', 'sp_player', 'sp_list', 'sp_staff' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php 
  if ( ! $is_sp_core && is_single() ):
    if ( is_singular( 'sp_sponsor' ) ):
      the_post_thumbnail( 'sportspress-fit-thumbnail', array( 'class' => 'featured-image aligncenter' ) );
    else:
      the_post_thumbnail( 'themeboy-standard', array( 'class' => 'fill-image featured-image' ) );
    endif;
  elseif ( ! is_single() ):
    echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
    the_post_thumbnail( 'themeboy-standard-thumbnail', array( 'class' => 'fill-image featured-image' ) );
    echo '</a>';
  endif;
  ?>
  <?php if ( $is_normal_post ): ?>
  <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
    <h5 class="entry-date"><?php the_time( get_option( 'date_format' ), $post ); ?></h5>
  </a>
  <?php endif; ?>

  <?php if ( ! $is_sp_core ): ?>
  <header class="entry-header">
    <?php if ( $is_normal_post ): ?>
    <div class="entry-meta">
      <span class="summary-bar">
        <span class="cat-links">
        <?php
        if ( is_category() ):
          global $cat;
          $categories = get_the_category();
          foreach ( $categories as $category ):
          ?>
          <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php printf( _e( 'View all posts in %s', 'nbrg' ), $category->name ); ?>" rel="category tag"><?php echo $category->name; ?></a>
          <?php
          endforeach;
        else:
          echo get_the_category_list( ' ' );
        endif;
        ?>
        </span>
        <?php if ( is_singular( 'post' ) ): $comments = get_comments_number(); ?>
          <a href="#comments" class="summary-text smoothscroll">
            <span class="icon-comments"></span> <?php printf( _n( '%s comment', '%s comments', $comments, 'nbrg' ), $comments ); ?>
          </a>
        <?php endif; ?>
      </span>
    </div>
    <?php endif; ?>
    <?php
    if ( is_single() ) :
      the_title( '<h1 class="entry-title">', '</h1>' );
    else :
      the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
    endif;
    ?>
  </header><!-- .entry-header -->
  <?php endif; ?>

  <?php if ( is_search() ) : ?>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
  <?php else : ?>
  <div class="entry-content">
    <?php
    the_content( '<span class="icon-book"></span>' . __( 'Read more', 'nbrg') );
    wp_link_pages( array(
      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'nbrg' ) . '</span>',
      'after'       => '</div>',
      'link_before' => '<span>',
      'link_after'  => '</span>',
    ) );
    ?>
  </div><!-- .entry-content -->
  <?php if ( is_singular( 'post' ) ) : ?>
  <div class="entry-author">
    <?php printf( __( 'by %s', 'nbrg' ), get_the_author() ); ?>
  </div>
  <?php endif; ?>
  <?php endif; ?>
  <?php
  if ( is_singular( 'post' ) ) :
    the_tags( '<footer class="entry-meta"><h5>' . __( 'Tags', 'nbrg' ) . '</h5><span class="tag-links">', '', '</span></footer>' );
  endif;
  ?>
</article><!-- #post-## -->
