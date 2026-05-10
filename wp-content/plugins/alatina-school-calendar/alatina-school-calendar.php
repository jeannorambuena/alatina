<?php
/**
 * Plugin Name: Alatina School Calendar
 * Plugin URI: https://alatina.cl/
 * Description: Base inicial del calendario escolar institucional de Escuela América Latina.
 * Version: 0.1.0
 * Author: Jean Norambuena
 * Author URI: https://github.com/jeannorambuena
 * Text Domain: alatina-school-calendar
 */

if (!defined('ABSPATH')) {
    exit;
}

function alatina_school_calendar_register_post_type(): void
{
    $labels = array(
        'name'               => __('Calendario escolar', 'alatina-school-calendar'),
        'singular_name'      => __('Evento escolar', 'alatina-school-calendar'),
        'menu_name'          => __('Calendario escolar', 'alatina-school-calendar'),
        'name_admin_bar'     => __('Evento escolar', 'alatina-school-calendar'),
        'add_new'            => __('Agregar nuevo', 'alatina-school-calendar'),
        'add_new_item'       => __('Agregar evento escolar', 'alatina-school-calendar'),
        'new_item'           => __('Nuevo evento escolar', 'alatina-school-calendar'),
        'edit_item'          => __('Editar evento escolar', 'alatina-school-calendar'),
        'view_item'          => __('Ver evento escolar', 'alatina-school-calendar'),
        'all_items'          => __('Todos los eventos', 'alatina-school-calendar'),
        'search_items'       => __('Buscar eventos', 'alatina-school-calendar'),
        'not_found'          => __('No se encontraron eventos.', 'alatina-school-calendar'),
        'not_found_in_trash' => __('No hay eventos en la papelera.', 'alatina-school-calendar'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_admin_bar' => true,
        'menu_position'     => 25,
        'menu_icon'         => 'dashicons-calendar-alt',
        'supports'          => array('title', 'editor', 'custom-fields'),
        'has_archive'       => false,
        'rewrite'           => false,
        'show_in_rest'      => true,
        'rest_base'         => 'alatina_event',
    );

    register_post_type('alatina_event', $args);
}
add_action('init', 'alatina_school_calendar_register_post_type');

function alatina_school_calendar_register_event_taxonomy(): void
{
    $labels = array(
        'name'              => __('Tipos de evento', 'alatina-school-calendar'),
        'singular_name'     => __('Tipo de evento', 'alatina-school-calendar'),
        'search_items'      => __('Buscar tipos de evento', 'alatina-school-calendar'),
        'all_items'         => __('Todos los tipos de evento', 'alatina-school-calendar'),
        'edit_item'         => __('Editar tipo de evento', 'alatina-school-calendar'),
        'update_item'       => __('Actualizar tipo de evento', 'alatina-school-calendar'),
        'add_new_item'      => __('Agregar tipo de evento', 'alatina-school-calendar'),
        'new_item_name'     => __('Nuevo tipo de evento', 'alatina-school-calendar'),
        'menu_name'         => __('Tipos de evento', 'alatina-school-calendar'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'hierarchical'      => true,
        'rewrite'           => false,
        'show_in_rest'      => true,
    );

    register_taxonomy('alatina_event_category', array('alatina_event'), $args);
}
add_action('init', 'alatina_school_calendar_register_event_taxonomy');

function alatina_school_calendar_seed_default_categories(): void
{
    if (!taxonomy_exists('alatina_event_category')) {
        return;
    }

    $default_terms = array(
        'actividades'  => 'Actividades',
        'reuniones'    => 'Reuniones',
        'evaluaciones' => 'Evaluaciones',
        'vacaciones'   => 'Vacaciones',
        'informativos' => 'Informativos',
        'efemerides'   => 'Efemérides',
    );

    foreach ($default_terms as $slug => $label) {
        if (!term_exists($slug, 'alatina_event_category')) {
            wp_insert_term($label, 'alatina_event_category', array('slug' => $slug));
        }
    }
}
add_action('init', 'alatina_school_calendar_seed_default_categories', 20);

function alatina_school_calendar_strip_emoji(string $value): string
{
    $clean = preg_replace('/[\x{1F000}-\x{1FAFF}\x{2600}-\x{27BF}]/u', '', $value);
    return is_string($clean) ? $clean : $value;
}

function alatina_school_calendar_mb_strlen(string $value): int
{
    if (function_exists('mb_strlen')) {
        return (int) mb_strlen($value, 'UTF-8');
    }

    return strlen($value);
}

function alatina_school_calendar_mb_substr(string $value, int $start, int $length): string
{
    if (function_exists('mb_substr')) {
        return (string) mb_substr($value, $start, $length, 'UTF-8');
    }

    return substr($value, $start, $length);
}

function alatina_school_calendar_normalize_short_label(string $value): string
{
    $value = wp_strip_all_tags($value);
    $value = str_replace(array("
", "
", "	"), ' ', $value);
    $value = preg_replace('/\s+/u', ' ', $value);
    $value = is_string($value) ? trim($value) : '';
    $value = alatina_school_calendar_strip_emoji($value);
    $value = trim($value);

    if ($value === '') {
        return '';
    }

    if (alatina_school_calendar_mb_strlen($value) > 28) {
        $value = rtrim(alatina_school_calendar_mb_substr($value, 0, 25)) . '...';
    }

    return $value;
}

function alatina_school_calendar_get_short_label(int $post_id, string $title = ''): string
{
    $stored = get_post_meta($post_id, '_alatina_event_short_label', true);
    if (is_string($stored) && trim($stored) !== '') {
        return alatina_school_calendar_normalize_short_label($stored);
    }

    return alatina_school_calendar_normalize_short_label($title);
}

function alatina_school_calendar_sanitize_event_date($value): string
{
    $value = is_string($value) ? trim($value) : '';

    if ($value === '') {
        return '';
    }

    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) ? $value : '';
}

function alatina_school_calendar_sanitize_all_day($value): string
{
    if ($value === true || $value === 1 || $value === '1' || $value === 'true') {
        return '1';
    }

    return '';
}

function alatina_school_calendar_sanitize_time_value($value): string
{
    $value = is_string($value) ? trim($value) : '';

    if ($value === '') {
        return '';
    }

    return preg_match('/^\d{2}:\d{2}$/', $value) ? $value : '';
}

function alatina_school_calendar_rest_meta_auth($allowed = null, $meta_key = '', $post_id = 0, $user_id = 0, $cap = '', $caps = array()): bool
{
    if ($post_id) {
        return current_user_can('edit_post', (int) $post_id);
    }

    return current_user_can('edit_posts');
}

function alatina_school_calendar_register_single_meta(string $meta_key, callable $sanitize_callback): void
{
    register_post_meta('alatina_event', $meta_key, array(
        'single'            => true,
        'type'              => 'string',
        'show_in_rest'      => array(
            'schema' => array(
                'type' => 'string',
                'context' => array('view', 'edit'),
            ),
        ),
        'sanitize_callback' => $sanitize_callback,
        'auth_callback'     => 'alatina_school_calendar_rest_meta_auth',
    ));
}

function alatina_school_calendar_register_rest_meta(): void
{
    alatina_school_calendar_register_single_meta('_asc_event_date', 'alatina_school_calendar_sanitize_event_date');
    alatina_school_calendar_register_single_meta('_asc_all_day', 'alatina_school_calendar_sanitize_all_day');
    alatina_school_calendar_register_single_meta('_asc_start_time', 'alatina_school_calendar_sanitize_time_value');
    alatina_school_calendar_register_single_meta('_asc_end_time', 'alatina_school_calendar_sanitize_time_value');
    alatina_school_calendar_register_single_meta('_alatina_event_short_label', 'alatina_school_calendar_normalize_short_label');
}
add_action('init', 'alatina_school_calendar_register_rest_meta', 30);

function alatina_school_calendar_get_event_term_data(int $post_id): array
{
    $terms = wp_get_post_terms($post_id, 'alatina_event_category');

    if (is_wp_error($terms) || empty($terms)) {
        return array(
            'slug'  => 'default',
            'label' => 'General',
            'class' => 'alatina-school-calendar-event--default',
        );
    }

    $term = $terms[0];
    $slug = sanitize_html_class($term->slug);

    return array(
        'slug'  => $slug,
        'label' => $term->name,
        'class' => 'alatina-school-calendar-event--' . $slug,
    );
}

function alatina_school_calendar_add_meta_boxes(): void
{
    add_meta_box(
        'alatina_school_calendar_event_details',
        __('Detalles del evento', 'alatina-school-calendar'),
        'alatina_school_calendar_render_event_details_metabox',
        'alatina_event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'alatina_school_calendar_add_meta_boxes');

function alatina_school_calendar_render_event_details_metabox(WP_Post $post): void
{
    wp_nonce_field('alatina_school_calendar_save_event_details', 'alatina_school_calendar_event_nonce');

    $event_date = get_post_meta($post->ID, '_asc_event_date', true);
    $all_day    = get_post_meta($post->ID, '_asc_all_day', true);
    $start_time = get_post_meta($post->ID, '_asc_start_time', true);
    $end_time   = get_post_meta($post->ID, '_asc_end_time', true);
    $short_label = get_post_meta($post->ID, '_alatina_event_short_label', true);
    ?>
    <style>
        .asc-event-fields {
            display: grid;
            gap: 1rem;
            max-width: 760px;
        }
        .asc-event-field label {
            display: block;
            margin-bottom: 0.35rem;
            font-weight: 600;
        }
        .asc-event-field input[type="date"],
        .asc-event-field input[type="time"],
        .asc-event-field input[type="text"] {
            width: 100%;
            max-width: 260px;
        }
        .asc-event-field--checkbox label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0;
            font-weight: 600;
        }
        .asc-event-help {
            margin: 0.25rem 0 0 0;
            color: #646970;
        }
    </style>

    <div class="asc-event-fields">
        <div class="asc-event-field">
            <label for="asc_event_date"><?php esc_html_e('Fecha del evento', 'alatina-school-calendar'); ?></label>
            <input
                type="date"
                id="asc_event_date"
                name="asc_event_date"
                value="<?php echo esc_attr($event_date); ?>"
            />
            <p class="asc-event-help"><?php esc_html_e('Seleccione el día en que se mostrará este evento en el calendario.', 'alatina-school-calendar'); ?></p>
        </div>

        <div class="asc-event-field asc-event-field--checkbox">
            <label for="asc_all_day">
                <input
                    type="checkbox"
                    id="asc_all_day"
                    name="asc_all_day"
                    value="1"
                    <?php checked($all_day, '1'); ?>
                />
                <?php esc_html_e('Evento de todo el día', 'alatina-school-calendar'); ?>
            </label>
        </div>

        <div class="asc-event-field">
            <label for="asc_short_label"><?php esc_html_e('Texto corto visible', 'alatina-school-calendar'); ?></label>
            <input
                type="text"
                id="asc_short_label"
                name="asc_short_label"
                maxlength="28"
                value="<?php echo esc_attr((string) $short_label); ?>"
            />
            <p class="asc-event-help"><?php esc_html_e('Máximo 28 caracteres, sin saltos de línea. Se usa en la grilla del calendario.', 'alatina-school-calendar'); ?></p>
        </div>

        <div class="asc-event-field">
            <label for="asc_start_time"><?php esc_html_e('Hora de inicio', 'alatina-school-calendar'); ?></label>
            <input
                type="time"
                id="asc_start_time"
                name="asc_start_time"
                value="<?php echo esc_attr($start_time); ?>"
            />
        </div>

        <div class="asc-event-field">
            <label for="asc_end_time"><?php esc_html_e('Hora de término', 'alatina-school-calendar'); ?></label>
            <input
                type="time"
                id="asc_end_time"
                name="asc_end_time"
                value="<?php echo esc_attr($end_time); ?>"
            />
        </div>
    </div>
    <?php
}

function alatina_school_calendar_save_event_details(int $post_id): void
{
    if (!isset($_POST['alatina_school_calendar_event_nonce'])) {
        return;
    }

    $nonce = sanitize_text_field(wp_unslash($_POST['alatina_school_calendar_event_nonce']));
    if (!wp_verify_nonce($nonce, 'alatina_school_calendar_save_event_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!isset($_POST['post_type']) || $_POST['post_type'] !== 'alatina_event') {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $event_date = isset($_POST['asc_event_date']) ? sanitize_text_field(wp_unslash($_POST['asc_event_date'])) : '';
    $all_day    = isset($_POST['asc_all_day']) ? '1' : '';
    $start_time = isset($_POST['asc_start_time']) ? sanitize_text_field(wp_unslash($_POST['asc_start_time'])) : '';
    $end_time   = isset($_POST['asc_end_time']) ? sanitize_text_field(wp_unslash($_POST['asc_end_time'])) : '';
    $short_label = isset($_POST['asc_short_label']) ? alatina_school_calendar_normalize_short_label(sanitize_text_field(wp_unslash($_POST['asc_short_label']))) : '';

    if ($event_date !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $event_date)) {
        update_post_meta($post_id, '_asc_event_date', $event_date);
    } else {
        delete_post_meta($post_id, '_asc_event_date');
    }

    if ($all_day === '1') {
        update_post_meta($post_id, '_asc_all_day', '1');
    } else {
        delete_post_meta($post_id, '_asc_all_day');
    }

    if ($start_time !== '' && preg_match('/^\d{2}:\d{2}$/', $start_time)) {
        update_post_meta($post_id, '_asc_start_time', $start_time);
    } else {
        delete_post_meta($post_id, '_asc_start_time');
    }

    if ($end_time !== '' && preg_match('/^\d{2}:\d{2}$/', $end_time)) {
        update_post_meta($post_id, '_asc_end_time', $end_time);
    } else {
        delete_post_meta($post_id, '_asc_end_time');
    }

    if ($short_label !== '') {
        update_post_meta($post_id, '_alatina_event_short_label', $short_label);
    } else {
        delete_post_meta($post_id, '_alatina_event_short_label');
    }
}
add_action('save_post_alatina_event', 'alatina_school_calendar_save_event_details');

function alatina_school_calendar_get_requested_month(): DateTimeImmutable
{
    $timezone = wp_timezone();
    $today = new DateTimeImmutable('now', $timezone);

    $year = isset($_GET['asc_year']) ? absint(wp_unslash($_GET['asc_year'])) : (int) $today->format('Y');
    $month = isset($_GET['asc_month']) ? absint(wp_unslash($_GET['asc_month'])) : (int) $today->format('n');

    if ($year < 2020 || $year > 2035) {
        $year = (int) $today->format('Y');
    }

    if ($month < 1 || $month > 12) {
        $month = (int) $today->format('n');
    }

    return new DateTimeImmutable(sprintf('%04d-%02d-01', $year, $month), $timezone);
}

function alatina_school_calendar_get_events_for_month(DateTimeImmutable $current_month): array
{
    $month_start = $current_month->format('Y-m-01');
    $month_end   = $current_month->format('Y-m-t');

    $query = new WP_Query(array(
        'post_type'      => 'alatina_event',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => '_asc_event_date',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => '_asc_event_date',
                'value'   => array($month_start, $month_end),
                'compare' => 'BETWEEN',
                'type'    => 'DATE',
            ),
        ),
    ));

    $events_by_day = array();

    if ($query->have_posts()) {
        foreach ($query->posts as $event_post) {
            $event_date = get_post_meta($event_post->ID, '_asc_event_date', true);

            if (!is_string($event_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $event_date)) {
                continue;
            }

            $day = (int) substr($event_date, 8, 2);
            $all_day = get_post_meta($event_post->ID, '_asc_all_day', true) === '1';
            $start_time = (string) get_post_meta($event_post->ID, '_asc_start_time', true);
            $end_time = (string) get_post_meta($event_post->ID, '_asc_end_time', true);

            $time_label = 'Todo el día';
            if (!$all_day && $start_time !== '' && $end_time !== '') {
                $time_label = $start_time . ' - ' . $end_time;
            } elseif (!$all_day && $start_time !== '') {
                $time_label = $start_time;
            }

            if (!isset($events_by_day[$day])) {
                $events_by_day[$day] = array();
            }

            $term_data = alatina_school_calendar_get_event_term_data($event_post->ID);

            $full_title = get_the_title($event_post);
            $short_title = alatina_school_calendar_get_short_label($event_post->ID, $full_title);

            $events_by_day[$day][] = array(
                'id'             => $event_post->ID,
                'title'          => $full_title,
                'display_title'  => $short_title,
                'time_label'     => $time_label,
                'description'    => (string) $event_post->post_content,
                'category_slug'  => $term_data['slug'],
                'category_label' => $term_data['label'],
                'category_class' => $term_data['class'],
            );
        }
    }

    wp_reset_postdata();

    return $events_by_day;
}

function alatina_school_calendar_get_month_grid_data(): array
{
    $current_month = alatina_school_calendar_get_requested_month();
    $days_in_month = (int) $current_month->format('t');
    $events_by_day = alatina_school_calendar_get_events_for_month($current_month);

    $start_weekday = (int) $current_month->format('N');
    $leading_empty = $start_weekday - 1;

    $cells = array();

    for ($i = 0; $i < $leading_empty; $i++) {
        $cells[] = array(
            'type' => 'empty',
            'day'  => null,
        );
    }

    for ($day = 1; $day <= $days_in_month; $day++) {
        $date_string = $current_month->format('Y-m-') . str_pad((string) $day, 2, '0', STR_PAD_LEFT);

        $date_label_object = new DateTimeImmutable($date_string . ' 12:00:00', wp_timezone());

        $cells[] = array(
            'type'        => 'day',
            'day'         => $day,
            'date_string' => $date_string,
            'date_label'  => wp_date('j \\d\\e F \\d\\e Y', $date_label_object->getTimestamp(), wp_timezone()),
            'events'      => $events_by_day[$day] ?? array(),
        );
    }

    while (count($cells) % 7 !== 0) {
        $cells[] = array(
            'type' => 'empty',
            'day'  => null,
        );
    }

    $previous_month = $current_month->modify('-1 month');
    $next_month = $current_month->modify('+1 month');

    return array(
        'month_label'  => wp_date('F Y', $current_month->getTimestamp()),
        'weekdays'     => array('Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'),
        'cells'        => $cells,
        'previous_url' => add_query_arg(
            array(
                'asc_year'  => $previous_month->format('Y'),
                'asc_month' => $previous_month->format('n'),
            ),
            get_permalink()
        ),
        'next_url'     => add_query_arg(
            array(
                'asc_year'  => $next_month->format('Y'),
                'asc_month' => $next_month->format('n'),
            ),
            get_permalink()
        ),
    );
}

function alatina_school_calendar_cell_is_blocked(array $events): bool
{
    foreach ($events as $event) {
        if (($event['category_slug'] ?? '') === 'vacaciones') {
            return true;
        }
    }

    return false;
}

function alatina_school_calendar_render_shortcode($atts = array()): string
{
    $data = alatina_school_calendar_get_month_grid_data();

    ob_start();
    ?>
    <div class="alatina-school-calendar-shell" aria-label="Calendario escolar institucional">
        <style>
            .alatina-school-calendar-month { display: grid; gap: 0.75rem; }
            .alatina-school-calendar-month__header { display: grid; gap: 0.75rem; padding: 0.9rem 1rem; border: 1px solid #d6e3f1; border-radius: 16px; background: #f7fbff; }
            .alatina-school-calendar-month__topline { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
            .alatina-school-calendar-month__title { margin: 0; color: #16324f; font-size: 1.05rem; font-weight: 700; text-transform: capitalize; }
            .alatina-school-calendar-month__legend { margin: 0; color: #5c728a; font-size: 0.92rem; }
            .alatina-school-calendar-month__nav { display: flex; justify-content: space-between; gap: 0.75rem; flex-wrap: wrap; }
            .alatina-school-calendar-month__nav-link { display: inline-flex; align-items: center; justify-content: center; min-height: 2.5rem; padding: 0.65rem 0.95rem; border: 1px solid #cbdced; border-radius: 999px; background: #ffffff; color: #16324f; font-size: 0.9rem; font-weight: 600; text-decoration: none; }
            .alatina-school-calendar-month__nav-link:hover { background: #eef5fc; }

            .alatina-school-calendar-month__legend-row {
                display: flex;
                flex-wrap: wrap;
                gap: 0.55rem;
                margin-top: 0.15rem;
            }

            .alatina-school-calendar-legend-item {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                padding: 0.4rem 0.7rem;
                border-radius: 999px;
                border: 1px solid #d6e3f1;
                background: #ffffff;
                color: #16324f;
                font-size: 0.8rem;
                font-weight: 600;
                line-height: 1;
            }

            .alatina-school-calendar-legend-item__dot {
                width: 0.7rem;
                height: 0.7rem;
                border-radius: 999px;
                flex: 0 0 0.7rem;
                background: #24588f;
            }

            .alatina-school-calendar-legend-item--actividades .alatina-school-calendar-legend-item__dot { background: #2563eb; }
            .alatina-school-calendar-legend-item--reuniones .alatina-school-calendar-legend-item__dot { background: #16a34a; }
            .alatina-school-calendar-legend-item--evaluaciones .alatina-school-calendar-legend-item__dot { background: #e11d48; }
            .alatina-school-calendar-legend-item--vacaciones .alatina-school-calendar-legend-item__dot { background: #d97706; }
            .alatina-school-calendar-legend-item--informativos .alatina-school-calendar-legend-item__dot { background: #475569; }
            .alatina-school-calendar-legend-item--efemerides .alatina-school-calendar-legend-item__dot { background: #7c3aed; }

            .alatina-school-calendar-grid { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0.65rem; }
            .alatina-school-calendar-weekday { padding: 0.65rem 0.5rem; border-radius: 12px; background: #eaf2fb; color: #24588f; font-size: 0.82rem; font-weight: 700; text-align: center; text-transform: uppercase; letter-spacing: 0.04em; }

            .alatina-school-calendar-day,
            .alatina-school-calendar-day--interactive,
            .alatina-school-calendar-day--blocked,
            .alatina-school-calendar-day--empty {
                min-height: 132px;
                padding: 0.75rem;
                border-radius: 16px;
                border: 1px solid #d6e3f1;
                background: #ffffff;
            }

            .alatina-school-calendar-day--empty {
                background: #f8fbfe;
                border-style: dashed;
            }

            .alatina-school-calendar-day--interactive {
                width: 100%;
                text-align: left;
                cursor: pointer;
            }

            .alatina-school-calendar-day--interactive:hover {
                background: #f8fbff;
                box-shadow: 0 10px 24px rgba(16, 59, 102, 0.08);
            }

            .alatina-school-calendar-day--blocked {
                background: #fff7e6;
                border-color: #f3d39a;
                cursor: not-allowed;
                opacity: 0.96;
            }

            .alatina-school-calendar-day--blocked .alatina-school-calendar-day__number {
                background: #b45309;
            }

            .alatina-school-calendar-day--blocked .alatina-school-calendar-day__empty,
            .alatina-school-calendar-day--blocked .alatina-school-calendar-event__title,
            .alatina-school-calendar-day--blocked .alatina-school-calendar-event__time {
                color: #7c4a03;
            }

            .alatina-school-calendar-day--blocked:hover {
                box-shadow: none;
                background: #fff7e6;
            }

            .alatina-school-calendar-day__number {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 2rem;
                height: 2rem;
                border-radius: 999px;
                background: #103b66;
                color: #ffffff;
                font-size: 0.9rem;
                font-weight: 700;
            }

            .alatina-school-calendar-day__content {
                margin-top: 0.8rem;
                color: #647a90;
                font-size: 0.82rem;
                line-height: 1.4;
            }

            .alatina-school-calendar-day__empty { color: #647a90; }
            .alatina-school-calendar-day__events { display: grid; gap: 0.45rem; }

            .alatina-school-calendar-event {
                padding: 0.45rem 0.5rem;
                border-radius: 10px;
                background: #eef5fc;
                border: 1px solid #d6e3f1;
            }

            .alatina-school-calendar-event--actividades { background: #eef5ff; border-color: #c9dcff; box-shadow: inset 3px 0 0 #2563eb; }
            .alatina-school-calendar-event--reuniones { background: #effaf4; border-color: #c9ecd6; box-shadow: inset 3px 0 0 #16a34a; }
            .alatina-school-calendar-event--evaluaciones { background: #fff1f2; border-color: #fecdd3; box-shadow: inset 3px 0 0 #e11d48; }
            .alatina-school-calendar-event--vacaciones { background: #fff8e8; border-color: #fde7b0; box-shadow: inset 3px 0 0 #d97706; }
            .alatina-school-calendar-event--informativos { background: #f3f6fb; border-color: #d8e1ef; box-shadow: inset 3px 0 0 #475569; }
            .alatina-school-calendar-event--efemerides { background: #f4ecff; border-color: #ddccff; box-shadow: inset 3px 0 0 #7c3aed; }
            .alatina-school-calendar-event--default { background: #eef5fc; border-color: #d6e3f1; box-shadow: inset 3px 0 0 #24588f; }

            .alatina-school-calendar-event__time {
                display: block;
                margin-bottom: 0.15rem;
                color: #24588f;
                font-size: 0.7rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.03em;
            }

            .alatina-school-calendar-event__title {
                display: block;
                color: #16324f;
                font-size: 0.78rem;
                font-weight: 600;
                line-height: 1.35;
            }

            .alatina-school-calendar-event__more {
                color: #5c728a;
                font-size: 0.76rem;
                font-weight: 600;
            }

            .alatina-school-calendar-modal {
                position: fixed;
                inset: 0;
                display: none;
                align-items: center;
                justify-content: center;
                padding: 1rem;
                z-index: 9999;
            }

            .alatina-school-calendar-modal.is-open {
                display: flex;
            }

            .alatina-school-calendar-modal__backdrop {
                position: absolute;
                inset: 0;
                background: rgba(9, 26, 46, 0.62);
            }

            .alatina-school-calendar-modal__panel {
                position: relative;
                width: min(720px, 100%);
                max-height: 85vh;
                overflow: auto;
                padding: 1.25rem;
                border-radius: 24px;
                background: #ffffff;
                box-shadow: 0 24px 80px rgba(9, 26, 46, 0.28);
            }

            .alatina-school-calendar-modal__top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 1rem;
                margin-bottom: 1rem;
            }

            .alatina-school-calendar-modal__kicker {
                margin: 0 0 0.35rem 0;
                color: #24588f;
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .alatina-school-calendar-modal__title {
                margin: 0;
                color: #16324f;
                font-size: 1.3rem;
                line-height: 1.2;
            }

            .alatina-school-calendar-modal__close {
                border: 1px solid #d6e3f1;
                background: #ffffff;
                border-radius: 999px;
                padding: 0.55rem 0.85rem;
                color: #16324f;
                font-weight: 700;
                cursor: pointer;
            }

            .alatina-school-calendar-modal__list {
                display: grid;
                gap: 0.85rem;
            }

            .alatina-school-calendar-modal__event {
                padding: 0.9rem 1rem;
                border-radius: 16px;
                background: #f8fbff;
                border: 1px solid #d6e3f1;
            }

            .alatina-school-calendar-modal__event.alatina-school-calendar-event--actividades { background: #eef5ff; border-color: #c9dcff; }
            .alatina-school-calendar-modal__event.alatina-school-calendar-event--reuniones { background: #effaf4; border-color: #c9ecd6; }
            .alatina-school-calendar-modal__event.alatina-school-calendar-event--evaluaciones { background: #fff1f2; border-color: #fecdd3; }
            .alatina-school-calendar-modal__event.alatina-school-calendar-event--vacaciones { background: #fff8e8; border-color: #fde7b0; }
            .alatina-school-calendar-modal__event.alatina-school-calendar-event--informativos { background: #f3f6fb; border-color: #d8e1ef; }
            .alatina-school-calendar-modal__event.alatina-school-calendar-event--efemerides { background: #f4ecff; border-color: #ddccff; }

            .alatina-school-calendar-modal__event-time {
                display: inline-block;
                margin-bottom: 0.35rem;
                color: #24588f;
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .alatina-school-calendar-modal__event-title {
                margin: 0 0 0.45rem 0;
                color: #16324f;
                font-size: 1rem;
                line-height: 1.3;
            }

            .alatina-school-calendar-modal__event-category {
                display: inline-flex;
                align-items: center;
                margin-bottom: 0.45rem;
                padding: 0.2rem 0.55rem;
                border-radius: 999px;
                font-size: 0.72rem;
                font-weight: 700;
                letter-spacing: 0.03em;
                text-transform: uppercase;
                background: #e8f1fb;
                color: #24588f;
            }

            .alatina-school-calendar-modal__event-category--actividades { background: #dbeafe; color: #1d4ed8; }
            .alatina-school-calendar-modal__event-category--reuniones { background: #dcfce7; color: #15803d; }
            .alatina-school-calendar-modal__event-category--evaluaciones { background: #ffe4e6; color: #be123c; }
            .alatina-school-calendar-modal__event-category--vacaciones { background: #fef3c7; color: #b45309; }
            .alatina-school-calendar-modal__event-category--informativos { background: #e2e8f0; color: #475569; }
            .alatina-school-calendar-modal__event-category--efemerides { background: #ede9fe; color: #6d28d9; }
            .alatina-school-calendar-modal__event-category--default { background: #e8f1fb; color: #24588f; }

            .alatina-school-calendar-modal__event-description {
                color: #42566d;
                font-size: 0.94rem;
                line-height: 1.6;
            }

            @media (max-width: 900px) {
                .alatina-school-calendar-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .alatina-school-calendar-weekday { display: none; }
            }
        </style>

        <div class="alatina-school-calendar-month">
            <div class="alatina-school-calendar-month__header">
                <div class="alatina-school-calendar-month__topline">
                    <h3 class="alatina-school-calendar-month__title"><?php echo esc_html($data['month_label']); ?></h3>
                    <p class="alatina-school-calendar-month__legend">Calendario escolar mensual</p>
                </div>

                <div class="alatina-school-calendar-month__nav">
                    <a class="alatina-school-calendar-month__nav-link" href="<?php echo esc_url($data['previous_url']); ?>">← Mes anterior</a>
                    <a class="alatina-school-calendar-month__nav-link" href="<?php echo esc_url($data['next_url']); ?>">Mes siguiente →</a>
                </div>

                <div class="alatina-school-calendar-month__legend-row" aria-label="Leyenda de tipos de evento">
                    <span class="alatina-school-calendar-legend-item alatina-school-calendar-legend-item--actividades">
                        <span class="alatina-school-calendar-legend-item__dot" aria-hidden="true"></span>
                        <span>Actividades</span>
                    </span>
                    <span class="alatina-school-calendar-legend-item alatina-school-calendar-legend-item--reuniones">
                        <span class="alatina-school-calendar-legend-item__dot" aria-hidden="true"></span>
                        <span>Reuniones</span>
                    </span>
                    <span class="alatina-school-calendar-legend-item alatina-school-calendar-legend-item--evaluaciones">
                        <span class="alatina-school-calendar-legend-item__dot" aria-hidden="true"></span>
                        <span>Evaluaciones</span>
                    </span>
                    <span class="alatina-school-calendar-legend-item alatina-school-calendar-legend-item--vacaciones">
                        <span class="alatina-school-calendar-legend-item__dot" aria-hidden="true"></span>
                        <span>Vacaciones</span>
                    </span>
                    <span class="alatina-school-calendar-legend-item alatina-school-calendar-legend-item--informativos">
                        <span class="alatina-school-calendar-legend-item__dot" aria-hidden="true"></span>
                        <span>Informativos</span>
                    </span>
                    <span class="alatina-school-calendar-legend-item alatina-school-calendar-legend-item--efemerides">
                        <span class="alatina-school-calendar-legend-item__dot" aria-hidden="true"></span>
                        <span>Efemérides</span>
                    </span>
                </div>
            </div>

            <div class="alatina-school-calendar-grid" role="grid">
                <?php foreach ($data['weekdays'] as $weekday) : ?>
                    <div class="alatina-school-calendar-weekday" role="columnheader"><?php echo esc_html($weekday); ?></div>
                <?php endforeach; ?>

                <?php foreach ($data['cells'] as $cell) : ?>
                    <?php if ($cell['type'] === 'empty') : ?>
                        <div class="alatina-school-calendar-day--empty" aria-hidden="true"></div>
                    <?php elseif (!empty($cell['events'])) : ?>
                        <?php
                        $modal_id   = 'asc-modal-' . esc_attr(str_replace('-', '', $cell['date_string']));
                        $is_blocked = alatina_school_calendar_cell_is_blocked($cell['events']);
                        ?>
                        <?php if ($is_blocked) : ?>
                            <div
                                class="alatina-school-calendar-day alatina-school-calendar-day--blocked"
                                role="gridcell"
                                aria-label="<?php echo esc_attr('Día bloqueado por vacaciones: ' . $cell['date_label']); ?>"
                            >
                                <span class="alatina-school-calendar-day__number"><?php echo esc_html((string) $cell['day']); ?></span>

                                <div class="alatina-school-calendar-day__content">
                                    <div class="alatina-school-calendar-day__events">
                                        <?php
                                        $visible_events = array_slice($cell['events'], 0, 2);
                                        foreach ($visible_events as $event) :
                                            ?>
                                            <div class="alatina-school-calendar-event <?php echo esc_attr($event['category_class']); ?>">
                                                <span class="alatina-school-calendar-event__time"><?php echo esc_html($event['time_label']); ?></span>
                                                <span class="alatina-school-calendar-event__title"><?php echo esc_html($event['display_title'] ?? $event['title']); ?></span>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="alatina-school-calendar-day__empty">Receso / no disponible.</div>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <button
                                type="button"
                                class="alatina-school-calendar-day--interactive"
                                data-asc-modal-open="<?php echo esc_attr($modal_id); ?>"
                                aria-label="<?php echo esc_attr('Ver detalle del día ' . $cell['date_label']); ?>"
                            >
                                <span class="alatina-school-calendar-day__number"><?php echo esc_html((string) $cell['day']); ?></span>

                                <div class="alatina-school-calendar-day__content">
                                    <div class="alatina-school-calendar-day__events">
                                        <?php
                                        $visible_events = array_slice($cell['events'], 0, 2);
                                        foreach ($visible_events as $event) :
                                            ?>
                                            <div class="alatina-school-calendar-event <?php echo esc_attr($event['category_class']); ?>">
                                                <span class="alatina-school-calendar-event__time"><?php echo esc_html($event['time_label']); ?></span>
                                                <span class="alatina-school-calendar-event__title"><?php echo esc_html($event['display_title'] ?? $event['title']); ?></span>
                                            </div>
                                        <?php endforeach; ?>

                                        <?php if (count($cell['events']) > 2) : ?>
                                            <span class="alatina-school-calendar-event__more">
                                                <?php echo esc_html('+' . (count($cell['events']) - 2) . ' más'); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </button>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="alatina-school-calendar-day" role="gridcell" aria-label="<?php echo esc_attr('Día ' . $cell['day']); ?>">
                            <span class="alatina-school-calendar-day__number"><?php echo esc_html((string) $cell['day']); ?></span>
                            <div class="alatina-school-calendar-day__content">
                                <div class="alatina-school-calendar-day__empty">Sin actividades.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php foreach ($data['cells'] as $cell) : ?>
                <?php if ($cell['type'] !== 'day' || empty($cell['events']) || alatina_school_calendar_cell_is_blocked($cell['events'])) { continue; } ?>
                <?php $modal_id = 'asc-modal-' . str_replace('-', '', $cell['date_string']); ?>
                <div class="alatina-school-calendar-modal" id="<?php echo esc_attr($modal_id); ?>" aria-hidden="true">
                    <div class="alatina-school-calendar-modal__backdrop" data-asc-modal-close></div>

                    <div class="alatina-school-calendar-modal__panel" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr($modal_id . '-title'); ?>">
                        <div class="alatina-school-calendar-modal__top">
                            <div>
                                <p class="alatina-school-calendar-modal__kicker">Detalle del día</p>
                                <h4 class="alatina-school-calendar-modal__title" id="<?php echo esc_attr($modal_id . '-title'); ?>">
                                    <?php echo esc_html($cell['date_label']); ?>
                                </h4>
                            </div>

                            <button type="button" class="alatina-school-calendar-modal__close" data-asc-modal-close>
                                Cerrar
                            </button>
                        </div>

                        <div class="alatina-school-calendar-modal__list">
                            <?php foreach ($cell['events'] as $event) : ?>
                                <article class="alatina-school-calendar-modal__event <?php echo esc_attr($event['category_class']); ?>">
                                    <span class="alatina-school-calendar-modal__event-category <?php echo esc_attr('alatina-school-calendar-modal__event-category--' . $event['category_slug']); ?>">
                                        <?php echo esc_html($event['category_label']); ?>
                                    </span>
                                    <span class="alatina-school-calendar-modal__event-time"><?php echo esc_html($event['time_label']); ?></span>
                                    <h5 class="alatina-school-calendar-modal__event-title"><?php echo esc_html($event['title']); ?></h5>

                                    <?php if (trim(wp_strip_all_tags($event['description'])) !== '') : ?>
                                        <div class="alatina-school-calendar-modal__event-description">
                                            <?php echo wp_kses_post(wpautop($event['description'])); ?>
                                        </div>
                                    <?php endif; ?>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            (function () {
                const openButtons = document.querySelectorAll('[data-asc-modal-open]');
                const closeButtons = document.querySelectorAll('[data-asc-modal-close]');
                const modals = document.querySelectorAll('.alatina-school-calendar-modal');

                function closeAllModals() {
                    modals.forEach((modal) => {
                        modal.classList.remove('is-open');
                        modal.setAttribute('aria-hidden', 'true');
                    });
                    document.body.style.overflow = '';
                }

                openButtons.forEach((button) => {
                    button.addEventListener('click', () => {
                        const targetId = button.getAttribute('data-asc-modal-open');
                        const modal = document.getElementById(targetId);

                        if (!modal) {
                            return;
                        }

                        closeAllModals();
                        modal.classList.add('is-open');
                        modal.setAttribute('aria-hidden', 'false');
                        document.body.style.overflow = 'hidden';
                    });
                });

                closeButtons.forEach((button) => {
                    button.addEventListener('click', closeAllModals);
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeAllModals();
                    }
                });
            })();
        </script>
    </div>
    <?php

    return (string) ob_get_clean();
}

add_shortcode('alatina_school_calendar', 'alatina_school_calendar_render_shortcode');
