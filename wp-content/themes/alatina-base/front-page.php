<?php
get_header();
?>
<main class="site-main">
  <section class="hero hero-home">
    <div class="wrap hero-home__grid">
      <div class="hero-home__content">
        <p class="eyebrow">Comunidad educativa</p>
        <h1><?php bloginfo('name'); ?></h1>
        <p class="lead">
          Un espacio institucional claro para compartir información, novedades,
          documentos y acceso rápido a los contenidos más importantes.
        </p>
        <div class="hero-home__actions">
          <a class="button button--primary" href="<?php echo esc_url(home_url('/')); ?>#accesos-principales"><?php esc_html_e('Explorar accesos', 'alatina-base'); ?></a>
          <a class="button button--secondary" href="<?php echo esc_url(home_url('/contacto/')); ?>"><?php esc_html_e('Contacto', 'alatina-base'); ?></a>
        </div>
      </div>

      <aside class="hero-home__panel" aria-label="<?php esc_attr_e('Resumen institucional', 'alatina-base'); ?>">
        <div class="info-card info-card--highlight">
          <h2><?php esc_html_e('Información institucional', 'alatina-base'); ?></h2>
          <p>
            Diseñado para orientar a estudiantes, familias, docentes y comunidad
            escolar con una navegación simple y contenidos bien organizados.
          </p>
          <ul class="feature-list">
            <li><?php esc_html_e('Acceso directo a páginas clave', 'alatina-base'); ?></li>
            <li><?php esc_html_e('Base visual consistente para crecer', 'alatina-base'); ?></li>
            <li><?php esc_html_e('Estructura compatible con WordPress', 'alatina-base'); ?></li>
          </ul>
        </div>
      </aside>
    </div>
  </section>

  <section class="home-section home-section--intro">
    <div class="wrap section-heading">
      <p class="section-kicker"><?php esc_html_e('Portada institucional', 'alatina-base'); ?></p>
      <h2><?php esc_html_e('Accesos principales para la comunidad', 'alatina-base'); ?></h2>
      <p>
        La portada prioriza rutas frecuentes y deja una base simple para seguir
        conectando páginas, noticias, documentos y contenidos institucionales.
      </p>
    </div>
  </section>

  <section id="accesos-principales" class="home-grid">
    <div class="wrap cards">
      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(home_url('/nuestra-escuela/')); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Institución', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Nuestra escuela', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Historia, proyecto educativo y equipo de trabajo.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Ver más', 'alatina-base'); ?></span>
        </a>
      </article>

      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(home_url('/noticias/')); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Actualidad', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Noticias', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Novedades, actividades, reconocimientos y comunicaciones.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Ir a noticias', 'alatina-base'); ?></span>
        </a>
      </article>

      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(home_url('/centro-de-padres/')); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Comunidad', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Centro de Padres', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Información, actas, avisos y coordinación con apoderados.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Abrir sección', 'alatina-base'); ?></span>
        </a>
      </article>

      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(home_url('/documentos/')); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Recursos', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Documentos', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Reglamentos, circulares, formularios y material institucional.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Revisar documentos', 'alatina-base'); ?></span>
        </a>
      </article>
    </div>
  </section>
</main>
<?php
get_footer();
