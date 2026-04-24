<?php
get_header();

$paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

$news_query = new WP_Query(array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 7,
    'paged'               => $paged,
    'ignore_sticky_posts' => true,
));

$featured_post = null;
$grid_posts    = array();

if ($news_query->have_posts()) {
    $posts = $news_query->posts;

    if (!empty($posts[0])) {
        $featured_post = $posts[0];
        $grid_posts    = array_slice($posts, 1);
    }
}
?>

<main class="site-main site-main--internal news-archive-page">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced">
            <div class="page-hero__grid">
              <div class="page-hero__main">
                <p class="eyebrow"><?php esc_html_e('Noticias', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>

                <p class="lead">
                  <?php
                  if (has_excerpt()) {
                      echo esc_html(get_the_excerpt());
                  } else {
                      esc_html_e('Revise comunicados, actividades, hitos y publicaciones recientes de la comunidad educativa.', 'alatina-base');
                  }
                  ?>
                </p>

                <div class="page-hero__chips">
                  <span class="page-chip page-chip--active"><?php echo esc_html((string) $news_query->found_posts); ?> <?php esc_html_e('publicaciones', 'alatina-base'); ?></span>
                  <a class="page-chip" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Volver a portada', 'alatina-base'); ?></a>
                </div>
              </div>

              <aside class="page-hero__aside">
                <p class="page-hero__aside-label"><?php esc_html_e('Sección editorial', 'alatina-base'); ?></p>
                <h2><?php esc_html_e('Actualidad escolar', 'alatina-base'); ?></h2>
                <ul class="page-hero__meta">
                  <li>
                    <strong><?php esc_html_e('Contenido', 'alatina-base'); ?></strong>
                    <span><?php esc_html_e('Noticias, avisos y comunicados', 'alatina-base'); ?></span>
                  </li>
                  <li>
                    <strong><?php esc_html_e('Actualización', 'alatina-base'); ?></strong>
                    <span><?php echo esc_html($news_query->have_posts() ? get_the_date('', $featured_post) : __('Sin publicaciones aún', 'alatina-base')); ?></span>
                  </li>
                </ul>
              </aside>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>

  <section class="page-section page-section--news-archive">
    <div class="container">
      <?php if ($featured_post instanceof WP_Post) : ?>
        <?php
        setup_postdata($featured_post);
        $featured_categories = get_the_category($featured_post->ID);
        $featured_category   = !empty($featured_categories) ? $featured_categories[0]->name : __('Comunidad educativa', 'alatina-base');
        ?>
        <article class="content-card news-card news-card--featured news-card--archive-featured">
          <div class="news-card--archive-featured__media">
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail($featured_post)) : ?>
                <?php echo get_the_post_thumbnail($featured_post->ID, 'large', array('class' => 'img-fluid w-100')); ?>
              <?php else : ?>
                <div class="news-card--archive-featured__placeholder">
                  <span><?php esc_html_e('Noticia destacada', 'alatina-base'); ?></span>
                </div>
              <?php endif; ?>
            </a>
          </div>

          <div class="news-card--archive-featured__body">
            <div class="news-card__meta">
              <span><?php echo esc_html(get_the_date('', $featured_post)); ?></span>
              <span class="news-card__meta-separator" aria-hidden="true">•</span>
              <span><?php echo esc_html($featured_category); ?></span>
            </div>
            <h2 class="news-card__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="news-card__excerpt">
              <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 36)); ?></p>
            </div>
            <a class="btn btn-outline-primary rounded-pill px-4" href="<?php the_permalink(); ?>">
              <?php esc_html_e('Leer noticia', 'alatina-base'); ?>
            </a>
          </div>
        </article>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>

      <?php if (!empty($grid_posts)) : ?>
        <div class="news-grid news-grid--archive">
          <?php foreach ($grid_posts as $grid_post) : ?>
            <?php
            setup_postdata($grid_post);
            $grid_categories = get_the_category($grid_post->ID);
            $grid_category   = !empty($grid_categories) ? $grid_categories[0]->name : __('Comunidad educativa', 'alatina-base');
            ?>
            <article class="content-card news-card news-card--archive">
              <a class="news-card--archive__thumb" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail($grid_post)) : ?>
                  <?php echo get_the_post_thumbnail($grid_post->ID, 'medium_large', array('class' => 'img-fluid w-100')); ?>
                <?php else : ?>
                  <div class="news-card--archive__placeholder">
                    <span><?php esc_html_e('Actualidad escolar', 'alatina-base'); ?></span>
                  </div>
                <?php endif; ?>
              </a>

              <div class="news-card--archive__body">
                <div class="news-card__meta">
                  <span><?php echo esc_html(get_the_date('', $grid_post)); ?></span>
                  <span class="news-card__meta-separator" aria-hidden="true">•</span>
                  <span><?php echo esc_html($grid_category); ?></span>
                </div>
                <h2 class="news-card__title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="news-card__excerpt">
                  <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                </div>
                <a class="news-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e('Leer noticia', 'alatina-base'); ?></a>
              </div>
            </article>
          <?php endforeach; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      <?php elseif (!$featured_post instanceof WP_Post) : ?>
        <article class="content-card news-card news-card--archive-empty">
          <div class="news-card__meta"><?php esc_html_e('Sin publicaciones', 'alatina-base'); ?></div>
          <h2 class="news-card__title"><?php esc_html_e('Aún no hay noticias publicadas en esta sección', 'alatina-base'); ?></h2>
          <div class="news-card__excerpt">
            <p><?php esc_html_e('Cuando se publiquen noticias, aparecerán aquí con su imagen destacada, resumen y acceso al detalle.', 'alatina-base'); ?></p>
          </div>
        </article>
      <?php endif; ?>

      <?php if ($news_query->max_num_pages > 1) : ?>
        <nav class="news-pagination" aria-label="<?php esc_attr_e('Paginación de noticias', 'alatina-base'); ?>">
          <?php
          echo wp_kses_post(paginate_links(array(
              'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              'format'    => '?paged=%#%',
              'current'   => $paged,
              'total'     => $news_query->max_num_pages,
              'mid_size'  => 1,
              'prev_text' => __('Anterior', 'alatina-base'),
              'next_text' => __('Siguiente', 'alatina-base'),
              'type'      => 'list',
          )));
          ?>
        </nav>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php
wp_reset_postdata();
get_footer();
