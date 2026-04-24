<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$alatina_whatsapp_number = '56997718963';
$alatina_whatsapp_message = rawurlencode('Hola, quiero hacer una consulta a la Escuela América Latina.');
$alatina_whatsapp_url = 'https://wa.me/' . $alatina_whatsapp_number . '?text=' . $alatina_whatsapp_message;
$current_slug = is_page() ? get_post_field('post_name', get_queried_object_id()) : '';
?>
<header class="site-header">
  <div class="topbar-shell" aria-hidden="true">
    <div class="container">
      <div class="topbar-row"></div>
    </div>
  </div>

  <div class="nav-shell sticky-top">
    <div class="container">
      <nav class="navbar navbar-expand-xl school-navbar nav-shell__bar py-2 py-xl-2" aria-label="<?php esc_attr_e('Menú principal', 'alatina-base'); ?>">
        <a class="navbar-brand navbar-brand--mark" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Inicio', 'alatina-base'); ?>">
          <span class="header-school-mark" aria-hidden="true">
            <img class="header-school-mark__image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/escudo-america-latina.svg'); ?>" alt="">
          </span>
          <span class="navbar-brand__copy d-none d-md-flex">
            <strong class="navbar-brand__title"><?php esc_html_e('Escuela América Latina', 'alatina-base'); ?></strong>
          </span>
        </a>

        <div class="d-flex align-items-center gap-2 order-xl-3 nav-actions">
          <a class="btn rounded-pill header-cta header-cta--whatsapp d-none d-xl-inline-flex" href="<?php echo esc_url($alatina_whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Abrir WhatsApp de la escuela', 'alatina-base'); ?>">
            <span class="header-cta__icon"><?php echo alatina_base_get_bootstrap_icon('whatsapp'); ?></span>
            <span><?php esc_html_e('WhatsApp', 'alatina-base'); ?></span>
          </a>
          <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="<?php esc_attr_e('Abrir menú', 'alatina-base'); ?>">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse order-xl-2 primary-nav-collapse" id="primaryNav">
          <ul id="primary-menu" class="navbar-nav primary-menu-list align-items-xl-center">
            <li class="menu-item nav-item <?php echo (is_front_page() || is_home()) ? 'current-menu-item' : ''; ?>"><a class="nav-link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Inicio', 'alatina-base'); ?></a></li>
            <li class="menu-item nav-item <?php echo 'quienes-somos' === $current_slug ? 'current-menu-item' : ''; ?>"><a class="nav-link" href="<?php echo esc_url(alatina_base_get_page_url('quienes-somos')); ?>"><?php esc_html_e('Quienes somos', 'alatina-base'); ?></a></li>
            <li class="menu-item nav-item menu-item-has-children menu-item--subjects <?php echo 'asignaturas' === $current_slug ? 'current-menu-item' : ''; ?>">
              <a class="nav-link" href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Asignaturas', 'alatina-base'); ?></a>
              <button class="menu-dropdown-toggle" type="button" aria-label="<?php esc_attr_e('Abrir menú de Asignaturas', 'alatina-base'); ?>"></button>
              <ul class="sub-menu">
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Lenguaje', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Matemática', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Ciencias', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Historia', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Educación Física', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Artes', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(home_url('/#asignaturas')); ?>"><?php esc_html_e('Tecnología', 'alatina-base'); ?></a></li>
                <li class="menu-item menu-item--meta"><span><?php esc_html_e('Profesor encargado · referencia visual', 'alatina-base'); ?></span></li>
              </ul>
            </li>
            <li class="menu-item nav-item menu-item-has-children menu-item--info <?php echo in_array($current_slug, array('informacion-escolar', 'mision-vision', 'proyecto-educativo', 'reglamento-interno', 'mapa-ubicacion', 'documentos'), true) ? 'current-menu-item current-menu-ancestor' : ''; ?>">
              <a class="nav-link" href="<?php echo esc_url(alatina_base_get_page_url('informacion-escolar')); ?>"><?php esc_html_e('Información escolar', 'alatina-base'); ?></a>
              <button class="menu-dropdown-toggle" type="button" aria-label="<?php esc_attr_e('Abrir menú de Información escolar', 'alatina-base'); ?>"></button>
              <ul class="sub-menu">
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('mision-vision')); ?>"><?php esc_html_e('Misión y visión', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('proyecto-educativo')); ?>"><?php esc_html_e('PEI', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('reglamento-interno')); ?>"><?php esc_html_e('Reglamento interno', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('mapa-ubicacion')); ?>"><?php esc_html_e('Mapa o ubicación', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('documentos')); ?>"><?php esc_html_e('Documentos importantes', 'alatina-base'); ?></a></li>
              </ul>
            </li>
            <li class="menu-item nav-item menu-item-has-children menu-item--cgp <?php echo in_array($current_slug, array('cgp', 'cgp-integrantes', 'cgp-transparencia', 'cgp-noticias'), true) ? 'current-menu-item current-menu-ancestor' : ''; ?>">
              <a class="nav-link" href="<?php echo esc_url(alatina_base_get_page_url('cgp')); ?>"><?php esc_html_e('CGP', 'alatina-base'); ?></a>
              <button class="menu-dropdown-toggle" type="button" aria-label="<?php esc_attr_e('Abrir menú de CGP', 'alatina-base'); ?>"></button>
              <ul class="sub-menu">
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('cgp-integrantes')); ?>"><?php esc_html_e('Integrantes', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('cgp-transparencia')); ?>"><?php esc_html_e('Transparencia', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('cgp-noticias')); ?>"><?php esc_html_e('Noticias', 'alatina-base'); ?></a></li>
              </ul>
            </li>
            <li class="menu-item nav-item menu-item-has-children menu-item--cge <?php echo in_array($current_slug, array('cge', 'cge-integrantes', 'cge-transparencia', 'cge-noticias'), true) ? 'current-menu-item current-menu-ancestor' : ''; ?>">
              <a class="nav-link" href="<?php echo esc_url(alatina_base_get_page_url('cge')); ?>"><?php esc_html_e('CGE', 'alatina-base'); ?></a>
              <button class="menu-dropdown-toggle" type="button" aria-label="<?php esc_attr_e('Abrir menú de CGE', 'alatina-base'); ?>"></button>
              <ul class="sub-menu">
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('cge-integrantes')); ?>"><?php esc_html_e('Integrantes', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('cge-transparencia')); ?>"><?php esc_html_e('Transparencia', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('cge-noticias')); ?>"><?php esc_html_e('Noticias', 'alatina-base'); ?></a></li>
              </ul>
            </li>
            <li class="menu-item nav-item menu-item-has-children menu-item--rrss <?php echo in_array($current_slug, array('rrss-youtube', 'rrss-instagram', 'galeria'), true) ? 'current-menu-item current-menu-ancestor' : ''; ?>">
              <a class="nav-link" href="<?php echo esc_url(alatina_base_get_page_url('galeria')); ?>"><?php esc_html_e('RRSS', 'alatina-base'); ?></a>
              <button class="menu-dropdown-toggle" type="button" aria-label="<?php esc_attr_e('Abrir menú de RRSS', 'alatina-base'); ?>"></button>
              <ul class="sub-menu">
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('rrss-youtube')); ?>"><?php esc_html_e('YouTube', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('rrss-instagram')); ?>"><?php esc_html_e('Instagram', 'alatina-base'); ?></a></li>
                <li class="menu-item"><a href="<?php echo esc_url(alatina_base_get_page_url('galeria')); ?>"><?php esc_html_e('Galería', 'alatina-base'); ?></a></li>
              </ul>
            </li>
          </ul>
          <a class="btn rounded-pill header-cta header-cta--whatsapp header-cta--mobile d-xl-none mt-3" href="<?php echo esc_url($alatina_whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Abrir WhatsApp de la escuela', 'alatina-base'); ?>">
            <span class="header-cta__icon"><?php echo alatina_base_get_bootstrap_icon('whatsapp'); ?></span>
            <span><?php esc_html_e('WhatsApp', 'alatina-base'); ?></span>
          </a>
        </div>
      </nav>
    </div>
  </div>
</header>
