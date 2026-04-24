<?php
/*
Template Name: Mapa y ubicación
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--mapa-ubicacion page-hero--info-school">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Mapa y ubicación', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Mapa y ubicación', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('En esta sección encontrarás la información necesaria para ubicar la Escuela América Latina y planificar tu llegada al establecimiento.', 'alatina-base'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="page-section py-5">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h2 class="section-title"><?php esc_html_e('Información de ubicación', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Consulta los datos de contacto y la referencia para llegar a la Escuela América Latina en Romeral.', 'alatina-base'); ?></p>
              <dl class="row align-items-start">
                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Dirección', 'alatina-base'); ?></dt>
                <dd class="col-sm-8">Ruta J-55 Km 2, Avenida Ramón Freire 2004, Romeral</dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Referencia', 'alatina-base'); ?></dt>
                <dd class="col-sm-8">Entrada por Callejón Las Catreras</dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Teléfono', 'alatina-base'); ?></dt>
                <dd class="col-sm-8">75 2431601</dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Correo', 'alatina-base'); ?></dt>
                <dd class="col-sm-8"><a href="mailto:direccionalatina@daemromeral.cl">direccionalatina@daemromeral.cl</a></dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Horario', 'alatina-base'); ?></dt>
                <dd class="col-sm-8">08:30 a 17:30, horario continuado</dd>
              </dl>
            </div>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h2 class="section-title"><?php esc_html_e('Cómo llegar', 'alatina-base'); ?></h2>
                <p class="section-copy mb-4"><?php esc_html_e('Puedes utilizar el siguiente enlace para abrir la ubicación en Google Maps y planificar tu trayecto hacia el establecimiento.', 'alatina-base'); ?></p>
              </div>
              <a class="btn btn-primary rounded-pill px-4 mt-3" href="https://www.google.com/maps?q=-34.96201,-71.17244" target="_blank" rel="noopener noreferrer">
                <?php esc_html_e('Ver ubicación en Google Maps', 'alatina-base'); ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
