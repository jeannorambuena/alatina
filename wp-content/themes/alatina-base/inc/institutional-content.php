<?php

function alatina_base_get_default_content() {
    return array(
        'header_topbar_label' => __('Sitio escolar', 'alatina-base'),
        'header_badge_text' => __('Versión beta', 'alatina-base'),
        'header_fallback_tagline' => __('Comunidad educativa e información útil', 'alatina-base'),
        'header_toplink_1_label' => __('Apoderados', 'alatina-base'),
        'header_toplink_1_url' => '#',
        'header_toplink_2_label' => __('Calendario', 'alatina-base'),
        'header_toplink_2_url' => '#',
        'header_toplink_3_label' => __('Documentos', 'alatina-base'),
        'header_toplink_3_url' => alatina_base_get_page_url('documentos'),
        'header_cta_label' => __('Contacto', 'alatina-base'),
        'header_cta_url' => alatina_base_get_page_url('contacto'),
        'home_hero_eyebrow' => __('Escuela América Latina', 'alatina-base'),
        'home_hero_title' => __('Portada institucional con foco en información útil, comunidad educativa y navegación real', 'alatina-base'),
        'home_hero_text' => __('Bienvenido a la Escuela América Latina. Aquí encontrarás información institucional, noticias, documentos, calendario escolar y canales de comunicación con nuestra comunidad educativa. Explora las secciones para conocer nuestro proyecto educativo, actividades y modalidades de contacto.', 'alatina-base'),
        'home_hero_primary_label' => __('Explorar secciones clave', 'alatina-base'),
        'home_hero_primary_url' => home_url('/#enlaces-importantes'),
        'home_hero_secondary_label' => __('Ver contacto y admisión', 'alatina-base'),
        'home_hero_secondary_url' => alatina_base_get_page_url('contacto'),
        'home_message_eyebrow' => __('Mensaje institucional', 'alatina-base'),
        'home_message_title' => __('En la Escuela América Latina trabajamos por una formación integral que promueva el aprendizaje, la convivencia, el respeto y la participación activa de toda la comunidad educativa. Nuestro compromiso es acompañar a nuestros estudiantes en su desarrollo académico, personal y social, fortaleciendo valores, oportunidades y sentido de pertenencia.', 'alatina-base'),
        'home_message_text' => __('Se dejó un bloque preparado para reemplazar por la bienvenida oficial, misión, visión y sello institucional del establecimiento.', 'alatina-base'),
        'home_news_heading' => __('Noticias recientes de la comunidad educativa', 'alatina-base'),
        'home_news_text' => __('El bloque editorial prioriza últimas publicaciones con imagen destacada, fecha y acceso directo a cada noticia.', 'alatina-base'),
        'home_news_action_label' => __('Ver todas las noticias', 'alatina-base'),
        'home_news_action_url' => alatina_base_get_page_url('noticias'),
        'home_milestones_heading' => __('Hitos y avances relevantes del establecimiento', 'alatina-base'),
        'home_milestones_text' => __('Sección editorial para destacar actividades logradas, reconocimientos, aniversarios y avances institucionales.', 'alatina-base'),
        'home_links_heading' => __('Enlaces importantes para familias y comunidad escolar', 'alatina-base'),
        'home_links_text' => __('Accesos rápidos con iconografía clara y consistencia visual para orientar la navegación.', 'alatina-base'),
        'footer_description' => __('Escuela América Latina es un establecimiento municipal comprometido con la formación integral de sus estudiantes. Promueve el aprendizaje significativo, la convivencia respetuosa y la participación activa de la comunidad educativa en el desarrollo de cada trayectoria escolar.', 'alatina-base'),
        'footer_cta_label' => __('Solicitar orientación', 'alatina-base'),
        'footer_cta_url' => alatina_base_get_page_url('contacto'),
        'footer_contact_heading' => __('Contacto y admisión', 'alatina-base'),
        'footer_links_heading' => __('Accesos útiles', 'alatina-base'),
        'footer_bottom_text' => __('© 2026 Escuela América Latina. Comunidad educativa municipal comprometida con la formación integral y la excelencia pedagógica.', 'alatina-base'),
        'page_default_notice' => __('Información institucional en proceso de actualización.', 'alatina-base'),
    );
}

function alatina_base_get_theme_text($key) {
    $defaults = alatina_base_get_default_content();
    return get_theme_mod($key, isset($defaults[$key]) ? $defaults[$key] : '');
}

function alatina_base_get_theme_url($key) {
    return esc_url(alatina_base_get_theme_text($key));
}

function alatina_base_get_theme_lines($key, $fallback = array()) {
    $raw = get_theme_mod($key, '');

    if (!is_string($raw) || trim($raw) === '') {
        return $fallback;
    }

    $lines = preg_split('/\r\n|\r|\n/', $raw);
    $lines = array_filter(array_map('trim', $lines));

    return array_values($lines);
}

