<?php
$section_links = alatina_base_get_section_links();
get_header();
?>
<main class="site-main">
  <section class="hero hero-home">
    <div class="wrap hero-home__grid">
      <div class="hero-home__content">
        <p class="eyebrow"><?php esc_html_e('Comunidad educativa', 'alatina-base'); ?></p>
        <h1><?php bloginfo('name'); ?></h1>
        <p class="lead">
          Un sitio escolar claro, ordenado y cercano para compartir información,
          novedades, documentos y accesos principales para toda la comunidad.
        </p>
        <div class="hero-home__actions">
          <a class="button button--primary" href="<?php echo esc_url(home_url('/')); ?>#accesos-principales"><?php esc_html_e('Ver accesos principales', 'alatina-base'); ?></a>
          <a class="button button--secondary" href="<?php echo esc_url(alatina_base_get_page_url('nuestra-escuela')); ?>"><?php esc_html_e('Conocer la institución', 'alatina-base'); ?></a>
        </div>
      </div>

      <aside class="hero-home__panel" aria-label="<?php esc_attr_e('Resumen institucional', 'alatina-base'); ?>">
        <div class="info-card info-card--highlight">
          <p class="card__eyebrow"><?php esc_html_e('Resumen institucional', 'alatina-base'); ?></p>
          <h2><?php esc_html_e('Información clara para estudiantes, familias y docentes', 'alatina-base'); ?></h2>
          <p>
            La portada prioriza orientación, accesos directos y una base visual
            preparada para crecer con páginas internas, noticias y recursos.
          </p>
          <ul class="feature-list">
            <li><?php esc_html_e('Navegación simple y reconocible', 'alatina-base'); ?></li>
            <li><?php esc_html_e('Rutas preparadas para secciones institucionales', 'alatina-base'); ?></li>
            <li><?php esc_html_e('Diseño sobrio y consistente', 'alatina-base'); ?></li>
          </ul>
        </div>
      </aside>
    </div>
  </section>

  <section class="home-section home-section--intro">
    <div class="wrap section-heading">
      <p class="section-kicker"><?php esc_html_e('Portada institucional', 'alatina-base'); ?></p>
      <h2><?php esc_html_e('Accesos principales para la comunidad escolar', 'alatina-base'); ?></h2>
      <p>
        Se dejan accesos razonables a secciones esperadas del sitio para facilitar
        la navegación y permitir que WordPress las resuelva cuando existan como páginas reales.
      </p>
    </div>
  </section>

  <section id="accesos-principales" class="home-grid">
    <div class="wrap cards">
      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(alatina_base_get_page_url($section_links['nuestra-escuela']['slug'])); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Institución', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Nuestra escuela', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Historia, proyecto educativo, sello formativo y equipo de trabajo.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Abrir sección', 'alatina-base'); ?></span>
        </a>
      </article>

      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(alatina_base_get_page_url($section_links['noticias']['slug'])); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Actualidad', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Noticias y avisos', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Comunicaciones, actividades, hitos escolares y novedades relevantes.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Ver noticias', 'alatina-base'); ?></span>
        </a>
      </article>

      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(alatina_base_get_page_url($section_links['centro-de-padres']['slug'])); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Comunidad', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Centro de Padres', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Información, coordinación, avisos y vínculo con apoderados.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Ir a la sección', 'alatina-base'); ?></span>
        </a>
      </article>

      <article class="card card--link">
        <a class="card__link" href="<?php echo esc_url(alatina_base_get_page_url($section_links['documentos']['slug'])); ?>">
          <span class="card__eyebrow"><?php esc_html_e('Recursos', 'alatina-base'); ?></span>
          <h3><?php esc_html_e('Documentos institucionales', 'alatina-base'); ?></h3>
          <p><?php esc_html_e('Reglamentos, circulares, formularios y material de consulta.', 'alatina-base'); ?></p>
          <span class="card__cta"><?php esc_html_e('Revisar recursos', 'alatina-base'); ?></span>
        </a>
      </article>
    </div>
  </section>
</main>
<?php
get_footer();
