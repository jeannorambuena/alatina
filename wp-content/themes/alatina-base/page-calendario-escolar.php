<?php
get_header();
?>
<main class="site-main site-main--internal site-main--calendar-school">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-section page-section--calendar-school">
        <div class="container">
          <article id="post-<?php the_ID(); ?>" <?php post_class('content-card content-card--primary entry entry--page'); ?>>
            <div class="institutional-stack institutional-stack--calendar-direct">
              <section class="model-section model-section--calendar-intro">
                <p class="section-kicker"><?php esc_html_e('Planificación institucional', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p><?php esc_html_e('Revise actividades, reuniones, evaluaciones y fechas relevantes del mes escolar.', 'alatina-base'); ?></p>
              </section>

              <section class="model-section model-section--calendar-live">
                <?php echo do_shortcode('[alatina_school_calendar]'); ?>
              </section>

              <section class="model-section model-section--calendar-note">
                <h2><?php esc_html_e('Información general', 'alatina-base'); ?></h2>
                <p><?php esc_html_e('Aquí se publicarán actividades institucionales, reuniones, evaluaciones y fechas relevantes para estudiantes, familias y apoderados.', 'alatina-base'); ?></p>
                <p><?php esc_html_e('Información en actualización: el calendario visual se refresca periódicamente con nuevas actividades cuando la escuela o el sistema de publicación incorporan eventos válidos.', 'alatina-base'); ?></p>
                <p><?php esc_html_e('Si todavía no aparecen actividades en el mes actual, la estructura seguirá visible para revisión local sin modificar el plugin del calendario.', 'alatina-base'); ?></p>

                <div class="page-sidecard__links">
                  <a class="text-link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Volver a portada', 'alatina-base'); ?></a>
                  <a class="text-link" href="<?php echo esc_url(alatina_base_get_page_url('documentos')); ?>"><?php esc_html_e('Ir a documentos', 'alatina-base'); ?></a>
                  <a class="text-link" href="<?php echo esc_url(alatina_base_get_page_url('contacto')); ?>"><?php esc_html_e('Ir a contacto', 'alatina-base'); ?></a>
                </div>
              </section>

              <?php if (trim(wp_strip_all_tags(get_the_content()))) : ?>
                <section class="model-section">
                  <div class="entry-content entry-content--page">
                    <?php the_content(); ?>
                  </div>
                </section>
              <?php endif; ?>
            </div>
          </article>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>
</main>
<?php
get_footer();
