<?php
/**
 * Template Name: Documentos
 */

get_header();
?>
<main class="site-main site-main--internal">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero page-hero--documentos page-hero--info-school">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced">
            <div class="page-hero__grid">
              <div class="page-hero__main">
                <p class="eyebrow"><?php esc_html_e('Documentos', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="lead">En esta sección la comunidad educativa podrá acceder a documentos institucionales relevantes para la vida escolar. Aquí se publican instrumentos de gestión, reglamentos y otros archivos de consulta permanente.</p>
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
            <h2><?php esc_html_e('Documentos disponibles', 'alatina-base'); ?></h2>
            <ul>
              <li><a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/2825/ProyectoEducativo2825.pdf" target="_blank" rel="noopener noreferrer">PEI 2026</a></li>
              <li><a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/2825/ReglamentodeConvivencia2825.pdf" target="_blank" rel="noopener noreferrer">Reglamento Interno 2025</a></li>
              <li><a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/2825/ReglamentoDeEvaluacion2825.pdf" target="_blank" rel="noopener noreferrer">Reglamento de Evaluación 2025</a></li>
            </ul>

            <div class="entry-content entry-content--page">
              <div class="alert alert-light border rounded-4 mb-4" role="status">
                <strong><?php esc_html_e('Información en actualización.', 'alatina-base'); ?></strong>
                <span><?php esc_html_e(' Esta sección mantendrá visibles los documentos ya publicados y agregará nuevos archivos cuando la escuela entregue sus versiones oficiales.', 'alatina-base'); ?></span>
              </div>

              <h3><?php esc_html_e('Categorías preparadas', 'alatina-base'); ?></h3>
              <ul>
                <li><?php esc_html_e('Proyecto Educativo', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Reglamentos', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Convivencia escolar', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Evaluación', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Formularios', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Centro de Padres', 'alatina-base'); ?></li>
              </ul>

              <h3><?php esc_html_e('Pendientes de carga oficial', 'alatina-base'); ?></h3>
              <ul>
                <li><?php esc_html_e('Documento pendiente de carga oficial', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Documento pendiente de carga oficial', 'alatina-base'); ?></li>
              </ul>

              <?php the_content(); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="page-sidecard">
            <div class="page-sidecard__panel">
              <h3><?php esc_html_e('Información', 'alatina-base'); ?></h3>
              <p>Los documentos se actualizan periódicamente. Si necesitas una versión específica, contacta con la dirección.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
