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

function alatina_base_get_navigation_items() {
    return array(
        array(
            'label' => __('Inicio', 'alatina-base'),
            'slug'  => '',
        ),
        array(
            'label' => __('Nuestra escuela', 'alatina-base'),
            'slug'  => 'nuestra-escuela',
        ),
        array(
            'label' => __('Noticias', 'alatina-base'),
            'slug'  => 'noticias',
        ),
        array(
            'label' => __('Documentos', 'alatina-base'),
            'slug'  => 'documentos',
        ),
        array(
            'label' => __('Contacto', 'alatina-base'),
            'slug'  => 'contacto',
        ),
    );
}

function alatina_base_get_section_links() {
    return array(
        'nuestra-escuela' => array(
            'label' => __('Nuestra escuela', 'alatina-base'),
            'slug'  => 'nuestra-escuela',
        ),
        'noticias' => array(
            'label' => __('Noticias', 'alatina-base'),
            'slug'  => 'noticias',
        ),
        'centro-de-padres' => array(
            'label' => __('Centro de Padres', 'alatina-base'),
            'slug'  => 'centro-de-padres',
        ),
        'documentos' => array(
            'label' => __('Documentos', 'alatina-base'),
            'slug'  => 'documentos',
        ),
        'contacto' => array(
            'label' => __('Contacto', 'alatina-base'),
            'slug'  => 'contacto',
        ),
    );
}

function alatina_base_get_page_url($slug = '') {
    if (empty($slug)) {
        return home_url('/');
    }

    $page = get_page_by_path($slug);

    if ($page instanceof WP_Post) {
        return get_permalink($page);
    }

    return home_url('/' . trim($slug, '/') . '/');
}

function alatina_base_primary_menu_fallback() {
    echo '<ul id="primary-menu" class="menu menu--primary">';

    foreach (alatina_base_get_navigation_items() as $item) {
        echo '<li class="menu-item"><a href="' . esc_url(alatina_base_get_page_url($item['slug'])) . '">' . esc_html($item['label']) . '</a></li>';
    }

    echo '</ul>';
}

function alatina_base_footer_menu_fallback() {
    echo '<ul class="menu menu--footer">';

    foreach (alatina_base_get_navigation_items() as $item) {
        echo '<li class="menu-item"><a href="' . esc_url(alatina_base_get_page_url($item['slug'])) . '">' . esc_html($item['label']) . '</a></li>';
    }

    echo '</ul>';
}
