<?php
/**
 * Player Gallery Thumbnail
 *
 * @package WordPress
 * @subpackage NBRG
 * @since NBRG 1.0.1
 * @version 1.0.1
 */
?>
<div class="player-thumbnail large-4 medium-6 small-12 columns left">
  <a href="<?php echo get_post_permalink( $id ); ?>">
    <?php
    $number = get_post_meta( $id, 'sp_number', true );
    if ( $number != null ): ?>
      <span class="player-number"><?php echo $number; ?></span>
    <?php endif; ?>
    <?php
    if( has_post_thumbnail( $id ) )
      echo get_the_post_thumbnail( $id, 'sportspress-square-thumbnail', array( 'class' => 'profile-photo fill-image' ) );
    else
      echo '<img width="150" height="150" src="http://www.gravatar.com/avatar/?s=150&d=mm&f=y" class="attachment-thumbnail wp-post-image profile-photo fill-image">';
    ?>
    <h5 class="image-caption-alt"><?php echo get_the_title( $id ); ?></h5>
  </a>
</div>
