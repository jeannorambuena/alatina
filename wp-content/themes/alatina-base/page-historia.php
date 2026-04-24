<?php
/*
Template Name: Historia
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Historia institucional', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Historia', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('La historia de la Escuela América Latina forma parte del desarrollo educativo de la comuna de Romeral y del compromiso permanente con la formación de niños y niñas en un entorno cercano, participativo y orientado al crecimiento integral.', 'alatina-base'); ?></p>
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
              <h2 class="section-title"><?php esc_html_e('Desarrollo institucional', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('A lo largo del tiempo, el establecimiento ha consolidado su identidad educativa mediante el trabajo conjunto de docentes, asistentes, estudiantes y familias, fortaleciendo una propuesta centrada en el aprendizaje, la convivencia respetuosa y la formación valórica.', 'alatina-base'); ?></p>

              <h3 class="h4 mb-3"><?php esc_html_e('Identidad institucional', 'alatina-base'); ?></h3>
              <p class="section-copy mb-4"><?php esc_html_e('La escuela ha proyectado su labor como un espacio educativo que promueve oportunidades de desarrollo académico, personal, artístico y deportivo, respondiendo a las necesidades de sus estudiantes y a los desafíos de cada etapa.', 'alatina-base'); ?></p>

              <h3 class="h4 mb-3"><?php esc_html_e('Hitos sugeridos', 'alatina-base'); ?></h3>
              <ul class="list-unstyled">
                <li class="mb-2"><strong><?php esc_html_e('Consolidación del establecimiento', 'alatina-base'); ?>:</strong> <?php esc_html_e('Consolidación del establecimiento como espacio formativo al servicio de la comunidad de Romeral.', 'alatina-base'); ?></li>
                <li class="mb-2"><strong><?php esc_html_e('Fortalecimiento del proyecto educativo', 'alatina-base'); ?>:</strong> <?php esc_html_e('Fortalecimiento del proyecto educativo institucional con foco en formación integral.', 'alatina-base'); ?></li>
                <li class="mb-0"><strong><?php esc_html_e('Impulso de actividades', 'alatina-base'); ?>:</strong> <?php esc_html_e('Impulso de actividades artísticas, deportivas y de convivencia escolar como parte del sello educativo.', 'alatina-base'); ?></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
              <h3 class="h5 mb-3"><?php esc_html_e('Enlaces relacionados', 'alatina-base'); ?></h3>
              <div class="d-grid gap-2">
                <a href="<?php echo esc_url(home_url('/proyecto-educativo/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Proyecto educativo', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/comunidad-educativa/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Comunidad educativa', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Contacto', 'alatina-base'); ?>
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
