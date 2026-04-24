<?php
/*
Template Name: CGP - Transparencia
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--cgp-transparencia">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Centro General de Padres', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Transparencia Contable', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('Accede a comprobantes, registros de ingresos y gastos del CGP para mantener la transparencia en la gestión de recursos.', 'alatina-base'); ?></p>
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
              <h2 class="section-title"><?php esc_html_e('Registro de movimientos', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Control contable preparado para registrar ingresos, gastos y comprobantes del CGP. Esta información se actualiza periódicamente para mantener la transparencia.', 'alatina-base'); ?></p>

              <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                  <thead class="table-light">
                    <tr>
                      <th><?php esc_html_e('Fecha', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Tipo', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Descripción', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Responsable', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Monto', 'alatina-base'); ?></th>
                      <th><?php esc_html_e('Comprobante', 'alatina-base'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>2026-03-02</td>
                      <td><?php esc_html_e('Ingreso', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Cuota de apoderados para actividades escolares.', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></td>
                      <td>$45.000</td>
                      <td><a class="text-primary" href="<?php echo esc_url(home_url('/documentos/cgp-comprobante-1.pdf')); ?>"><?php esc_html_e('Ver boleta', 'alatina-base'); ?></a></td>
                    </tr>
                    <tr>
                      <td>2026-03-15</td>
                      <td><?php esc_html_e('Gasto', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Compra de materiales para actividad de curso.', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></td>
                      <td>$28.000</td>
                      <td><a class="text-primary" href="<?php echo esc_url(home_url('/documentos/cgp-comprobante-2.pdf')); ?>"><?php esc_html_e('Ver comprobante', 'alatina-base'); ?></a></td>
                    </tr>
                    <tr>
                      <td>2026-04-05</td>
                      <td><?php esc_html_e('Gasto', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Apoyo a actividad escolar y materiales para convivencia.', 'alatina-base'); ?></td>
                      <td><?php esc_html_e('Encargado/a de Proyectos', 'alatina-base'); ?></td>
                      <td>$18.500</td>
                      <td><a class="text-primary" href="<?php echo esc_url(home_url('/documentos/cgp-comprobante-3.pdf')); ?>"><?php esc_html_e('Ver comprobante', 'alatina-base'); ?></a></td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="mt-4 p-3 bg-light rounded-3">
                <h4 class="h6 mb-2"><?php esc_html_e('Información adicional', 'alatina-base'); ?></h4>
                <p class="small mb-0"><?php esc_html_e('Los comprobantes están disponibles para descarga. Si necesitas información adicional sobre algún movimiento, contacta al Tesorero/a del CGP.', 'alatina-base'); ?></p>
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
                <a href="<?php echo esc_url(home_url('/cgp-integrantes/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Ver integrantes', 'alatina-base'); ?>
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