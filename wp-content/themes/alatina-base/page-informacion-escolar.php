<?php
/*
Template Name: Información escolar
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--informacion-escolar page-hero--info-school">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Información escolar', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Información escolar', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('En esta sección se reúne información institucional clave para la comunidad educativa: misión y visión, proyecto educativo, reglamento interno, ubicación del establecimiento y documentos de consulta permanente.', 'alatina-base'); ?></p>
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
              <h2 class="section-title"><?php esc_html_e('Acceso a contenidos institucionales', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Este espacio organiza la información escolar relevante para familias, estudiantes y comunidad. Desde aquí puedes acceder a los principales contenidos institucionales del establecimiento.', 'alatina-base'); ?></p>

              <div class="row g-3">
                <div class="col-md-6">
                  <a class="btn btn-outline-primary rounded-pill w-100" href="<?php echo esc_url(home_url('/mision-vision/')); ?>"><?php esc_html_e('Misión y visión', 'alatina-base'); ?></a>
                </div>
                <div class="col-md-6">
                  <a class="btn btn-outline-primary rounded-pill w-100" href="<?php echo esc_url(home_url('/proyecto-educativo/')); ?>"><?php esc_html_e('Proyecto educativo', 'alatina-base'); ?></a>
                </div>
                <div class="col-md-6">
                  <a class="btn btn-outline-primary rounded-pill w-100" href="<?php echo esc_url(home_url('/reglamento-interno/')); ?>"><?php esc_html_e('Reglamento interno', 'alatina-base'); ?></a>
                </div>
                <div class="col-md-6">
                  <a class="btn btn-outline-primary rounded-pill w-100" href="<?php echo esc_url(home_url('/mapa-ubicacion/')); ?>"><?php esc_html_e('Mapa o ubicación', 'alatina-base'); ?></a>
                </div>
                <div class="col-md-6">
                  <a class="btn btn-outline-primary rounded-pill w-100" href="<?php echo esc_url(home_url('/documentos/')); ?>"><?php esc_html_e('Documentos importantes', 'alatina-base'); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h3 class="h5 mb-3"><?php esc_html_e('Resumen rápido', 'alatina-base'); ?></h3>
              <ul class="content-list mb-4">
                <li><?php esc_html_e('Misión, visión y valores institucionales.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Proyecto Educativo Institucional.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Normativa y reglamentos del establecimiento.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Ubicación y documentos de consulta.', 'alatina-base'); ?></li>
              </ul>
              <a class="btn btn-light border rounded-pill px-4" href="<?php echo esc_url(home_url('/contacto/')); ?>"><?php esc_html_e('Ir a contacto', 'alatina-base'); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
