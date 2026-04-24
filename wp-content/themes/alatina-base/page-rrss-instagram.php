<?php
/**
 * Template Name: RRSS Instagram
 */

get_header();
$instagram_url = function_exists('alatina_base_get_rrss_url') ? alatina_base_get_rrss_url('instagram') : '#';
?>
<main class="site-main site-main--internal">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero page-hero--rrss-instagram page-hero--info-school">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced">
            <div class="page-hero__grid">
              <div class="page-hero__main">
                <p class="eyebrow"><?php esc_html_e('RRSS', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="lead"><?php esc_html_e('Nuestro Instagram reúne publicaciones visuales de actividades, celebraciones, hitos y vida escolar, con una mirada cercana y actualizada de la comunidad educativa.', 'alatina-base'); ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>

  <section class="page-section">
    <div class="container">
      <div class="row g-3 align-items-start">
        <div class="col-lg-8">
          <div class="content-card">
            <h2><?php esc_html_e('Instagram institucional', 'alatina-base'); ?></h2>
            <div class="entry-content entry-content--page">
              <p><?php esc_html_e('Este espacio centraliza el acceso al Instagram oficial del establecimiento para revisar imágenes, novedades y registros de la vida escolar compartidos por el equipo de comunicaciones.', 'alatina-base'); ?></p>
              <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer">
                <?php esc_html_e('Ir a Instagram oficial', 'alatina-base'); ?>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="page-sidecard">
            <div class="page-sidecard__panel">
              <h3><?php esc_html_e('Qué encontrarás', 'alatina-base'); ?></h3>
              <p><?php esc_html_e('Galerías breves, piezas visuales, actividades y publicaciones rápidas para seguir el día a día del establecimiento.', 'alatina-base'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php get_footer();
