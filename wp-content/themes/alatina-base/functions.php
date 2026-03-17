<?php

function alatina_base_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    register_nav_menus(array(
        'primary' => __('Menú principal', 'alatina-base'),
        'footer'  => __('Menú pie de página', 'alatina-base'),
    ));
}
add_action('after_setup_theme', 'alatina_base_setup');

function alatina_base_assets() {
    $theme = wp_get_theme();
    $version = $theme->get('Version');

    wp_enqueue_style(
        'alatina-base-style',
        get_stylesheet_uri(),
        array(),
        $version
    );

    wp_enqueue_style(
        'alatina-base-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array('alatina-base-style'),
        $version
    );

    wp_enqueue_script(
        'alatina-base-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $version,
        true
    );
}
add_action('wp_enqueue_scripts', 'alatina_base_assets');

function alatina_base_primary_menu_fallback() {
    echo '<ul id="primary-menu" class="menu menu--primary">';
    echo '<li class="menu-item"><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Inicio', 'alatina-base') . '</a></li>';
    echo '<li class="menu-item"><a href="' . esc_url(home_url('/nuestra-escuela/')) . '">' . esc_html__('Nuestra escuela', 'alatina-base') . '</a></li>';
    echo '<li class="menu-item"><a href="' . esc_url(home_url('/noticias/')) . '">' . esc_html__('Noticias', 'alatina-base') . '</a></li>';
    echo '<li class="menu-item"><a href="' . esc_url(home_url('/contacto/')) . '">' . esc_html__('Contacto', 'alatina-base') . '</a></li>';
    echo '</ul>';
}
