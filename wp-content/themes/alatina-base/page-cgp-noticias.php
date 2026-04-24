<?php
/*
Template Name: CGP - Noticias y Comunicados
*/
get_header();

if (have_posts()) {
    the_post();
}

$page_title   = get_the_title() ? get_the_title() : __('Noticias del CGP', 'alatina-base');
$page_content = trim(get_the_content());

$cgp_category = null;
$cgp_candidate_slugs = array('cgp', 'centro-general-de-padres', 'padres-y-apoderados');

foreach ($cgp_candidate_slugs as $candidate_slug) {
    $candidate_category = get_category_by_slug($candidate_slug);
    if ($candidate_category instanceof WP_Term) {
        $cgp_category = $candidate_category;
        break;
    }
}

$cgp_posts = null;
if ($cgp_category) {
    $cgp_posts = new WP_Query(array(
        'post_type'           => 'post',
        'posts_per_page'      => 12,
        'paged'               => max(1, get_query_var('paged')),
        'ignore_sticky_posts' => true,
        'cat'                 => (int) $cgp_category->term_id,
    ));
}
?>

<main class="site-main cgp-noticias-page">
  <section class="cgp-noticias-page__hero py-5">
    <div class="container">
      <div class="cgp-noticias-page__hero-card">
        <span class="section-tag"><?php esc_html_e('Centro General de Padres', 'alatina-base'); ?></span>
        <h1 class="section-title"><?php echo esc_html($page_title); ?></h1>
        <p class="section-copy mb-0"><?php esc_html_e('Publicaciones, comunicados y novedades del Centro General de Padres y Apoderados. Aquí encontrarás información sobre actividades, reuniones, avances y participación de la comunidad de apoderados.', 'alatina-base'); ?></p>

        <div class="cgp-noticias-page__actions mt-4">
          <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url(alatina_base_get_page_url('cgp')); ?>"><?php esc_html_e('Volver a CGP', 'alatina-base'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <?php if (! empty($page_content)) : ?>
    <section class="cgp-noticias-page__intro-section pb-2">
      <div class="container">
        <article class="cgp-noticias-page__intro-card">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
              <?php the_content(); ?>
            </div>
          </div>
        </article>
      </div>
    </section>
  <?php endif; ?>

  <section id="cgp-stream" class="cgp-noticias-page__stream py-5">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Publicaciones', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php esc_html_e('Comunicados y novedades', 'alatina-base'); ?></h2>
          <p class="section-copy mb-0"><?php esc_html_e('Las publicaciones están ordenadas cronológicamente para mantener a la comunidad de apoderados actualizada.', 'alatina-base'); ?></p>
        </div>
      </div>

      <?php if ($cgp_posts && $cgp_posts->have_posts()) : ?>
        <div class="row g-4">
          <?php while ($cgp_posts->have_posts()) : $cgp_posts->the_post(); ?>
            <div class="col-lg-6">
              <article class="cgp-stream-card h-100">
                <a class="cgp-stream-card__media" href="<?php the_permalink(); ?>">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                  <?php else : ?>
                    <div class="cgp-stream-card__placeholder">
                      <span><?php esc_html_e('Centro General de Padres', 'alatina-base'); ?></span>
                    </div>
                  <?php endif; ?>
                </a>

                <div class="cgp-stream-card__body">
                  <div class="cgp-stream-card__meta">
                    <span><?php echo esc_html(get_the_date()); ?></span>
                    <?php if ($cgp_category) : ?>
                      <span class="cgp-stream-card__category"><?php echo esc_html($cgp_category->name); ?></span>
                    <?php endif; ?>
                  </div>

                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                  <a class="cgp-stream-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e('Leer publicación', 'alatina-base'); ?></a>
                </div>
              </article>
            </div>
          <?php endwhile; ?>
        </div>

        <?php if ($cgp_posts->max_num_pages > 1) : ?>
          <nav class="pagination-nav mt-5 pt-3">
            <?php echo paginate_links(array(
                'total'   => $cgp_posts->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'type'    => 'list',
            )); ?>
          </nav>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="cgp-empty-state text-center py-5">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body py-5">
              <h3 class="mb-3"><?php esc_html_e('Noticias del CGP próximas a publicarse', 'alatina-base'); ?></h3>
              <p class="text-muted mb-4"><?php esc_html_e('Esta página está preparada para mostrar los comunicados, reuniones y avances del Centro General de Padres. Mientras no haya publicaciones reales, mostramos ejemplos del tipo de contenido que estará disponible.', 'alatina-base'); ?></p>
              <div class="row g-4 mb-4">
                <div class="col-md-4">
                  <article class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                      <h4 class="h6"><?php esc_html_e('Convocatoria a reunión de padres', 'alatina-base'); ?></h4>
                      <p class="text-muted mb-0"><?php esc_html_e('Reunión de directiva para revisar proyectos y coordinación de actividades.', 'alatina-base'); ?></p>
                    </div>
                  </article>
                </div>
                <div class="col-md-4">
                  <article class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                      <h4 class="h6"><?php esc_html_e('Avance de proyecto de convivencia', 'alatina-base'); ?></h4>
                      <p class="text-muted mb-0"><?php esc_html_e('Resumen de las acciones del CGP para fortalecer la convivencia escolar.', 'alatina-base'); ?></p>
                    </div>
                  </article>
                </div>
                <div class="col-md-4">
                  <article class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                      <h4 class="h6"><?php esc_html_e('Informe de recursos y aportes', 'alatina-base'); ?></h4>
                      <p class="text-muted mb-0"><?php esc_html_e('Registro de aportes y gastos del CGP para las familias.', 'alatina-base'); ?></p>
                    </div>
                  </article>
                </div>
              </div>
              <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(alatina_base_get_page_url('cgp')); ?>"><?php esc_html_e('Volver al hub CGP', 'alatina-base'); ?></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer();