function alatina_base_get_navigation_items() {
    return array(
        array('label' => __('Inicio', 'alatina-base'), 'slug' => ''),
        array('label' => __('Historia', 'alatina-base'), 'slug' => 'historia'),
        array('label' => __('Quienes somos', 'alatina-base'), 'url' => home_url('/#quienes-somos')),
        array('label' => __('Asignaturas', 'alatina-base'), 'url' => alatina_base_get_page_url('asignaturas')),
        array('label' => __('Información escolar', 'alatina-base'), 'url' => home_url('/#informacion-escolar')),
        array('label' => __('Noticias', 'alatina-base'), 'slug' => 'noticias'),
        array('label' => __('CGP', 'alatina-base'), 'slug' => 'comunidad-educativa'),
        array('label' => __('Contacto', 'alatina-base'), 'slug' => 'contacto'),
    );
}

function alatina_base_get_footer_navigation_items() {
    return array(
        array('label' => __('Historia', 'alatina-base'), 'slug' => 'historia'),
        array('label' => __('Proyecto educativo', 'alatina-base'), 'slug' => 'proyecto-educativo'),
        array('label' => __('Documentos', 'alatina-base'), 'slug' => 'documentos'),
        array('label' => __('Noticias', 'alatina-base'), 'slug' => 'noticias'),
        array('label' => __('Comunidad educativa', 'alatina-base'), 'slug' => 'comunidad-educativa'),
        array('label' => __('Contacto', 'alatina-base'), 'slug' => 'contacto'),
    );
}

function alatina_base_get_header_top_links() {
    return array(
        array('label' => alatina_base_get_theme_text('header_toplink_1_label'), 'url' => alatina_base_get_theme_url('header_toplink_1_url')),
        array('label' => alatina_base_get_theme_text('header_toplink_2_label'), 'url' => alatina_base_get_theme_url('header_toplink_2_url')),
        array('label' => alatina_base_get_theme_text('header_toplink_3_label'), 'url' => alatina_base_get_theme_url('header_toplink_3_url')),
    );
}

function alatina_base_get_quick_access_items() {
    return array(
        array(
            'icon'    => 'file-earmark-text',
            'eyebrow' => get_theme_mod('quicklink_1_eyebrow', __('Documentos', 'alatina-base')),
            'title'   => get_theme_mod('quicklink_1_title', __('Documentos institucionales', 'alatina-base')),
            'text'    => get_theme_mod('quicklink_1_text', __('Reglamentos, protocolos y archivos de consulta frecuente.', 'alatina-base')),
            'url'     => get_theme_mod('quicklink_1_url', alatina_base_get_page_url('documentos')),
            'cta'     => get_theme_mod('quicklink_1_cta', __('Abrir sección', 'alatina-base')),
        ),
        array(
            'icon'    => 'megaphone',
            'eyebrow' => get_theme_mod('quicklink_2_eyebrow', __('Circulares', 'alatina-base')),
            'title'   => get_theme_mod('quicklink_2_title', __('Noticias y avisos', 'alatina-base')),
            'text'    => get_theme_mod('quicklink_2_text', __('Comunicados, actividades y novedades para la comunidad escolar.', 'alatina-base')),
            'url'     => get_theme_mod('quicklink_2_url', alatina_base_get_page_url('noticias')),
            'cta'     => get_theme_mod('quicklink_2_cta', __('Ver avisos', 'alatina-base')),
        ),
        array(
            'icon'    => 'calendar-event',
            'eyebrow' => __('Calendario', 'alatina-base'),
            'title'   => __('Calendario escolar', 'alatina-base'),
            'text'    => __('Actividades, reuniones y fechas relevantes para seguimiento de familias y comunidad educativa.', 'alatina-base'),
            'url'     => alatina_base_get_page_url('calendario-escolar'),
            'cta'     => __('Ver calendario', 'alatina-base'),
        ),
        array(
            'icon'    => 'school',
            'eyebrow' => __('Asignaturas', 'alatina-base'),
            'title'   => __('Áreas de aprendizaje', 'alatina-base'),
            'text'    => __('[CONTENIDO TEMPORAL] Sección de asignaturas, talleres y orientación pedagógica en validación.', 'alatina-base'),
            'url'     => alatina_base_get_page_url('asignaturas'),
            'cta'     => __('Ver asignaturas', 'alatina-base'),
        ),
        array(
            'icon'    => 'people',
            'eyebrow' => __('Comunidad', 'alatina-base'),
            'title'   => __('Centro de padres y comunidad', 'alatina-base'),
            'text'    => __('Información útil para familias, estudiantes, docentes y asistentes sobre participación e integración en la comunidad educativa.', 'alatina-base'),
            'url'     => alatina_base_get_page_url('comunidad-educativa'),
            'cta'     => __('Ir a comunidad', 'alatina-base'),
        ),
        array(
            'icon'    => 'telephone',
            'eyebrow' => __('Contacto', 'alatina-base'),
            'title'   => __('Contacto y admisión', 'alatina-base'),
            'text'    => __('Canales de contacto, orientación y matrícula escolar para familias y apoderados.', 'alatina-base'),
            'url'     => alatina_base_get_page_url('contacto'),
            'cta'     => __('Ver orientación', 'alatina-base'),
        ),
    );
}

