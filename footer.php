  </div>
</section>

<footer id="footer" class="site-footer">
  <?php do_action('themeboy_before_footer'); ?>
  <div class="row">
    <div class="large-12 columns">
      <?php printf( __( 'Site by %s. %s', 'nbrg' ), '<a href="http://www.jagregory.com/">' . __( 'James Gregory', 'nbrg' ) . '</a>', '<a href="mailto:james@jagregory.com">' . __('Get in touch', 'nbrg') . ' <span class="icon-mail"></span></a>' ); ?>
    </div>
  </div>
  <?php do_action('themeboy_after_footer'); ?>
</footer>
<a class="exit-off-canvas"></a>
  
  <?php do_action('themeboy_layout_end'); ?>
  </div>
</div>
<?php wp_footer(); ?>
<?php do_action('themeboy_before_closing_body'); ?>
</body>
</html>
