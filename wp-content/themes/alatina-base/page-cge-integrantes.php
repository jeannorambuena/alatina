<?php
/*
Template Name: CGE - Integrantes
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--cgp-integrantes">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Centro General de Alumnos', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Integrantes del CGE', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('Conoce a los representantes del Centro General de Alumnos, sus roles y formas de participación para fortalecer la vida estudiantil.', 'alatina-base'); ?></p>
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
              <h2 class="section-title"><?php esc_html_e('Directorio CGE', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Funciones referenciales del equipo del CGE, organizadas para facilitar la participación y el trabajo conjunto con la comunidad escolar.', 'alatina-base'); ?></p>

              <div class="row g-4">
                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Presidente/a CGE">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Presidente/a', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Representa al CGE ante la comunidad educativa y coordina acuerdos del estudiantado.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Representar al estudiantado ante la dirección y comunidad escolar.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Coordinar reuniones y líneas de trabajo del CGE.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>
                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Secretario/a CGE">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Secretario/a', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Registra acuerdos, actas y comunicaciones internas del CGE.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Llevar control de actas y acuerdos.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Apoyar la difusión de comunicaciones estudiantiles.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>
                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Tesorero/a CGE">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Apoya el registro de recursos y la transparencia de actividades del CGE.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Registrar ingresos y gastos de actividades estudiantiles.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Colaborar con reportes y respaldos de gestión.', 'alatina-base'); ?></li>
                      </ul>
                    </div>
                  </article>
                </div>
                <div class="col-md-6">
                  <article class="card border-0 shadow-sm rounded-4 h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Encargado/a de Comunicaciones CGE">
                    <div class="card-body">
                      <h3 class="h5"><?php esc_html_e('Encargado/a de Comunicaciones', 'alatina-base'); ?></h3>
                      <p class="mb-2 text-muted"><?php esc_html_e('Coordina avisos, campañas e información hacia el estudiantado.', 'alatina-base'); ?></p>
                      <ul class="content-list">
                        <li><?php esc_html_e('Coordinar comunicaciones y avisos del CGE.', 'alatina-base'); ?></li>
                        <li><?php esc_html_e('Apoyar la difusión de actividades y campañas escolares.', 'alatina-base'); ?></li>
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
                <a href="<?php echo esc_url(home_url('/cge/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Volver al CGE', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/cge-transparencia/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Ver transparencia', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/cge-noticias/')); ?>" class="btn btn-outline-primary rounded-pill">
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