function alatina_base_get_highlight_documents() {
    return array(
        array(
            'eyebrow' => get_theme_mod('document_1_eyebrow', __('Documento prioritario', 'alatina-base')),
            'title'   => get_theme_mod('document_1_title', __('Reglamento interno y convivencia', 'alatina-base')),
            'text'    => get_theme_mod('document_1_text', __('Información en validación. Espacio reservado para reglamento vigente y versión descargable.', 'alatina-base')),
            'url'     => get_theme_mod('document_1_url', alatina_base_get_page_url('documentos')),
        ),
        array(
            'eyebrow' => get_theme_mod('document_2_eyebrow', __('Documento prioritario', 'alatina-base')),
            'title'   => get_theme_mod('document_2_title', __('Proyecto educativo institucional', 'alatina-base')),
            'text'    => get_theme_mod('document_2_text', __('[CONTENIDO TEMPORAL] Resumen ejecutivo y enlace al documento completo cuando esté validado.', 'alatina-base')),
            'url'     => get_theme_mod('document_2_url', alatina_base_get_page_url('proyecto-educativo')),
        ),
        array(
            'eyebrow' => get_theme_mod('document_3_eyebrow', __('Documento prioritario', 'alatina-base')),
            'title'   => get_theme_mod('document_3_title', __('Protocolos, formularios y circulares', 'alatina-base')),
            'text'    => get_theme_mod('document_3_text', __('Información en validación. Base lista para concentrar recursos oficiales por categoría.', 'alatina-base')),
            'url'     => get_theme_mod('document_3_url', alatina_base_get_page_url('documentos')),
        ),
    );
}

function alatina_base_get_contact_placeholders() {
    return alatina_base_get_theme_lines('contact_items', array(
        __('Teléfono institucional: 75 2431601', 'alatina-base'),
        __('Correo de contacto: direccionalatina@daemromeral.cl', 'alatina-base'),
        __('Dirección del establecimiento: Ruta J-55 Km 2, Avenida Ramón Freire 2004, Romeral. Entrada por Callejón Las Catreras.', 'alatina-base'),
        __('Horario de atención presencial: 08:30 a 17:30, horario continuado', 'alatina-base'),
    ));
}

function alatina_base_get_home_events() {
    return array(
        array(
            'date' => get_theme_mod('event_1_date', __('Próx. semana', 'alatina-base')),
            'title' => get_theme_mod('event_1_title', __('[CONTENIDO TEMPORAL] Reunión informativa para familias', 'alatina-base')),
            'text' => get_theme_mod('event_1_text', __('Espacio pensado para publicar actividades cercanas, avisos urgentes o hitos del calendario escolar.', 'alatina-base')),
            'url' => get_theme_mod('event_1_url', alatina_base_get_page_url('noticias')),
        ),
        array(
            'date' => get_theme_mod('event_2_date', __('Próximo evento', 'alatina-base')),
            'title' => get_theme_mod('event_2_title', __('Información en validación. Jornada de convivencia y participación', 'alatina-base')),
            'text' => get_theme_mod('event_2_text', __('Bloque rotativo para actividades institucionales, celebraciones o comunicados destacados.', 'alatina-base')),
            'url' => get_theme_mod('event_2_url', alatina_base_get_page_url('noticias')),
        ),
        array(
            'date' => get_theme_mod('event_3_date', __('Aviso relevante', 'alatina-base')),
            'title' => get_theme_mod('event_3_title', __('[CONTENIDO TEMPORAL] Actualización de calendario y trámites', 'alatina-base')),
            'text' => get_theme_mod('event_3_text', __('Sección preparada para mostrar lo más urgente de forma visible bajo el menú principal.', 'alatina-base')),
            'url' => get_theme_mod('event_3_url', alatina_base_get_page_url('contacto')),
        ),
    );
}

function alatina_base_get_home_milestones() {
    return array(
        array(
            'year' => get_theme_mod('milestone_1_year', '2025'),
            'title' => get_theme_mod('milestone_1_title', __('[CONTENIDO TEMPORAL] Actividad institucional destacada', 'alatina-base')),
            'text' => get_theme_mod('milestone_1_text', __('Espacio para registrar logros, aniversarios, reconocimientos o avances relevantes del establecimiento.', 'alatina-base')),
        ),
        array(
            'year' => get_theme_mod('milestone_2_year', '2024'),
            'title' => get_theme_mod('milestone_2_title', __('Información en validación. Reconocimiento o mejora relevante', 'alatina-base')),
            'text' => get_theme_mod('milestone_2_text', __('Puede mostrar hitos académicos, comunitarios o de infraestructura en una narrativa visual de portada.', 'alatina-base')),
        ),
        array(
            'year' => get_theme_mod('milestone_3_year', '2023'),
            'title' => get_theme_mod('milestone_3_title', __('[CONTENIDO TEMPORAL] Proyecto o aniversario institucional', 'alatina-base')),
            'text' => get_theme_mod('milestone_3_text', __('La sección está pensada como bloque editorial fuerte y no como simple listado plano.', 'alatina-base')),
        ),
    );
}

