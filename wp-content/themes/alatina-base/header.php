<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
  <div class="wrap site-header__inner">
    <div class="branding">
      <a class="branding__link" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
        <span class="branding__title"><?php bloginfo('name'); ?></span>
        <?php if (get_bloginfo('description')) : ?>
          <span class="branding__tagline"><?php bloginfo('description'); ?></span>
        <?php endif; ?>
      </a>
    </div>

    <button
      class="nav-toggle"
      type="button"
      aria-expanded="false"
      aria-controls="site-navigation"
      data-nav-toggle
    >
      <span class="nav-toggle__label"><?php esc_html_e('Menú', 'alatina-base'); ?></span>
      <span class="nav-toggle__icon" aria-hidden="true"></span>
    </button>

    <nav id="site-navigation" class="site-navigation" aria-label="<?php esc_attr_e('Menú principal', 'alatina-base'); ?>">
      <?php
      wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_id'        => 'primary-menu',
          'menu_class'     => 'menu menu--primary',
          'container'      => false,
          'fallback_cb'    => 'alatina_base_primary_menu_fallback',
      ));
      ?>
    </nav>
  </div>
</header>
