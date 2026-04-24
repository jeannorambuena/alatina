<?php
/**
 * Template Name: Galería
 */

get_header();
$nextgen_ready = shortcode_exists('ngg_images') || shortcode_exists('nggallery');
?>
<main class="site-main site-main--internal gallery-page">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero page-hero--galeria page-hero--info-school">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced gallery-page__hero-surface">
            <div class="page-hero__grid gallery-page__hero-grid">
              <div class="page-hero__main gallery-page__hero-main">
                <p class="eyebrow"><?php esc_html_e('Galería', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="lead"><?php esc_html_e('Fotografía escolar en una vitrina editorial clara, cálida y contemporánea.', 'alatina-base'); ?></p>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>

  <section class="page-section page-section--gallery-showcase">
    <div class="container">
      <?php if ($nextgen_ready) : ?>
        <section class="gallery-page__feature-shell">
          <div class="gallery-page__feature-head">
            <div>
              <p class="section-tag mb-2"><?php esc_html_e('Galería destacada', 'alatina-base'); ?></p>
              <h2><?php esc_html_e('Galería destacada · Actividades 2026', 'alatina-base'); ?></h2>
            </div>
            <p><?php esc_html_e('Desde aquí se presenta la galería principal y, más abajo, se podrán ir incorporando las siguientes publicaciones fotográficas del sitio.', 'alatina-base'); ?></p>
          </div>
          <div class="gallery-page__feature-content entry-content entry-content--page">
            <?php echo do_shortcode('[imagely id="1"]'); ?>
          </div>
        </section>
      <?php else : ?>
        <div class="content-card gallery-page__empty-state">
          <p class="section-tag mb-2"><?php esc_html_e('Galería en preparación', 'alatina-base'); ?></p>
          <h2><?php esc_html_e('NextGEN aún no está disponible para esta vista pública.', 'alatina-base'); ?></h2>
          <p><?php esc_html_e('Cuando el plugin esté activo y la galería tenga contenido publicado, aquí aparecerá una presentación visual principal lista para la comunidad.', 'alatina-base'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer();