function alatina_base_get_footer_utility_links() {
    return array(
        array(
            'label' => get_theme_mod('footer_link_1_label', __('Documentos institucionales', 'alatina-base')),
            'url'   => get_theme_mod('footer_link_1_url', alatina_base_get_page_url('documentos')),
        ),
        array(
            'label' => get_theme_mod('footer_link_2_label', __('Noticias y avisos', 'alatina-base')),
            'url'   => get_theme_mod('footer_link_2_url', alatina_base_get_page_url('noticias')),
        ),
        array(
            'label' => get_theme_mod('footer_link_3_label', __('Proyecto educativo', 'alatina-base')),
            'url'   => get_theme_mod('footer_link_3_url', alatina_base_get_page_url('proyecto-educativo')),
        ),
    );
}

function alatina_base_get_bootstrap_icon($name) {
    $icons = array(
        'file-earmark-text' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M4 0h5l3 3v11a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm4 1v3h3"/><path d="M5 7h6M5 10h6M5 13h4"/></svg>',
        'megaphone' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M13 2v8l-5-2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h4l5-2z"/><path d="M6 8v4a2 2 0 0 0 2 2h1"/></svg>',
        'people' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M5.5 8A2.5 2.5 0 1 0 5.5 3a2.5 2.5 0 0 0 0 5zm5 0A2.5 2.5 0 1 0 10.5 3a2.5 2.5 0 0 0 0 5z"/><path d="M1 13a3.5 3.5 0 0 1 7 0v1H1zm7 1v-1a3.5 3.5 0 0 1 7 0v1z"/></svg>',
        'calendar-event' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M11 1v2M5 1v2M2 4h12M3 2h10a1 1 0 0 1 1 1v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a1 1 0 0 1 1-1z"/><path d="m7 8 1.5 1.5L11 7"/></svg>',
        'telephone' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M3 2h3l1 3-2 1a11 11 0 0 0 5 5l1-2 3 1v3a2 2 0 0 1-2 2A11 11 0 0 1 1 4a2 2 0 0 1 2-2z"/></svg>',
        'school' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="m8 1 7 3-7 3-7-3 7-3z"/><path d="M3 6v4c0 1.5 2.2 3 5 3s5-1.5 5-3V6"/><path d="M14 5v5"/></svg>',
        'clock-history' => '<svg viewBox="0 0 16 16" aria-hidden="true"><path d="M8 3a5 5 0 1 1-4.546 2.916"/><path d="M1 4v3h3"/><path d="M8 5v3l2 1"/></svg>',
    );

    return isset($icons[$name]) ? $icons[$name] : $icons['school'];
}

