<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head> 
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php $favicon = get_theme_mod('favicon'); if(!empty($favicon)) { ?> 
  <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
  <?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<svg style="display: none;">
  <symbol id="close-icon-svg" xmlns="http://www.w3.org/2000/svg" width="22.886" height="30.651" viewBox="0 0 22.886 30.651">
    <g id="x" transform="translate(-0.057 0.335)">
      <path id="Line" d="M0,0,21.213,21.213" transform="translate(1 4)" stroke="#000" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1"/>
      <path id="Line_Copy" data-name="Line Copy" d="M15,0,0,25.981" transform="matrix(-0.966, -0.259, 0.259, -0.966, 15.382, 29.479)" stroke="#000" stroke-linecap="square" stroke-miterlimit="10" stroke-width="1"/>
    </g>
  </symbol>
</svg>
<?php 
$logoObj = get_field('hdlogo', 'options');
if( is_array($logoObj) ){
  $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
}else{
  $logo_tag = '';
}
?>
<div class="bdoverlay"></div>
<div class="headerCover"></div>
<header class="header" id="site-header" data-uri="<?php echo THEME_URI; ?>">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="header-inr clearfix">
            <div class="hdr-elements">
              
              <ul class="reset-list">
                <li class="hdr-cart-item">
                  <div>
                    <a href="<?php echo wc_get_cart_url(); ?>">
                    <?php 
                      if( WC()->cart->get_cart_contents_count() > 0 ){
                        echo sprintf ( '<span>%d</span>', WC()->cart->get_cart_contents_count() );
                      }else{
                        echo sprintf ( '<span>%d</span>', 0 );
                      }  
                    ?>
                    <i></i>
                    </a>
                  </div>
                </li>
                <li class="hdr-wishlist-item">
                  <div>
                    <a href="<?php echo esc_url( home_url('wishlist') );?>">
                      <i></i>
                    </a>
                  </div>
                </li>
                <li class="hdr-search-item">
                  <div>
                    <a href="#" class="hdr-search-btn">
                      <i></i>
                    </a>

                    <div class="hdr-search-popup">
                      <div class="close-icon">
                        <i>
                          <svg class="close-icon-svg" width="22.886" height="30.651" viewBox="0 0 22.886 30.651" fill="#000">
                            <use xlink:href="#close-icon-svg"></use>
                          </svg> 
                        </i>
                      </div>
                      <div class="hdr-search-popup-inr">

                        <div class="search-popup-con">
                          <h2>Looking for something?</h2>
                          <div class="search-popup-form">
                            <form>
                              <input type="search" placeholder="הקלידי שם של דגם, קולקציה, קטגוריה… ">
                              <button> חפשי </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </li>
              </ul>
            </div>
            <div class="logo">
              <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php echo $logo_tag; ?>
              </a>
            </div>
            <div class="hdr-menu rtl">
              <div class="line-icon show-sm">
                <span></span>
                <span></span>
                <span></span>
              </div>
              <nav class="main-nav">
                <div class="show-sm closebtn-cntlr">
                    <div class="closebtn">
                      <span></span>
                      <span></span>
                    </div>
                </div>
                <div class="main-nav-inr">
                <?php 
                  $menuOptions = array( 
                      'theme_location' => 'cbv_main_menu', 
                      'menu_class' => 'clearfix reset-list',
                      'container' => '',
                      'container_class' => ''
                    );
                  wp_nav_menu( $menuOptions ); 
                ?>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
  </div>
</header>