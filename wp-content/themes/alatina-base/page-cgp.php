<?php
/*
 * Page template for slug cgp - Hub principal del CGP
 */
get_header();

if (have_posts()) {
    the_post();
}

$page_title   = get_the_title() ? get_the_title() : __('CGP', 'alatina-base');
$page_content = trim(get_the_content());
?>

<main class="site-main cgp-page">
  <section class="cgp-page__hero page-hero--cgp py-5">
    <div class="container">
      <div class="cgp-page__hero-card">
        <span class="section-tag">CGP</span>
        <h1 class="section-title">Centro General de Padres</h1>
        <p class="section-copy mb-0">Bienvenido al hub del Centro General de Padres: información, transparencia, directorio y noticias para la comunidad educativa.</p>

        <div class="cgp-page__actions mt-4 d-flex flex-wrap gap-2">
          <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-integrantes/')); ?>"><?php esc_html_e('Ver integrantes', 'alatina-base'); ?></a>
          <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-transparencia/')); ?>"><?php esc_html_e('Ver transparencia', 'alatina-base'); ?></a>
          <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-noticias/')); ?>"><?php esc_html_e('Ver noticias', 'alatina-base'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="cgp-page__overview py-5">
    <div class="container">
      <div class="row g-4 align-items-start">
        <div class="col-lg-8">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h2 class="section-title"><?php esc_html_e('Rol del CGP', 'alatina-base'); ?></h2>
              <p><?php esc_html_e('El CGP cumple un rol relevante en la representación de las familias, en la coordinación de actividades y en el apoyo a procesos que fortalecen la vida escolar. Su trabajo busca favorecer la participación, la comunicación y el compromiso con los objetivos formativos del establecimiento.', 'alatina-base'); ?></p>
              <p><?php esc_html_e('Esta sección busca reunir la información principal del Centro General de Padres y facilitar el acceso a noticias, iniciativas, responsables y antecedentes relevantes para la comunidad escolar.', 'alatina-base'); ?></p>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <aside class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <p class="section-tag mb-3"><?php esc_html_e('Áreas del CGP', 'alatina-base'); ?></p>
              <ul class="content-list mb-4">
                <li><?php esc_html_e('Organización y representación de apoderados.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Información y comunicados del CGP.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Transparencia contable y gestión de recursos.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Proyectos, iniciativas y convivencia escolar.', 'alatina-base'); ?></li>
              </ul>
              <a class="btn btn-light border rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-noticias/')); ?>"><?php esc_html_e('Ir a noticias', 'alatina-base'); ?></a>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section class="cgp-page__sections py-5 bg-light">
    <div class="container">
      <div class="section-heading-row d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Secciones del CGP', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php esc_html_e('Acceso directo', 'alatina-base'); ?></h2>
          <p class="section-copy mb-0"><?php esc_html_e('Navega por las diferentes áreas del Centro General de Padres para encontrar la información que necesitas.', 'alatina-base'); ?></p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center">
              <div class="mb-3">
                <span class="badge bg-primary rounded-pill px-3 py-2"><?php esc_html_e('Directorio', 'alatina-base'); ?></span>
              </div>
              <h3 class="h5 mb-3"><?php esc_html_e('Integrantes del CGP', 'alatina-base'); ?></h3>
              <p class="text-muted mb-4"><?php esc_html_e('Conoce a los representantes del Centro General de Padres, sus roles y formas de contacto.', 'alatina-base'); ?></p>
              <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-integrantes/')); ?>"><?php esc_html_e('Ver integrantes', 'alatina-base'); ?></a>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center">
              <div class="mb-3">
                <span class="badge bg-success rounded-pill px-3 py-2"><?php esc_html_e('Transparencia', 'alatina-base'); ?></span>
              </div>
              <h3 class="h5 mb-3"><?php esc_html_e('Transparencia contable', 'alatina-base'); ?></h3>
              <p class="text-muted mb-4"><?php esc_html_e('Accede a comprobantes, registros de ingresos y gastos del CGP.', 'alatina-base'); ?></p>
              <a class="btn btn-success rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-transparencia/')); ?>"><?php esc_html_e('Ver transparencia', 'alatina-base'); ?></a>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center">
              <div class="mb-3">
                <span class="badge bg-info rounded-pill px-3 py-2"><?php esc_html_e('Comunicados', 'alatina-base'); ?></span>
              </div>
              <h3 class="h5 mb-3"><?php esc_html_e('Noticias y comunicados', 'alatina-base'); ?></h3>
              <p class="text-muted mb-4"><?php esc_html_e('Mantente informado sobre actividades, reuniones y avances del CGP.', 'alatina-base'); ?></p>
              <a class="btn btn-info rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-noticias/')); ?>"><?php esc_html_e('Ver noticias', 'alatina-base'); ?></a>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <?php if (! empty($page_content)) : ?>
    <section class="cgp-page__intro-section pb-2">
      <div class="container">
        <article class="cgp-page__intro-card">
          <?php the_content(); ?>
        </article>
      </div>
    </section>
  <?php endif; ?>
</main>
<?php
get_footer();
