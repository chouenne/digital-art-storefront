<?php

//Load parent theme styles
add_action('wp_enqueue_scripts', 'xh_enqueue_styles');
function xh_enqueue_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_action('init', 'xh_remove_storefront_header_actions');
function xh_remove_storefront_header_actions()
{
  remove_action('storefront_header', 'storefront_header_container', 0);
  remove_action('storefront_header', 'storefront_skip_links', 5);
  remove_action('storefront_header', 'storefront_social_icons', 10);
  remove_action('storefront_header', 'storefront_site_branding', 20);
  remove_action('storefront_header', 'storefront_secondary_navigation', 30);
  remove_action('storefront_header', 'storefront_product_search', 40);
  remove_action('storefront_header', 'storefront_header_container_close', 41);
  remove_action('storefront_header', 'storefront_primary_navigation_wrapper', 42);
  remove_action('storefront_header', 'storefront_primary_navigation', 50);
  remove_action('storefront_header', 'storefront_header_cart', 60);
  remove_action('storefront_header', 'storefront_primary_navigation_wrapper_close', 68);
}



// add customer header
add_action('storefront_header', 'xh_custom_header', 10);
function xh_custom_header()
{
  ?>
  <div class="xh-header-wrapper">
    <div class="xh-header-top">
      <div class="xh-logo">
        <?php storefront_site_title_or_logo(); ?>
      </div>
      <nav class="xh-menu">
        <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
      </nav>
      <div class="xh-account-cart">
        <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">My Account</a>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>">Cart</a>
      </div>
    </div>
    <div class="xh-header-bottom">
      <?php get_product_search_form(); ?>
    </div>
  </div>
  <?php
}

//register menu
function xh_register_menus()
{
  register_nav_menu('primary', __('Primary Menu', 'xh-storefront-child'));
}
add_action('after_setup_theme', 'xh_register_menus');
