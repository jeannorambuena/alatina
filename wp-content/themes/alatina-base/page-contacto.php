<?php
/**
 * Template Name: Contacto
 */

get_header();
?>
<main class="site-main site-main--internal">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero page-hero--contacto page-hero--info-school">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced">
            <div class="page-hero__grid">
              <div class="page-hero__main">
                <p class="eyebrow"><?php esc_html_e('Contacto', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="lead">Para consultas, información institucional o comunicación con el establecimiento, puedes utilizar los siguientes canales de contacto. Nuestra comunidad educativa está disponible para orientar a estudiantes, familias y apoderados en los distintos procesos escolares.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>

  <section class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="content-card">
            <h2><?php esc_html_e('Información de contacto', 'alatina-base'); ?></h2>
            <div class="entry-content entry-content--page">
              <p><?php esc_html_e('Para consultas, información institucional o comunicación con el establecimiento, puedes utilizar los siguientes canales de contacto. Nuestra comunidad educativa está disponible para orientar a estudiantes, familias y apoderados en los distintos procesos escolares.', 'alatina-base'); ?></p>
              <dl class="row g-2 mb-4">
                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Teléfono institucional', 'alatina-base'); ?></dt>
                <dd class="col-sm-8">75 2431601</dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Correo de contacto', 'alatina-base'); ?></dt>
                <dd class="col-sm-8"><a href="mailto:direccionalatina@daemromeral.cl">direccionalatina@daemromeral.cl</a></dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Dirección del establecimiento', 'alatina-base'); ?></dt>
                <dd class="col-sm-8">Ruta J-55 Km 2, Avenida Ramón Freire 2004, Romeral</dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Referencia de acceso', 'alatina-base'); ?></dt>
                <dd class="col-sm-8"><?php esc_html_e('Entrada por Callejón Las Catreras', 'alatina-base'); ?></dd>

                <dt class="col-sm-4 fw-semibold"><?php esc_html_e('Horario de atención presencial', 'alatina-base'); ?></dt>
                <dd class="col-sm-8"><?php esc_html_e('08:30 a 17:30, horario continuado', 'alatina-base'); ?></dd>
              </dl>
              <a class="btn btn-primary rounded-pill px-4" href="https://www.google.com/maps?q=-33.46995314905984,-71.11157595000172" target="_blank" rel="noopener noreferrer">
                <?php esc_html_e('Ver en Google Maps', 'alatina-base'); ?>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="page-sidecard">
            <div class="page-sidecard__panel">
              <h3><?php esc_html_e('Ubicación', 'alatina-base'); ?></h3>
              <p><strong>Dirección:</strong><br>Ruta J-55 Km 2, Avenida Ramón Freire 2004, Romeral<br><em>Entrada por Callejón Las Catreras</em></p>
              <p><a href="https://www.google.com/maps?q=-33.46995314905984,-71.11157595000172" target="_blank" rel="noopener">Ver en Google Maps</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
