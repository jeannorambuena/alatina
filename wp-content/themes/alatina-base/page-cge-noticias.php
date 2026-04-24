<?php
/*
Template Name: CGE - Noticias y Comunicados
*/
get_header();

if (have_posts()) {
    the_post();
}

$page_title   = get_the_title() ? get_the_title() : __('Noticias del CGE', 'alatina-base');
$page_content = trim(get_the_content());

$cge_category = null;
$cge_candidate_slugs = array('cge', 'centro-general-de-alumnos', 'centro-de-estudiantes');

foreach ($cge_candidate_slugs as $candidate_slug) {
    $candidate_category = get_category_by_slug($candidate_slug);
    if ($candidate_category instanceof WP_Term) {
        $cge_category = $candidate_category;
        break;
    }
}

$cge_posts = null;
if ($cge_category) {
    $cge_posts = new WP_Query(array(
        'post_type'           => 'post',
        'posts_per_page'      => 12,
        'paged'               => max(1, get_query_var('paged')),
        'ignore_sticky_posts' => true,
        'cat'                 => (int) $cge_category->term_id,
    ));
}
?>

<main class="site-main cgp-noticias-page">
  <section class="cgp-noticias-page__hero py-5">
    <div class="container">
      <div class="cgp-noticias-page__hero-card">
        <span class="section-tag"><?php esc_html_e('Centro General de Alumnos', 'alatina-base'); ?></span>
        <h1 class="section-title"><?php echo esc_html($page_title); ?></h1>
        <p class="section-copy mb-0"><?php esc_html_e('Publicaciones, comunicados y novedades del Centro General de Alumnos. Aquí encontrarás información sobre actividades, campañas, participación y avances del estudiantado.', 'alatina-base'); ?></p>

        <div class="cgp-noticias-page__actions mt-4">
          <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url(alatina_base_get_page_url('cge')); ?>"><?php esc_html_e('Volver a CGE', 'alatina-base'); ?></a>
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

  <section id="cge-stream" class="cgp-noticias-page__stream py-5">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Publicaciones', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php esc_html_e('Comunicados y novedades', 'alatina-base'); ?></h2>
          <p class="section-copy mb-0"><?php esc_html_e('Las publicaciones se ordenan cronológicamente para mantener informada a la comunidad estudiantil.', 'alatina-base'); ?></p>
        </div>
      </div>

      <?php if ($cge_posts && $cge_posts->have_posts()) : ?>
        <div class="row g-4">
          <?php while ($cge_posts->have_posts()) : $cge_posts->the_post(); ?>
            <div class="col-lg-6">
              <article class="cgp-stream-card h-100">
                <a class="cgp-stream-card__media" href="<?php the_permalink(); ?>">
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                  <?php else : ?>
                    <div class="cgp-stream-card__placeholder">
                      <span><?php esc_html_e('Centro General de Alumnos', 'alatina-base'); ?></span>
                    </div>
                  <?php endif; ?>
                </a>

                <div class="cgp-stream-card__body">
                  <div class="cgp-stream-card__meta">
                    <span><?php echo esc_html(get_the_date()); ?></span>
                    <?php if ($cge_category) : ?>
                      <span class="cgp-stream-card__category"><?php echo esc_html($cge_category->name); ?></span>
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

        <?php if ($cge_posts->max_num_pages > 1) : ?>
          <nav class="pagination-nav mt-5 pt-3">
            <?php echo paginate_links(array(
                'total'   => $cge_posts->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'type'    => 'list',
            )); ?>
          </nav>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="cgp-empty-state text-center py-5">
          <div class="mx-auto" style="max-width: 760px;">
            <span class="section-tag d-inline-flex mb-3"><?php esc_html_e('Próximamente', 'alatina-base'); ?></span>
            <h3 class="mb-3"><?php esc_html_e('Noticias del CGE próximas a publicarse', 'alatina-base'); ?></h3>
            <p class="text-muted mb-4"><?php esc_html_e('Cuando existan publicaciones del Centro General de Alumnos, se mostrarán aquí con el mismo formato institucional del sitio.', 'alatina-base'); ?></p>
            <div class="row g-3 text-start">
              <div class="col-md-4">
                <article class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-body">
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-3"><?php esc_html_e('Comunicado', 'alatina-base'); ?></span>
                    <h4 class="h6 mb-2"><?php esc_html_e('Organización estudiantil', 'alatina-base'); ?></h4>
                    <p class="text-muted mb-0"><?php esc_html_e('Resumen de iniciativas y actividades impulsadas por el CGE.', 'alatina-base'); ?></p>
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-body">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3"><?php esc_html_e('Actividad', 'alatina-base'); ?></span>
                    <h4 class="h6 mb-2"><?php esc_html_e('Participación estudiantil', 'alatina-base'); ?></h4>
                    <p class="text-muted mb-0"><?php esc_html_e('Novedades sobre campañas, reuniones y acciones del CGE.', 'alatina-base'); ?></p>
                  </div>
                </article>
              </div>
              <div class="col-md-4">
                <article class="card border-0 shadow-sm rounded-4 h-100">
                  <div class="card-body">
                    <span class="badge bg-info-subtle text-info rounded-pill px-3 py-2 mb-3"><?php esc_html_e('Informe', 'alatina-base'); ?></span>
                    <h4 class="h6 mb-2"><?php esc_html_e('Avances y acuerdos', 'alatina-base'); ?></h4>
                    <p class="text-muted mb-0"><?php esc_html_e('Registro de avances y acuerdos relevantes para la comunidad estudiantil.', 'alatina-base'); ?></p>
                  </div>
                </article>
              </div>
            </div>
            <div class="mt-4">
              <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(alatina_base_get_page_url('cge')); ?>"><?php esc_html_e('Volver al hub CGE', 'alatina-base'); ?></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php
get_footer();