function alatina_base_get_page_models() {
    return array(
        'historia' => array(
            'eyebrow' => __('Historia institucional', 'alatina-base'),
            'lead'    => __('[CONTENIDO TEMPORAL] Página modelo para narrar origen, hitos y evolución del establecimiento con enfoque territorial y comunitario.', 'alatina-base'),
            'summary' => __('Estructura lista para consolidar cronología, identidad escolar y testimonios institucionales.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Origen del establecimiento', 'alatina-base'),'content' => array(__('[CONTENIDO TEMPORAL] Este bloque debe contar cuándo surge la escuela, qué necesidad educativa vino a cubrir y cómo se relaciona con su comunidad local.', 'alatina-base'),__('Información en validación. Se recomienda incorporar fecha de fundación, contexto territorial y primeras etapas de desarrollo.', 'alatina-base'))),
                array('title' => __('Línea de tiempo institucional', 'alatina-base'),'list' => array(__('Hito 1 — Fundación y apertura inicial del establecimiento. [CONTENIDO TEMPORAL]', 'alatina-base'),__('Hito 2 — Crecimiento de matrícula, niveles o infraestructura. Información en validación.', 'alatina-base'),__('Hito 3 — Consolidación de sellos formativos, proyectos o reconocimientos. [CONTENIDO TEMPORAL]', 'alatina-base'))),
                array('title' => __('Patrimonio e identidad', 'alatina-base'),'content' => array(__('Espacio preparado para símbolos, tradiciones, actividades emblemáticas y vínculo con exalumnos, familias y territorio.', 'alatina-base'))),
            ),
            'highlights' => array(__('Línea de tiempo editable', 'alatina-base'),__('Bloque para fotos históricas futuras', 'alatina-base'),__('Base para hitos institucionales verificables', 'alatina-base')),
        ),
        'proyecto-educativo' => array(
            'eyebrow' => __('Proyecto educativo', 'alatina-base'),
            'lead'    => __('[CONTENIDO TEMPORAL] Página modelo para explicar misión, visión, sellos y estrategia formativa del establecimiento.', 'alatina-base'),
            'summary' => __('Plantilla pensada para traducir el PEI a una lectura web clara y navegable.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Misión y visión', 'alatina-base'),'content' => array(__('Información en validación. Aquí debe ir la misión oficial del establecimiento en una versión corta y comprensible.', 'alatina-base'),__('Información en validación. Aquí debe ir la visión institucional y la proyección educativa de mediano plazo.', 'alatina-base'))),
                array('title' => __('Sellos formativos', 'alatina-base'),'list' => array(__('Formación integral con foco en convivencia y desarrollo personal. [CONTENIDO TEMPORAL]', 'alatina-base'),__('Compromiso con aprendizaje significativo, lectura y habilidades socioemocionales. [CONTENIDO TEMPORAL]', 'alatina-base'),__('Vinculación con familias y territorio como parte del proceso formativo. Información en validación.', 'alatina-base'))),
                array('title' => __('Prioridades de implementación', 'alatina-base'),'content' => array(__('Base preparada para mostrar objetivos anuales, acciones institucionales y evidencias de seguimiento.', 'alatina-base'))),
            ),
            'highlights' => array(__('Resumen ejecutivo del PEI', 'alatina-base'),__('Bloques para sellos y prioridades', 'alatina-base'),__('Espacio para descarga del documento oficial', 'alatina-base')),
        ),
        'noticias' => array(
            'eyebrow' => __('Noticias y avisos', 'alatina-base'),
            'lead'    => __('Página editorial para centralizar comunicados, actividades, recordatorios y publicaciones del establecimiento.', 'alatina-base'),
            'summary' => __('Funciona tanto con entradas reales de WordPress como con una estructura clara cuando aún no existan publicaciones.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Qué se publica aquí', 'alatina-base'),'list' => array(__('Comunicados oficiales a familias y estudiantes.', 'alatina-base'),__('Actividades institucionales, efemérides y agenda pública.', 'alatina-base'),__('Recordatorios académicos, administrativos o comunitarios.', 'alatina-base'))),
                array('title' => __('Criterio editorial sugerido', 'alatina-base'),'content' => array(__('[CONTENIDO TEMPORAL] Cada aviso debería indicar fecha, responsable, público objetivo y acción esperada para evitar ambigüedad.', 'alatina-base'))),
            ),
            'highlights' => array(__('Listado dinámico de entradas recientes', 'alatina-base'),__('Tarjetas reutilizables para avisos', 'alatina-base'),__('Base para categorías futuras', 'alatina-base')),
        ),
        'documentos' => array(
            'eyebrow' => __('Documentos institucionales', 'alatina-base'),
            'lead'    => __('Página modelo para reglamentos, protocolos, formularios, circulares y archivos de consulta permanente.', 'alatina-base'),
            'summary' => __('La estructura prioriza orden, jerarquía y futura escalabilidad por categorías.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Categorías sugeridas', 'alatina-base'),'list' => array(__('Reglamentos y normativa escolar.', 'alatina-base'),__('Protocolos de actuación y convivencia.', 'alatina-base'),__('Circulares, formularios y autorizaciones.', 'alatina-base'),__('Documentos pedagógicos o administrativos de consulta frecuente.', 'alatina-base'))),
                array('title' => __('Criterio de publicación', 'alatina-base'),'content' => array(__('Información en validación. Cada documento debería indicar fecha de vigencia, versión y responsable de actualización.', 'alatina-base'))),
            ),
            'highlights' => array(__('Base para listado por categorías', 'alatina-base'),__('Espacio para fecha de vigencia', 'alatina-base'),__('Mensajes de validación claros', 'alatina-base')),
        ),
        'cgp-noticias' => array(
            'eyebrow' => __('Noticias CGP', 'alatina-base'),
            'lead'    => __('Página editorial para las novedades, comunicados y avances del Centro General de Padres.', 'alatina-base'),
            'summary' => __('Aquí se publicarán noticias, actividades y mensajes importantes del CGP para las familias y la comunidad escolar.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Qué encontrarás aquí', 'alatina-base'),'list' => array(__('Novedades y comunicados del CGP.', 'alatina-base'),__('Actividades, reuniones y avisos para apoderados.', 'alatina-base'),__('Información sobre avances de proyectos y transparencia.', 'alatina-base'))),
                array('title' => __('Estado de publicación', 'alatina-base'),'content' => array(__('Esta página está preparada para recibir entradas y comunicados del CGP, junto con enlaces directos a temas de participación y transparencia.', 'alatina-base'))),
            ),
            'highlights' => array(__('Publicaciones del CGP', 'alatina-base'),__('Comunicados claros y ordenados', 'alatina-base'),__('Vinculación con comunidad escolar', 'alatina-base')),
        ),
        'comunidad-educativa' => array(
            'eyebrow' => __('Comunidad educativa', 'alatina-base'),
            'lead'    => __('Página modelo para organizar información por públicos: estudiantes, familias, docentes, asistentes y red territorial.', 'alatina-base'),
            'summary' => __('El objetivo es orientar rápidamente a cada actor hacia la información que realmente necesita.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Familias y apoderados', 'alatina-base'),'content' => array(__('Las familias y apoderados son parte esencial del proceso educativo. Su participación fortalece la comunicación con la escuela, el acompañamiento de los estudiantes y el desarrollo de una convivencia respetuosa. En este espacio se busca orientar sobre canales de contacto, reuniones, documentos institucionales y participación en la comunidad escolar.', 'alatina-base'))),
                array('title' => __('Estudiantes', 'alatina-base'),'content' => array(__('Los estudiantes son el centro de la labor formativa del establecimiento. La escuela promueve su desarrollo académico, personal y social, junto con la participación en actividades pedagógicas, artísticas, deportivas y de convivencia escolar. Esta sección puede concentrar información útil para su vida escolar y su participación en la comunidad educativa.', 'alatina-base'))),
                array('title' => __('Docentes y asistentes', 'alatina-base'),'content' => array(__('Docentes y asistentes de la educación cumplen un rol fundamental en el funcionamiento del establecimiento y en el acompañamiento diario de los estudiantes. Su trabajo coordinado fortalece los aprendizajes, la convivencia y el desarrollo integral de la comunidad escolar, en coherencia con el proyecto educativo institucional.', 'alatina-base'))),
            ),
            'highlights' => array(__('Estructura por audiencia', 'alatina-base'),__('Bloques expandibles en futuras iteraciones', 'alatina-base'),__('Coherencia con portada y accesos rápidos', 'alatina-base')),
        ),
        'contacto' => array(
            'eyebrow' => __('Contacto y admisión', 'alatina-base'),
            'lead'    => __('Página modelo para atención, orientación general, ubicación, consultas frecuentes y proceso de admisión.', 'alatina-base'),
            'summary' => __('Combina contacto básico con una guía provisional de matrícula o postulación.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Canales de atención', 'alatina-base'),'list' => alatina_base_get_contact_placeholders()),
                array('title' => __('Admisión y orientación', 'alatina-base'),'list' => alatina_base_get_theme_lines('admission_steps', array(__('Revisar proyecto educativo y sellos institucionales.', 'alatina-base'),__('Confirmar niveles disponibles y vacantes del periodo actual. Información en validación.', 'alatina-base'),__('Solicitar orientación o entrevista por canales oficiales.', 'alatina-base'),__('Presentar documentación requerida según instructivo definitivo.', 'alatina-base')))),
                array('title' => __('Ubicación y referencia', 'alatina-base'),'content' => array(__('Información en validación. Incluir referencia del barrio, acceso de locomoción y observaciones para visitas presenciales.', 'alatina-base'))),
            ),
            'highlights' => array(__('Página híbrida de contacto y admisión', 'alatina-base'),__('Canales básicos visibles desde portada y footer', 'alatina-base'),__('Ruta de orientación para consultas frecuentes', 'alatina-base')),
        ),
        'asignaturas' => array(
            'eyebrow' => __('Asignaturas', 'alatina-base'),
            'lead'    => __('[CONTENIDO TEMPORAL] Esta sección será actualizada con información oficial sobre asignaturas, talleres y áreas de aprendizaje de la Escuela América Latina.', 'alatina-base'),
            'summary' => __('Presentación base para áreas de aprendizaje y actividades formativas, pendiente de validación oficial por la escuela.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Presentación general', 'alatina-base'),'content' => array(__('[CONTENIDO TEMPORAL] Esta sección organiza de forma visual las asignaturas y áreas de aprendizaje mientras la escuela valida el contenido oficial para publicación.', 'alatina-base'),__('Información en validación. No se informan planes, cargas horarias, docentes ni niveles específicos hasta recibir confirmación institucional.', 'alatina-base'))),
                array('title' => __('Áreas consideradas en esta versión', 'alatina-base'),'list' => array(__('Lenguaje y Comunicación', 'alatina-base'),__('Matemática', 'alatina-base'),__('Ciencias Naturales', 'alatina-base'),__('Historia, Geografía y Ciencias Sociales', 'alatina-base'),__('Inglés', 'alatina-base'),__('Educación Física y Salud', 'alatina-base'),__('Artes Visuales y Música', 'alatina-base'),__('Tecnología', 'alatina-base'),__('Orientación y Convivencia Escolar', 'alatina-base'))),
            ),
            'highlights' => array(__('[CONTENIDO TEMPORAL] Base visual para asignaturas', 'alatina-base'),__('Sin horarios ni docentes inventados', 'alatina-base'),__('Lista preparada para reemplazo por información oficial', 'alatina-base')),
        ),
        'calendario-escolar' => array(
            'eyebrow' => __('Planificación institucional', 'alatina-base'),
            'lead'    => __('Espacio base para publicar actividades, fechas relevantes y eventos de la comunidad educativa de forma clara y ordenada.', 'alatina-base'),
            'summary' => __('Queda preparada como página institucional simple, limpia y lista para incorporar más adelante el calendario mensual real.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Qué encontrarás aquí', 'alatina-base'),'content' => array(__('En esta página se publicarán actividades escolares, fechas relevantes, reuniones, hitos académicos y eventos importantes para estudiantes, familias y comunidad educativa.', 'alatina-base'))),
                array('title' => __('Próximamente', 'alatina-base'),'list' => array(__('Calendario mensual institucional.', 'alatina-base'),__('Fechas destacadas del periodo escolar.', 'alatina-base'),__('Actividades y eventos de la comunidad educativa.', 'alatina-base'))),
                array('title' => __('Zona preparada para el calendario', 'alatina-base'),'content' => array(__('Este bloque funciona como contenedor base para insertar en una siguiente etapa el calendario mensual real, sin rehacer la página ni alterar la estructura general.', 'alatina-base'))),
            ),
            'highlights' => array(__('Página base ya separada de la portada', 'alatina-base'),__('Contenedor listo para el calendario mensual futuro', 'alatina-base'),__('Estructura institucional simple y escalable', 'alatina-base')),
        ),
        'mision-vision' => array(
            'eyebrow' => __('Misión y visión', 'alatina-base'),
            'lead'    => __('La misión y visión de la Escuela América Latina orientan el trabajo formativo del establecimiento y expresan el compromiso institucional con una educación integral, inclusiva y vinculada al desarrollo de la comunidad educativa.', 'alatina-base'),
            'summary' => __('Orientan el trabajo formativo y expresan el compromiso con una educación integral.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Misión', 'alatina-base'),'content' => array(__('Potenciar la formación integral de todos los estudiantes, impulsando el respeto a la diversidad y formando ciudadanos responsables, respetuosos, honestos, solidarios, autónomos y tolerantes. La escuela busca fortalecer conocimientos, habilidades y actitudes, integrando tecnología, expresión artística y deportiva para mejorar los aprendizajes y contribuir a una sana convivencia escolar.', 'alatina-base'))),
                array('title' => __('Visión', 'alatina-base'),'content' => array(__('Ser reconocidos en la comuna de Romeral por la integralidad de la propuesta educativa y por la atención permanente a los desafíos de una sociedad en constante evolución, promoviendo una formación de calidad centrada en el desarrollo académico, personal y valórico de los estudiantes.', 'alatina-base'))),
                array('title' => __('Sello formativo', 'alatina-base'),'content' => array(__('La Escuela América Latina promueve una formación integral con énfasis en la expresión artística y deportiva, la convivencia respetuosa y la participación de toda la comunidad educativa.', 'alatina-base'))),
                array('title' => __('Valores institucionales', 'alatina-base'),'list' => array(__('Responsabilidad', 'alatina-base'),__('Respeto', 'alatina-base'),__('Honestidad', 'alatina-base'),__('Solidaridad', 'alatina-base'),__('Autonomía', 'alatina-base'),__('Tolerancia', 'alatina-base'))),
            ),
            'highlights' => array(__('Orientación institucional clara', 'alatina-base'),__('Compromiso con formación integral', 'alatina-base'),__('Vínculo con comunidad educativa', 'alatina-base')),
        ),
        'reglamento-interno' => array(
            'eyebrow' => __('Reglamento interno', 'alatina-base'),
            'lead'    => __('El Reglamento Interno de la Escuela América Latina establece normas, criterios y orientaciones para la convivencia escolar y el funcionamiento del establecimiento, promoviendo un ambiente seguro, respetuoso y formativo para toda la comunidad educativa.', 'alatina-base'),
            'summary' => __('Establece normas para convivencia escolar y funcionamiento del establecimiento.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Resumen breve', 'alatina-base'),'content' => array(__('En este documento se reúnen disposiciones relacionadas con convivencia escolar, derechos y deberes, organización interna y medidas orientadas al bienestar y desarrollo de los estudiantes dentro del contexto educativo.', 'alatina-base'))),
                array('title' => __('Documento oficial', 'alatina-base'),'content' => array(__('Para conocer el documento completo, revisa o descarga el reglamento interno oficial del establecimiento.', 'alatina-base'),__('<a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/2825/ReglamentodeConvivencia2825.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Descargar Reglamento Interno (PDF)</a>', 'alatina-base'))),
            ),
            'highlights' => array(__('Normas de convivencia escolar', 'alatina-base'),__('Derechos y deberes institucionales', 'alatina-base'),__('Documento oficial disponible', 'alatina-base')),
        ),
        'mapa-ubicacion' => array(
            'eyebrow' => __('Mapa y ubicación', 'alatina-base'),
            'lead'    => __('En esta sección encontrarás la información necesaria para ubicar la Escuela América Latina, conocer sus datos de contacto y facilitar la llegada al establecimiento.', 'alatina-base'),
            'summary' => __('Información para ubicar la escuela y facilitar la llegada.', 'alatina-base'),
            'sections' => array(
                array('title' => __('Ubicación', 'alatina-base'),'content' => array(__('La Escuela América Latina se encuentra en Ruta J-55 Km 2, Avenida Ramón Freire 2004, Romeral, con entrada por Callejón Las Catreras.', 'alatina-base'))),
                array('title' => __('Contacto breve', 'alatina-base'),'content' => array(__('Para consultas o coordinación previa, puedes comunicarte al teléfono 75 2431601 o al correo direccionalatina@daemromeral.cl, en horario de atención de 08:30 a 17:30, en jornada continuada.', 'alatina-base'))),
                array('title' => __('Cómo llegar', 'alatina-base'),'content' => array(__('Utiliza las coordenadas GPS: -33.46995314905984, -71.11157595000172 para llegar directamente.', 'alatina-base'),__('<a href="https://www.google.com/maps?q=-33.46995314905984,-71.11157595000172" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Ver ubicación en Google Maps</a>', 'alatina-base'))),
            ),
            'highlights' => array(__('Ubicación clara en Romeral', 'alatina-base'),__('Datos de contacto actualizados', 'alatina-base'),__('Enlace directo a Google Maps', 'alatina-base')),
        ),
    );
}

