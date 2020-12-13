<?php 
  $telefoon = get_field('telephone', 'options');
  $email = get_field('email', 'options');
  $facebook_url = get_field('facebook_url', 'options');
  $instagram_url = get_field('instagram_url', 'options');
  $copyright_text = get_field('copyright_text', 'options');
?>
<footer class="footer-wrp">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
          <div class="ftr-cols">
            <div class="ftr-col ftr-col-1">
              <h6>מדיניות</h6>
              <?php 
                $fmenuOptions = array( 
                    'theme_location' => 'cbv_ft_menu', 
                    'menu_class' => 'reset-list',
                    'container' => '',
                    'container_class' => ''
                  );
                wp_nav_menu( $fmenuOptions );
              ?>
            </div>
            <div class="ftr-col contact-us-col ftr-col-2">
              <h6>צור קשר<h6>
              <ul class="reset-list">
                <?php 
                  if( !empty($email) ) printf('<li><a href="mailto:%s">%s</a></li>', $email, 'e-mail');
                  if( !empty($facebook_url) ) printf('<li><a href="%s">פייסבוק</a></li>', $facebook_url);
                  if( !empty($telefoon) ) printf('<li><a href="tel:%s">טלפון</a></li>', phone_preg($telefoon)); 
                  if( !empty($instagram_url) ) printf('<li><a href="%s"> אינסטגרם </a></li>', $instagram_url); 
                ?>
              </ul>
            </div>
            <div class="ftr-col ftr-col-3">
              <div class="ftr-newsletter-form">
                <form>
                  <input type="email" name="" placeholder="הצטרפי לניוזלטר">
                  <button>שלחי</button>
                </form>
              </div>
              <div class="copyright-text ltr">
                <?php if( !empty( $copyright_text ) ) printf( '%s', $copyright_text); ?> 
              </div>
            </div>
          </div>
      </div>
    </div>
  </div> 
</footer>
<?php wp_footer(); ?>
</body>
</html>