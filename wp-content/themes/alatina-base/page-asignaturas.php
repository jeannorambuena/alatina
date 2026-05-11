<?php
/**
 * Template Name: Asignaturas
 */

get_header();

$subject_cards = array(
    array('slug' => 'lenguaje-y-comunicacion', 'title' => __('Lenguaje y Comunicación', 'alatina-base')),
    array('slug' => 'matematica', 'title' => __('Matemática', 'alatina-base')),
    array('slug' => 'ciencias-naturales', 'title' => __('Ciencias Naturales', 'alatina-base')),
    array('slug' => 'historia-geografia-y-ciencias-sociales', 'title' => __('Historia, Geografía y Ciencias Sociales', 'alatina-base')),
    array('slug' => 'ingles', 'title' => __('Inglés', 'alatina-base')),
    array('slug' => 'educacion-fisica-y-salud', 'title' => __('Educación Física y Salud', 'alatina-base')),
    array('slug' => 'artes-visuales-y-musica', 'title' => __('Artes Visuales y Música', 'alatina-base')),
    array('slug' => 'tecnologia', 'title' => __('Tecnología', 'alatina-base')),
    array('slug' => 'orientacion-y-convivencia-escolar', 'title' => __('Orientación y Convivencia Escolar', 'alatina-base')),
);
?>
<main class="site-main site-main--internal site-main--subjects">
  <section class="page-hero page-hero--subjects page-hero--info-school">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Asignaturas', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Asignaturas', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('[CONTENIDO TEMPORAL] Esta sección será actualizada con información oficial sobre asignaturas, talleres y áreas de aprendizaje de la Escuela América Latina.', 'alatina-base'); ?></p>
            <div class="page-hero__chips">
              <span class="page-chip page-chip--active"><?php esc_html_e('Información en validación', 'alatina-base'); ?></span>
              <a class="page-chip" href="<?php echo esc_url(alatina_base_get_page_url('contacto')); ?>"><?php esc_html_e('Contacto y orientación', 'alatina-base'); ?></a>
              <a class="page-chip" href="<?php echo esc_url(alatina_base_get_page_url('noticias')); ?>"><?php esc_html_e('Ir a noticias', 'alatina-base'); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="page-section page-section--subjects">
    <div class="container">
      <div class="content-card content-card--primary mb-4">
        <div class="entry-content entry-content--page">
          <h2><?php esc_html_e('Áreas de aprendizaje en esta versión visual', 'alatina-base'); ?></h2>
          <p><?php esc_html_e('Información referencial en validación. Será reemplazada por el detalle oficial entregado por la escuela.', 'alatina-base'); ?></p>
        </div>
      </div>

      <div class="row g-4">
        <?php foreach ($subject_cards as $card) : ?>
          <div class="col-md-6 col-xl-4">
            <article id="<?php echo esc_attr($card['slug']); ?>" class="content-card content-card--subject h-100">
              <div class="subject-card__eyebrow"><?php esc_html_e('[CONTENIDO TEMPORAL]', 'alatina-base'); ?></div>
              <h2 class="subject-card__title"><?php echo esc_html($card['title']); ?></h2>
              <p class="subject-card__text"><?php esc_html_e('Información referencial en validación. Será reemplazada por el detalle oficial entregado por la escuela.', 'alatina-base'); ?></p>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
