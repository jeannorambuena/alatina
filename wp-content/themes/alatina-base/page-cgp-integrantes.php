<?php
/*
Template Name: CGP - Integrantes
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--cgp-integrantes">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Centro General de Padres', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Integrantes del CGP', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('Conoce a los representantes del Centro General de Padres, sus roles y formas de contacto para facilitar la comunicación y organización.', 'alatina-base'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="page-section py-5">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h2 class="section-title"><?php esc_html_e('Directorio CGP', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Funciones habituales del cargo dentro del trabajo del CGP, listadas para facilitar el contacto y la organización.', 'alatina-base'); ?></p>

              <div class="row g-4">
                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Presidente/a">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Presidente/a', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Representa al CGP ante la comunidad educativa y coordina acuerdos con el establecimiento.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Representar al CGP ante familias y directiva.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Coordinar reuniones y acuerdos de trabajo.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>

                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Secretario/a">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Secretario/a', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Registra actas y comunicaciones, y apoya la gestión de la documentación del CGP.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Llevar control de actas y acuerdos.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Gestionar comunicaciones internas y externas.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>

                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Tesorero/a">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Registra ingresos y gastos, y apoya la transparencia contable del CGP.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Registrar ingresos, gastos y aportes.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Colaborar en la presentación de comprobantes.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>

                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Encargado/a de Comunicaciones">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Encargado/a de Comunicaciones', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Coordina los canales de información y el flujo de mensajes hacia las familias.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Coordinar comunicaciones y avisos.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Apoyar la difusión de actividades del CGP.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
              <h3 class="h5 mb-3"><?php esc_html_e('Enlaces relacionados', 'alatina-base'); ?></h3>
              <div class="d-grid gap-2">
                <a href="<?php echo esc_url(home_url('/cgp/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Volver al CGP', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/cgp-transparencia/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Ver transparencia', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/cgp-noticias/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Ver noticias', 'alatina-base'); ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();