function alatina_base_get_page_model($slug) {
    $models = alatina_base_get_page_models();
    return isset($models[$slug]) ? $models[$slug] : null;
}

function alatina_base_get_institutional_page_model($slug) {
    return alatina_base_get_page_model($slug);
}

function alatina_base_render_model_sections($slug) {
    $model = alatina_base_get_page_model($slug);
    if (!$model) {
        return;
    }

    echo '<div class="institutional-stack">';
    if (!empty($model['sections'])) {
        foreach ($model['sections'] as $section) {
            echo '<section class="model-section">';
            echo '<h2>' . esc_html($section['title']) . '</h2>';
            if (!empty($section['content'])) {
                foreach ($section['content'] as $paragraph) {
                    echo '<p>' . esc_html($paragraph) . '</p>';
                }
            }
            if (!empty($section['list'])) {
                echo '<ul class="content-list">';
                foreach ($section['list'] as $item) {
                    echo '<li>' . esc_html($item) . '</li>';
                }
                echo '</ul>';
            }
            echo '</section>';
        }
    }

    if ('noticias' === $slug) {
        $query = new WP_Query(array('post_type' => 'post','posts_per_page' => 6,'ignore_sticky_posts' => true));
        echo '<section class="model-section">';
        echo '<div class="section-heading section-heading--with-action"><div><p class="section-kicker">' . esc_html__('Publicaciones recientes', 'alatina-base') . '</p><h2>' . esc_html__('Últimos avisos cargados en WordPress', 'alatina-base') . '</h2></div></div>';
        echo '<div class="news-grid news-grid--internal">';
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                echo '<article class="news-card"><p class="news-card__meta">' . esc_html(get_the_date()) . '</p><h3 class="news-card__title"><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3><div class="news-card__excerpt">' . wp_kses_post(wpautop(wp_trim_words(get_the_excerpt(), 28))) . '</div><a class="news-card__link" href="' . esc_url(get_permalink()) . '">' . esc_html__('Leer publicación', 'alatina-base') . '</a></article>';
            }
            wp_reset_postdata();
        } else {
            echo '<article class="news-card news-card--placeholder"><p class="news-card__meta">' . esc_html__('Sin entradas publicadas todavía', 'alatina-base') . '</p><h3 class="news-card__title">' . esc_html__('La estructura editorial ya quedó preparada', 'alatina-base') . '</h3><p>' . esc_html__('Cuando se creen publicaciones reales en WordPress, este bloque se poblará automáticamente sin rehacer la plantilla.', 'alatina-base') . '</p></article>';
        }
        echo '</div></section>';
    }

    if ('documentos' === $slug) {
        echo '<section class="model-section"><h2>' . esc_html__('Documentos destacados preparados', 'alatina-base') . '</h2><div class="mini-grid">';
        foreach (alatina_base_get_highlight_documents() as $document) {
            echo '<article class="mini-card"><p class="mini-card__eyebrow">' . esc_html($document['eyebrow']) . '</p><h3>' . esc_html($document['title']) . '</h3><p>' . esc_html($document['text']) . '</p></article>';
        }
        echo '</div></section>';
    }
    echo '</div>';
}
