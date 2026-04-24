<?php

require get_template_directory() . '/inc/institutional-content.php';

function alatina_base_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'primary' => __('Menú principal', 'alatina-base'),
        'footer'  => __('Menú pie de página', 'alatina-base'),
    ));
}
add_action('after_setup_theme', 'alatina_base_setup');

function alatina_base_assets() {
    $theme   = wp_get_theme();
    $version = $theme->get('Version');

    wp_enqueue_style('alatina-base-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');
    wp_enqueue_style('alatina-base-style', get_stylesheet_uri(), array(), $version);
    wp_enqueue_style(
        'alatina-base-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array('alatina-base-bootstrap', 'alatina-base-style'),
        $version
    );

    wp_enqueue_script('alatina-base-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true);
    wp_enqueue_script('alatina-base-main', get_template_directory_uri() . '/assets/js/main.js', array('alatina-base-bootstrap'), $version, true);
}
add_action('wp_enqueue_scripts', 'alatina_base_assets');

function alatina_base_output_site_icons() {
    $icon_url = get_template_directory_uri() . '/assets/images/escudo-america-latina.svg';
    $manifest_url = get_template_directory_uri() . '/assets/images/site.webmanifest';
    echo '<link rel="icon" href="' . esc_url($icon_url) . '" type="image/svg+xml">' . "\n";
    echo '<link rel="shortcut icon" href="' . esc_url($icon_url) . '" type="image/svg+xml">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($icon_url) . '">' . "\n";
    echo '<link rel="manifest" href="' . esc_url($manifest_url) . '">' . "\n";
}
add_action('wp_head', 'alatina_base_output_site_icons', 5);

function alatina_base_sanitize_multiline_text($value) {
    $lines = preg_split('/\r\n|\r|\n/', (string) $value);
    $lines = array_map('sanitize_text_field', $lines);

    return implode("\n", $lines);
}

function alatina_base_get_hero_slides_defaults() {
    $hero_asset_base = get_template_directory_uri() . '/assets/images';

    return array(
        array(
            'tag'       => __('Destacado institucional', 'alatina-base'),
            'eyebrow'   => __('Inicio de año', 'alatina-base'),
            'title'     => __('Bienvenida al año escolar 2026', 'alatina-base'),
            'text'      => __('Inicio del ciclo con foco en convivencia, organización pedagógica y acompañamiento a estudiantes y familias.', 'alatina-base'),
            'url'       => alatina_base_get_page_url('noticias'),
            'image'     => $hero_asset_base . '/hero-slide-welcome.svg',
            'image_alt' => __('Ilustración institucional de bienvenida al año escolar', 'alatina-base'),
            'class'     => 'hero-news-slide--welcome',
        ),
        array(
            'tag'       => __('Hito reciente', 'alatina-base'),
            'eyebrow'   => __('Logro destacado', 'alatina-base'),
            'title'     => __('Reconocimiento a trayectoria académica', 'alatina-base'),
            'text'      => __('Un hito reciente que refleja compromiso pedagógico, esfuerzo estudiantil y trabajo sostenido de la comunidad educativa.', 'alatina-base'),
            'url'       => alatina_base_get_page_url('noticias'),
            'image'     => $hero_asset_base . '/hero-slide-achievement.svg',
            'image_alt' => __('Ilustración de logro destacado en contexto escolar', 'alatina-base'),
            'class'     => 'hero-news-slide--achievement',
        ),
        array(
            'tag'       => __('Vida escolar', 'alatina-base'),
            'eyebrow'   => __('Actividad escolar', 'alatina-base'),
            'title'     => __('Jornada formativa y participación escolar', 'alatina-base'),
            'text'      => __('Espacio de encuentro para reforzar convivencia, actividades formativas y participación activa de toda la comunidad.', 'alatina-base'),
            'url'       => alatina_base_get_page_url('noticias'),
            'image'     => $hero_asset_base . '/hero-slide-activity.svg',
            'image_alt' => __('Ilustración de actividad institucional y participación escolar', 'alatina-base'),
            'class'     => 'hero-news-slide--activity',
        ),
    );
}

function alatina_base_get_hero_slides() {
    $defaults = alatina_base_get_hero_slides_defaults();
    $slides   = array();

    for ($i = 1; $i <= 3; $i++) {
        $default = isset($defaults[$i - 1]) ? $defaults[$i - 1] : array();

        $slides[] = array(
            'tag'       => get_theme_mod("hero_slide_{$i}_tag", isset($default['tag']) ? $default['tag'] : ''),
            'eyebrow'   => get_theme_mod("hero_slide_{$i}_eyebrow", isset($default['eyebrow']) ? $default['eyebrow'] : ''),
            'title'     => get_theme_mod("hero_slide_{$i}_title", isset($default['title']) ? $default['title'] : ''),
            'text'      => get_theme_mod("hero_slide_{$i}_text", isset($default['text']) ? $default['text'] : ''),
            'url'       => get_theme_mod("hero_slide_{$i}_url", isset($default['url']) ? $default['url'] : ''),
            'image'     => get_theme_mod("hero_slide_{$i}_image", isset($default['image']) ? $default['image'] : ''),
            'image_alt' => get_theme_mod("hero_slide_{$i}_image_alt", isset($default['image_alt']) ? $default['image_alt'] : ''),
            'class'     => isset($default['class']) ? $default['class'] : '',
        );
    }

    return $slides;
}

function alatina_base_register_theme_customizer($wp_customize) {
    $wp_customize->add_panel('alatina_base_panel', array(
        'title'       => __('Alatina Base', 'alatina-base'),
        'description' => __('Ajustes editables de home, header y footer.', 'alatina-base'),
        'priority'    => 160,
    ));

    $sections = array(
        'alatina_branding'         => __('Marca y header', 'alatina-base'),
        'alatina_home_hero'        => __('Home · Hero', 'alatina-base'),
        'alatina_home_hero_slides' => __('Home · Hero destacados', 'alatina-base'),
        'alatina_home_events'      => __('Home · Eventos destacados', 'alatina-base'),
        'alatina_home_news'        => __('Home · Noticias y hitos', 'alatina-base'),
        'alatina_home_links'       => __('Home · Enlaces rápidos', 'alatina-base'),
        'alatina_footer'           => __('Footer', 'alatina-base'),
    );

    foreach ($sections as $id => $title) {
        $wp_customize->add_section($id, array(
            'title' => $title,
            'panel' => 'alatina_base_panel',
        ));
    }

    $text_settings = array(
        'header_topbar_label'      => array('section' => 'alatina_branding', 'label' => __('Header superior · Texto institucional', 'alatina-base')),
        'header_badge_text'        => array('section' => 'alatina_branding', 'label' => __('Header superior · Insignia', 'alatina-base')),
        'header_fallback_tagline'  => array('section' => 'alatina_branding', 'label' => __('Header · Bajada alternativa', 'alatina-base')),
        'header_toplink_1_label'   => array('section' => 'alatina_branding', 'label' => __('Header superior · Enlace 1 texto', 'alatina-base')),
        'header_toplink_2_label'   => array('section' => 'alatina_branding', 'label' => __('Header superior · Enlace 2 texto', 'alatina-base')),
        'header_toplink_3_label'   => array('section' => 'alatina_branding', 'label' => __('Header superior · Enlace 3 texto', 'alatina-base')),
        'header_cta_label'         => array('section' => 'alatina_branding', 'label' => __('Header · Botón principal texto', 'alatina-base')),
        'home_hero_eyebrow'        => array('section' => 'alatina_home_hero', 'label' => __('Hero · Antetítulo', 'alatina-base')),
        'home_hero_title'          => array('section' => 'alatina_home_hero', 'label' => __('Hero · Título', 'alatina-base')),
        'home_hero_text'           => array('section' => 'alatina_home_hero', 'label' => __('Hero · Texto', 'alatina-base'), 'type' => 'textarea'),
        'home_message_eyebrow'     => array('section' => 'alatina_home_hero', 'label' => __('Mensaje destacado · Antetítulo', 'alatina-base')),
        'home_message_title'       => array('section' => 'alatina_home_hero', 'label' => __('Mensaje destacado · Título', 'alatina-base')),
        'home_message_text'        => array('section' => 'alatina_home_hero', 'label' => __('Mensaje destacado · Texto', 'alatina-base'), 'type' => 'textarea'),
        'home_hero_primary_label'  => array('section' => 'alatina_home_hero', 'label' => __('Hero · Botón principal texto', 'alatina-base')),
        'home_hero_secondary_label'=> array('section' => 'alatina_home_hero', 'label' => __('Hero · Botón secundario texto', 'alatina-base')),
        'home_news_heading'        => array('section' => 'alatina_home_news', 'label' => __('Noticias · Título', 'alatina-base')),
        'home_news_text'           => array('section' => 'alatina_home_news', 'label' => __('Noticias · Texto', 'alatina-base'), 'type' => 'textarea'),
        'home_news_action_label'   => array('section' => 'alatina_home_news', 'label' => __('Noticias · Botón texto', 'alatina-base')),
        'home_milestones_heading'  => array('section' => 'alatina_home_news', 'label' => __('Hitos · Título', 'alatina-base')),
        'home_milestones_text'     => array('section' => 'alatina_home_news', 'label' => __('Hitos · Texto', 'alatina-base'), 'type' => 'textarea'),
        'home_links_heading'       => array('section' => 'alatina_home_links', 'label' => __('Enlaces importantes · Título', 'alatina-base')),
        'home_links_text'          => array('section' => 'alatina_home_links', 'label' => __('Enlaces importantes · Texto', 'alatina-base'), 'type' => 'textarea'),
        'footer_description'       => array('section' => 'alatina_footer', 'label' => __('Footer · Descripción', 'alatina-base'), 'type' => 'textarea'),
        'footer_cta_label'         => array('section' => 'alatina_footer', 'label' => __('Footer · Botón texto', 'alatina-base')),
        'footer_contact_heading'   => array('section' => 'alatina_footer', 'label' => __('Footer · Título contacto', 'alatina-base')),
        'footer_links_heading'     => array('section' => 'alatina_footer', 'label' => __('Footer · Título accesos útiles', 'alatina-base')),
        'footer_bottom_text'       => array('section' => 'alatina_footer', 'label' => __('Footer · Texto inferior', 'alatina-base'), 'type' => 'textarea'),
    );

    foreach ($text_settings as $key => $config) {
        $defaults = alatina_base_get_default_content();
        $type     = isset($config['type']) ? $config['type'] : 'text';
        $sanitize = ('textarea' === $type) ? 'sanitize_textarea_field' : 'sanitize_text_field';

        $wp_customize->add_setting($key, array(
            'default'           => isset($defaults[$key]) ? $defaults[$key] : '',
            'sanitize_callback' => $sanitize,
        ));

        $wp_customize->add_control($key, array(
            'label'   => $config['label'],
            'section' => $config['section'],
            'type'    => $type,
        ));
    }

    $url_settings = array(
        'header_toplink_1_url'   => array('section' => 'alatina_branding', 'label' => __('Header superior · Enlace 1 URL', 'alatina-base')),
        'header_toplink_2_url'   => array('section' => 'alatina_branding', 'label' => __('Header superior · Enlace 2 URL', 'alatina-base')),
        'header_toplink_3_url'   => array('section' => 'alatina_branding', 'label' => __('Header superior · Enlace 3 URL', 'alatina-base')),
        'header_cta_url'         => array('section' => 'alatina_branding', 'label' => __('Header · Botón principal URL', 'alatina-base')),
        'home_hero_primary_url'  => array('section' => 'alatina_home_hero', 'label' => __('Hero · Botón principal URL', 'alatina-base')),
        'home_hero_secondary_url'=> array('section' => 'alatina_home_hero', 'label' => __('Hero · Botón secundario URL', 'alatina-base')),
        'home_news_action_url'   => array('section' => 'alatina_home_news', 'label' => __('Noticias · Botón URL', 'alatina-base')),
        'footer_cta_url'         => array('section' => 'alatina_footer', 'label' => __('Footer · Botón URL', 'alatina-base')),
        'rrss_youtube_url'       => array('section' => 'alatina_branding', 'label' => __('RRSS · YouTube URL oficial', 'alatina-base')),
        'rrss_instagram_url'     => array('section' => 'alatina_branding', 'label' => __('RRSS · Instagram URL oficial', 'alatina-base')),
    );

    foreach ($url_settings as $key => $config) {
        $defaults = alatina_base_get_default_content();

        $wp_customize->add_setting($key, array(
            'default'           => isset($defaults[$key]) ? $defaults[$key] : '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control($key, array(
            'label'   => $config['label'],
            'section' => $config['section'],
            'type'    => 'url',
        ));
    }

    for ($i = 1; $i <= 3; $i++) {
        $hero_defaults = alatina_base_get_hero_slides_defaults();
        $default       = isset($hero_defaults[$i - 1]) ? $hero_defaults[$i - 1] : array();

        $hero_fields = array(
            'tag'       => array('label' => __('Hero destacado %d · Etiqueta', 'alatina-base'), 'type' => 'text', 'sanitize' => 'sanitize_text_field'),
            'eyebrow'   => array('label' => __('Hero destacado %d · Antetítulo', 'alatina-base'), 'type' => 'text', 'sanitize' => 'sanitize_text_field'),
            'title'     => array('label' => __('Hero destacado %d · Título', 'alatina-base'), 'type' => 'text', 'sanitize' => 'sanitize_text_field'),
            'text'      => array('label' => __('Hero destacado %d · Texto', 'alatina-base'), 'type' => 'textarea', 'sanitize' => 'sanitize_textarea_field'),
            'url'       => array('label' => __('Hero destacado %d · URL destino', 'alatina-base'), 'type' => 'url', 'sanitize' => 'esc_url_raw'),
            'image_alt' => array('label' => __('Hero destacado %d · Texto alternativo imagen', 'alatina-base'), 'type' => 'text', 'sanitize' => 'sanitize_text_field'),
            'image'     => array('label' => __('Hero destacado %d · Imagen', 'alatina-base'), 'type' => 'image', 'sanitize' => 'esc_url_raw'),
        );

        foreach ($hero_fields as $field => $config) {
            $setting_key = "hero_slide_{$i}_{$field}";

            $wp_customize->add_setting($setting_key, array(
                'default'           => isset($default[$field]) ? $default[$field] : '',
                'sanitize_callback' => $config['sanitize'],
            ));

            if ('image' === $config['type']) {
                $wp_customize->add_control(new WP_Customize_Image_Control(
                    $wp_customize,
                    $setting_key,
                    array(
                        'label'   => sprintf($config['label'], $i),
                        'section' => 'alatina_home_hero_slides',
                    )
                ));
                continue;
            }

            $wp_customize->add_control($setting_key, array(
                'label'   => sprintf($config['label'], $i),
                'section' => 'alatina_home_hero_slides',
                'type'    => $config['type'],
            ));
        }
    }

    for ($i = 1; $i <= 3; $i++) {
        $defaults = alatina_base_get_home_events();

        foreach (array('date', 'title', 'text', 'url') as $field) {
            $default  = isset($defaults[$i - 1][$field]) ? $defaults[$i - 1][$field] : '';
            $type     = ('url' === $field) ? 'url' : (('text' === $field) ? 'textarea' : 'text');
            $sanitize = ('url' === $field) ? 'esc_url_raw' : (('text' === $field) ? 'sanitize_textarea_field' : 'sanitize_text_field');
            $labels   = array(
                'date'  => __('Evento %d · Fecha breve', 'alatina-base'),
                'title' => __('Evento %d · Título', 'alatina-base'),
                'text'  => __('Evento %d · Texto', 'alatina-base'),
                'url'   => __('Evento %d · URL', 'alatina-base'),
            );
            $key = "event_{$i}_{$field}";

            $wp_customize->add_setting($key, array(
                'default'           => $default,
                'sanitize_callback' => $sanitize,
            ));

            $wp_customize->add_control($key, array(
                'label'   => sprintf($labels[$field], $i),
                'section' => 'alatina_home_events',
                'type'    => $type,
            ));
        }
    }

    for ($i = 1; $i <= 3; $i++) {
        $defaults = alatina_base_get_home_milestones();

        foreach (array('year', 'title', 'text') as $field) {
            $default  = isset($defaults[$i - 1][$field]) ? $defaults[$i - 1][$field] : '';
            $type     = ('text' === $field) ? 'textarea' : 'text';
            $sanitize = ('text' === $field) ? 'sanitize_textarea_field' : 'sanitize_text_field';
            $labels   = array(
                'year'  => __('Hito %d · Año o fecha', 'alatina-base'),
                'title' => __('Hito %d · Título', 'alatina-base'),
                'text'  => __('Hito %d · Texto', 'alatina-base'),
            );
            $key = "milestone_{$i}_{$field}";

            $wp_customize->add_setting($key, array(
                'default'           => $default,
                'sanitize_callback' => $sanitize,
            ));

            $wp_customize->add_control($key, array(
                'label'   => sprintf($labels[$field], $i),
                'section' => 'alatina_home_news',
                'type'    => $type,
            ));
        }
    }

    for ($i = 1; $i <= 4; $i++) {
        $defaults = alatina_base_get_quick_access_items();

        foreach (array('eyebrow', 'title', 'text', 'cta', 'url') as $field) {
            $default  = isset($defaults[$i - 1][$field]) ? $defaults[$i - 1][$field] : '';
            $type     = ('url' === $field) ? 'url' : (('text' === $field) ? 'textarea' : 'text');
            $sanitize = ('url' === $field) ? 'esc_url_raw' : (('text' === $field) ? 'sanitize_textarea_field' : 'sanitize_text_field');
            $labels   = array(
                'eyebrow' => __('Enlace rápido %d · Antetítulo', 'alatina-base'),
                'title'   => __('Enlace rápido %d · Título', 'alatina-base'),
                'text'    => __('Enlace rápido %d · Texto', 'alatina-base'),
                'cta'     => __('Enlace rápido %d · CTA', 'alatina-base'),
                'url'     => __('Enlace rápido %d · URL', 'alatina-base'),
            );
            $key = "quicklink_{$i}_{$field}";

            $wp_customize->add_setting($key, array(
                'default'           => $default,
                'sanitize_callback' => $sanitize,
            ));

            $wp_customize->add_control($key, array(
                'label'   => sprintf($labels[$field], $i),
                'section' => 'alatina_home_links',
                'type'    => $type,
            ));
        }
    }

    for ($i = 1; $i <= 3; $i++) {
        $defaults = alatina_base_get_footer_utility_links();

        foreach (array('label', 'url') as $field) {
            $default = isset($defaults[$i - 1][$field]) ? $defaults[$i - 1][$field] : '';
            $key     = "footer_link_{$i}_{$field}";

            $wp_customize->add_setting($key, array(
                'default'           => $default,
                'sanitize_callback' => ('url' === $field) ? 'esc_url_raw' : 'sanitize_text_field',
            ));

            $wp_customize->add_control($key, array(
                'label'   => sprintf(
                    ('url' === $field) ? __('Footer enlace %d · URL', 'alatina-base') : __('Footer enlace %d · Texto', 'alatina-base'),
                    $i
                ),
                'section' => 'alatina_footer',
                'type'    => ('url' === $field) ? 'url' : 'text',
            ));
        }
    }

    $wp_customize->add_setting('contact_items', array(
        'default'           => implode("\n", alatina_base_get_contact_placeholders()),
        'sanitize_callback' => 'alatina_base_sanitize_multiline_text',
    ));

    $wp_customize->add_control('contact_items', array(
        'label'   => __('Contacto · Una línea por ítem', 'alatina-base'),
        'section' => 'alatina_footer',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'alatina_base_register_theme_customizer');

function alatina_base_get_required_pages() {
    return array(
        'historia'            => array('title' => __('Historia', 'alatina-base')),
        'quienes-somos'       => array('title' => __('Quienes somos', 'alatina-base')),
        'informacion-escolar' => array('title' => __('Información escolar', 'alatina-base')),
        'proyecto-educativo'  => array('title' => __('Proyecto educativo', 'alatina-base')),
        'mision-vision'       => array('title' => __('Misión y visión', 'alatina-base')),
        'reglamento-interno'  => array('title' => __('Reglamento interno', 'alatina-base')),
        'mapa-ubicacion'      => array('title' => __('Mapa o ubicación', 'alatina-base')),
        'noticias'            => array('title' => __('Noticias y avisos', 'alatina-base')),
        'documentos'          => array('title' => __('Documentos importantes', 'alatina-base')),
        'comunidad-educativa' => array('title' => __('Comunidad educativa', 'alatina-base')),
        'cgp'                 => array('title' => __('CGP', 'alatina-base')),
        'cgp-directiva'       => array('title' => __('Directiva', 'alatina-base')),
        'cgp-integrantes'     => array('title' => __('Integrantes CGP', 'alatina-base')),
        'cgp-transparencia'   => array('title' => __('Transparencia CGP', 'alatina-base')),
        'cgp-noticias'        => array('title' => __('Noticias CGP', 'alatina-base')),
        'cge'                 => array('title' => __('CGE', 'alatina-base')),
        'cge-integrantes'     => array('title' => __('Integrantes CGE', 'alatina-base')),
        'cge-transparencia'   => array('title' => __('Transparencia CGE', 'alatina-base')),
        'cge-noticias'        => array('title' => __('Noticias CGE', 'alatina-base')),
        'cgp-proyectos'       => array('title' => __('Proyectos', 'alatina-base')),
        'cgp-avances'         => array('title' => __('Avances', 'alatina-base')),
        'cgp-acciones'        => array('title' => __('Acciones', 'alatina-base')),
        'cgp-galeria'         => array('title' => __('Galería', 'alatina-base')),
        'contacto'            => array('title' => __('Contacto', 'alatina-base')),
        'rrss-youtube'        => array('title' => __('YouTube', 'alatina-base')),
        'rrss-instagram'      => array('title' => __('Instagram', 'alatina-base')),
        'galeria'             => array('title' => __('Galería', 'alatina-base')),
    );
}

function alatina_base_sync_required_pages() {
    foreach (alatina_base_get_required_pages() as $slug => $page_data) {
        $existing = get_page_by_path($slug, OBJECT, 'page');

        if ($existing instanceof WP_Post) {
            $update = array('ID' => $existing->ID);

            if ('publish' !== $existing->post_status) {
                $update['post_status'] = 'publish';
            }

            if ($existing->post_title !== $page_data['title']) {
                $update['post_title'] = $page_data['title'];
            }

            if (count($update) > 1) {
                wp_update_post($update);
            }
            continue;
        }

        wp_insert_post(array(
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $page_data['title'],
            'post_name'    => $slug,
            'post_content' => '',
        ));
    }
}

function alatina_base_sync_navigation_menus() {
    $locations = get_theme_mod('nav_menu_locations', array());

    $menus_to_sync = array(
        'primary' => __('Menú principal', 'alatina-base'),
        'footer'  => __('Menú pie de página', 'alatina-base'),
    );

    foreach ($menus_to_sync as $location => $menu_name) {
        $menu = wp_get_nav_menu_object($menu_name);
        if (!$menu) {
            $menu_id = wp_create_nav_menu($menu_name);
            $menu    = wp_get_nav_menu_object($menu_id);
        }

        if (!$menu || is_wp_error($menu)) {
            continue;
        }

        $existing_items           = wp_get_nav_menu_items($menu->term_id);
        $existing_items_by_object = array();

        if ($existing_items) {
            foreach ($existing_items as $item) {
                if (empty($item->object_id)) {
                    continue;
                }

                $object_id = (int) $item->object_id;
                if (isset($existing_items_by_object[$object_id])) {
                    wp_delete_post((int) $item->ID, true);
                    continue;
                }

                $existing_items_by_object[$object_id] = $item;
            }
        }

        $navigation_items      = ('footer' === $location) ? alatina_base_get_footer_navigation_items() : alatina_base_get_navigation_items();
        $desired_primary_labels = array();

        if ('primary' === $location) {
            foreach ($navigation_items as $nav_item) {
                $desired_primary_labels[] = $nav_item['label'];
            }
        }

        foreach ($navigation_items as $position => $nav_item) {
            $slug       = isset($nav_item['slug']) ? $nav_item['slug'] : '';
            $custom_url = isset($nav_item['url']) ? $nav_item['url'] : '';
            $page_id    = empty($slug) ? (int) get_option('page_on_front') : 0;

            if (!empty($slug)) {
                $page    = get_page_by_path($slug, OBJECT, 'page');
                $page_id = $page instanceof WP_Post ? (int) $page->ID : 0;
            }

            if (!empty($custom_url)) {
                $existing_custom_item = null;
                if ($existing_items) {
                    foreach ($existing_items as $item) {
                        if ('custom' === $item->type && $item->title === $nav_item['label']) {
                            $existing_custom_item = $item;
                            break;
                        }
                    }
                }

                $menu_item_args = array(
                    'menu-item-title'    => $nav_item['label'],
                    'menu-item-url'      => esc_url_raw($custom_url),
                    'menu-item-type'     => 'custom',
                    'menu-item-status'   => 'publish',
                    'menu-item-position' => $position + 1,
                );

                if ($existing_custom_item) {
                    wp_update_nav_menu_item($menu->term_id, $existing_custom_item->ID, $menu_item_args);
                } else {
                    wp_update_nav_menu_item($menu->term_id, 0, $menu_item_args);
                }
                continue;
            }

            if (!$page_id) {
                continue;
            }

            $menu_item_args = array(
                'menu-item-title'     => $nav_item['label'],
                'menu-item-object-id' => $page_id,
                'menu-item-object'    => 'page',
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish',
                'menu-item-position'  => $position + 1,
            );

            if (isset($existing_items_by_object[$page_id])) {
                $existing_item = $existing_items_by_object[$page_id];
                wp_update_nav_menu_item($menu->term_id, $existing_item->ID, $menu_item_args);
                continue;
            }

            wp_update_nav_menu_item($menu->term_id, 0, $menu_item_args);
        }

        if ('primary' === $location && $existing_items) {
            $refreshed_items = wp_get_nav_menu_items($menu->term_id);
            if ($refreshed_items) {
                foreach ($refreshed_items as $item) {
                    if (!in_array($item->title, $desired_primary_labels, true)) {
                        wp_delete_post((int) $item->ID, true);
                    }
                }
            }
        }

        $locations[$location] = (int) $menu->term_id;
    }

    set_theme_mod('nav_menu_locations', $locations);
}

function alatina_base_bootstrap_site_structure() {
    if ('1' === get_option('alatina_base_structure_ready')) {
        return;
    }

    alatina_base_sync_required_pages();

    $front_page = get_page_by_path('inicio', OBJECT, 'page');

    if (!$front_page instanceof WP_Post) {
        $front_page_id = wp_insert_post(array(
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => __('Inicio', 'alatina-base'),
            'post_name'    => 'inicio',
            'post_content' => '',
        ));
        $front_page = get_post($front_page_id);
    }

    if ($front_page instanceof WP_Post) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', (int) $front_page->ID);
    }

    update_option('permalink_structure', '/index.php/%postname%/');
    alatina_base_sync_navigation_menus();
    flush_rewrite_rules(false);
    update_option('alatina_base_structure_ready', '1');
}
add_action('init', 'alatina_base_bootstrap_site_structure', 20);

function alatina_base_refresh_navigation_labels() {
    alatina_base_sync_required_pages();
    alatina_base_sync_navigation_menus();
}
add_action('init', 'alatina_base_refresh_navigation_labels', 30);

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

function alatina_base_fix_gallery_slug() {
    if (get_option('alatina_base_gallery_slug_fixed') === '2') {
        return;
    }

    $pages = get_posts(array(
        'post_type'      => 'page',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'future', 'trash'),
        'posts_per_page' => -1,
        'orderby'        => 'ID',
        'order'          => 'ASC',
    ));

    $gallery_page = null;
    foreach ($pages as $page) {
        if ((int) $page->post_parent !== 0) {
            continue;
        }

        $is_gallery_candidate = (
            'galeria-2' === $page->post_name ||
            'galeria' === $page->post_name ||
            __('Galería', 'alatina-base') === $page->post_title ||
            'Galería' === $page->post_title ||
            'Galeria' === $page->post_title
        );

        if (!$is_gallery_candidate) {
            continue;
        }

        $gallery_page = $page;

        if ('galeria-2' === $page->post_name) {
            break;
        }
    }

    if (!$gallery_page instanceof WP_Post) {
        return;
    }

    $current_gallery = get_page_by_path('galeria', OBJECT, 'page');

    if ($current_gallery instanceof WP_Post && (int) $current_gallery->ID !== (int) $gallery_page->ID) {
        $fallback_slug = 'galeria-anterior-' . (int) $current_gallery->ID;
        wp_update_post(array(
            'ID'        => (int) $current_gallery->ID,
            'post_name' => sanitize_title($fallback_slug),
        ));
    }

    if ('galeria' !== $gallery_page->post_name) {
        wp_update_post(array(
            'ID'        => (int) $gallery_page->ID,
            'post_name' => 'galeria',
        ));
    }

    update_option('alatina_base_gallery_slug_fixed', '2', false);
}
add_action('init', 'alatina_base_fix_gallery_slug', 35);

function alatina_base_get_rrss_url($network) {
    $defaults = array(
        'youtube'   => '#',
        'instagram' => '#',
    );

    $key = 'rrss_' . sanitize_key($network) . '_url';
    $fallback = isset($defaults[$network]) ? $defaults[$network] : '#';

    return esc_url(get_theme_mod($key, $fallback));
}

function alatina_base_primary_menu_fallback() {
    echo '<ul id="primary-menu" class="navbar-nav primary-menu-list align-items-xl-center">';
    foreach (alatina_base_get_navigation_items() as $item) {
        $url = isset($item['url']) ? $item['url'] : alatina_base_get_page_url(isset($item['slug']) ? $item['slug'] : '');
        echo '<li class="menu-item nav-item"><a class="nav-link" href="' . esc_url($url) . '">' . esc_html($item['label']) . '</a></li>';
    }
    echo '</ul>';
}

function alatina_base_footer_menu_fallback() {
    echo '<ul class="menu menu--footer">';
    foreach (alatina_base_get_footer_navigation_items() as $item) {
        $url = isset($item['url']) ? $item['url'] : alatina_base_get_page_url(isset($item['slug']) ? $item['slug'] : '');
        echo '<li class="menu-item"><a href="' . esc_url($url) . '">' . esc_html($item['label']) . '</a></li>';
    }
    echo '</ul>';
}
