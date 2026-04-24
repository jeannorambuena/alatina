<?php
/*
Template Name: CGE - Transparencia
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--cgp-transparencia">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Centro General de Alumnos', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Transparencia', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('Accede a registros, acuerdos y antecedentes del CGE para mantener una gestión clara y visible para la comunidad escolar.', 'alatina-base'); ?></p>
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
              <h2 class="section-title"><?php esc_html_e('Registro de gestión', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Espacio referencial para publicar acuerdos, actividades, recursos y antecedentes del trabajo del CGE. Esta información puede actualizarse periódicamente para mantener una gestión transparente.', 'alatina-base'); ?></p>

              <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                  <thead class="table-light">
                    <tr>
                      <th><?php esc_html_e('Fecha', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Tipo', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Descripción', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Responsable', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Estado', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Respaldo', 'alatina-base'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2026-03-10</td>
                      <td><?php esc_html_e('Acuerdo', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Organización de actividades estudiantiles del semestre.', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Directiva CGE', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Vigente', 'alatina-base'); ?></td>
                      <td><a class="text-primary" href="#"><?php esc_html_e('Ver acta', 'alatina-base'); ?></a></td>
                    </tr>
                    <tr>
                      <td>2026-03-28</td>
                      <td><?php esc_html_e('Actividad', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Campaña de convivencia y participación estudiantil.', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Comisión de comunicaciones', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Ejecutada', 'alatina-base'); ?></td>
                      <td><a class="text-primary" href="#"><?php esc_html_e('Ver registro', 'alatina-base'); ?></a></td>
                    </tr>
                    <tr>
                      <td>2026-04-08</td>
                      <td><?php esc_html_e('Informe', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Resumen de propuestas estudiantiles presentadas a dirección.', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Presidencia CGE', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Publicado', 'alatina-base'); ?></td>
                      <td><a class="text-primary" href="#"><?php esc_html_e('Ver informe', 'alatina-base'); ?></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="mt-4 p-3 bg-light rounded-3">
                <h4 class="h6 mb-2"><?php esc_html_e('Información adicional', 'alatina-base'); ?></h4>
                <p class="small mb-0"><?php esc_html_e('Los respaldos y antecedentes pueden publicarse aquí según las necesidades del Centro General de Alumnos.', 'alatina-base'); ?></p>
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
                <a href="<?php echo esc_url(home_url('/cge-integrantes/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Ver integrantes', 'alatina-base'); ?>
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
