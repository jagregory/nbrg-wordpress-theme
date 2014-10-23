<?php
add_image_size('nbrg-player-thumbnail', 320, 325, array('left', 'top'));

register_sidebar( array(
  'name'        => __( 'Single Post Home Sidebar', 'nbrg' ),
  'id'        => 'single-post-home',
  'description'     => __( 'Single Post Homepage sidebar.', 'nbrg' ),
  'before_widget'   => '<aside id="%1$s" class="widget %2$s">',
  'after_widget'    => '</aside>',
  'before_title'    => '<h2 class="widget-title">',
  'after_title'     => '</h2>',
) );
