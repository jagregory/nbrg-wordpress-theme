<?php
/**
 * The Template for displaying all single players
 *
 * @package WordPress
 * @subpackage NBRG
 * @since NBRG 1.0.1
 * @version 1.0.1
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php
  $player = new SP_Player( $post );

  $show_nationality_flags = get_option( 'sportspress_player_show_flags', 'yes' ) == 'yes' ? true : false;

  $number = get_post_meta( $post->ID, 'sp_number', true );
  $nationality = get_post_meta( $post->ID, 'sp_nationality', true );
  $metrics_before = $player->metrics( true );
  $metrics_after = $player->metrics( false );
  $positions = get_the_terms( $post->ID, 'sp_position' );
  $leagues = get_the_terms( $post->ID, 'sp_league' );
  $current_team = get_post_meta( $post->ID, 'sp_current_team', true );
  
  $country_name = tb_array_value( SP()->countries->countries, $nationality, null );

  $common = array();

  // $common[ __( 'Nationality', 'sportspress' ) ] = $country_name ? ( $show_nationality_flags ? '<img src="' . plugin_dir_url( SP_PLUGIN_FILE ) . '/assets/images/flags/' . strtolower( $nationality ) . '.png" alt="' . $nationality . '"> ' : '' ) . $country_name : '&mdash;';

  $data = array_merge( $metrics_before, $common, $metrics_after );
  $has_profile = !empty($data);
?>

<div class="infinity team-name">
  <div class="row">
    <div class="small-9 columns">
      <h2><a href="<?php echo get_permalink( $current_team ); ?>"><?php the_title(); ?></a></h2>
    </div>
    <div class="small-3 columns">
      <a href="<?php echo get_post_permalink( $current_team ); ?>" class="team-logo"><?php echo get_the_post_thumbnail( $current_team, 'sportspress-fit-thumbnail' ); ?></a>
    </div>
  </div>
</div><!-- .infinity -->

<div id="content" class="site-content" role="main">
  <div class="player-main">
    <div class="row">
      <div class="large-3 medium-6 columns">
        <div class="player-photo">
          <?php the_post_thumbnail( 'sportspress-square-thumbnail', array( 'class' => 'fill-image' ) ); ?>
          <?php if ( $number != null ): ?>
          <h5 class="image-caption">
            <?php _e( 'Number', 'nbrg' ); ?>
            <span class="player-number"><?php echo $number; ?></span>
          </h5>
          <?php endif; ?>
        </div>
      </div><!-- .columns -->
      <div class="large-3 large-push-6 medium-6 columns">
        <?php
        if ( $positions ):
          foreach( $positions as $position ):
            $args = array(
              'post_type' => 'attachment',
              'post_status' => 'any',
              'posts_per_page' => -1,
              'tax_query' => array(
                array(
                  'taxonomy' => 'sp_position',
                  'field' => 'id',
                  'terms' => $position->term_id,
                ),
              ),
            );
            $attachments = get_posts( $args );

            ?>
            <div class="player-position">
              <?php
              foreach( $attachments as $attachment ):
                echo wp_get_attachment_image( $attachment->ID, 'sportspress-square-thumbnail', array( 'class' => 'fill-image' ) );
              endforeach;
              ?>
              <h5 class="image-caption"><?php echo $position->name; ?></h5>
            </div>
            <?php
          endforeach;
        endif;
        ?>
      </div><!-- .columns -->
      <div class="large-9 medium-6 columns">
        <div class="infobox">
          <?php if (!$has_profile && get_the_content()) { ?>
            <div class="entry-content">
              <h2><?php _e( 'Q&A', 'nbrg' ); ?></h2>
              <?php the_content(); ?>
            </div>
          <?php } else { ?>
            <h2><?php _e( 'Player Profile', 'nbrg' ); ?></h2>
            <div class="row">
              <?php foreach ( $data as $label => $value ): if ( $value == null ) continue; ?>
                <div class="large-6 medium-3 columns">
                  <small><?php echo $label; ?></small>
                  <h4><?php echo $value; ?></h4>
                </div>
              <?php endforeach; ?>
            </div>
          <?php } ?>
        </div>
      </div><!-- .columns -->
    </div><!-- .row -->
  </div><!-- .player-main -->
  <div class="row">
    <?php if ( $has_profile && get_the_content() ): ?>
    <div class="large-12 columns">
      <div class="infobox">
        <div class="entry-content">
          <h2><?php _e( 'Q&A', 'nbrg' ); ?></h2>
          <?php the_content(); ?>
        </div>
      </div>
    </div><!-- .columns -->
    <?php endif; ?>
    <div class="<?php echo get_the_content() ? 'large-6' : 'large-12'; ?> columns">
      <?php if ( has_excerpt() ): ?>
      <div class="sp-excerpt">
        <?php echo apply_filters( 'the_content', get_the_excerpt() ); ?>
      </div>
      <?php endif; ?>
    </div><!-- .columns -->
  </div><!-- .row -->
</div><!-- #content -->
<?php endwhile; ?>

<?php get_footer();
