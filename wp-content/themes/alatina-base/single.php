<?php
get_header();

$news_page_url = function_exists('alatina_base_get_page_url')
    ? alatina_base_get_page_url('noticias')
    : home_url('/noticias/');

$contact_page_url = function_exists('alatina_base_get_page_url')
    ? alatina_base_get_page_url('contacto')
    : home_url('/contacto/');
?>

<main class="site-main site-main--internal">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced">
            <div class="page-hero__grid">
              <div class="page-hero__main">
                <p class="eyebrow"><?php esc_html_e('Noticias y avisos', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>

                <?php if (has_excerpt()) : ?>
                  <p class="lead"><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>

                <div class="page-hero__chips">
                  <a class="page-chip" href="<?php echo esc_url($news_page_url); ?>">
                    <?php esc_html_e('Volver a noticias', 'alatina-base'); ?>
                  </a>
                </div>
              </div>

              <aside class="page-hero__aside">
                <p class="page-hero__aside-label"><?php esc_html_e('Publicación', 'alatina-base'); ?></p>
                <h2><?php echo esc_html(get_the_date()); ?></h2>
                <ul class="page-hero__meta">
                  <li>
                    <strong><?php esc_html_e('Autor', 'alatina-base'); ?></strong>
                    <span><?php echo esc_html(get_the_author()); ?></span>
                  </li>
                  <li>
                    <strong><?php esc_html_e('Categorías', 'alatina-base'); ?></strong>
                    <span>
                      <?php
                      $categories = get_the_category();
                      if (!empty($categories)) {
                          echo esc_html(implode(', ', wp_list_pluck($categories, 'name')));
                      } else {
                          esc_html_e('Sin categoría', 'alatina-base');
                      }
                      ?>
                    </span>
                  </li>
                </ul>
              </aside>
            </div>
          </div>
        </div>
      </section>

      <section class="page-section">
        <div class="container internal-layout">
          <article id="post-<?php the_ID(); ?>" <?php post_class('content-card content-card--primary entry entry--single'); ?>>
            <?php if (has_post_thumbnail()) : ?>
              <div class="entry-featured-image mb-4">
                <?php the_post_thumbnail('large'); ?>
              </div>
            <?php endif; ?>

            <div class="entry-content entry-content--page">
              <?php the_content(); ?>
            </div>
          </article>

          <aside class="content-card page-sidecard">
            <div class="page-sidecard__panel page-sidecard__panel--intro">
              <p class="card__eyebrow"><?php esc_html_e('Resumen rápido', 'alatina-base'); ?></p>
              <h2><?php the_title(); ?></h2>
              <p>
                <?php
                if (has_excerpt()) {
                    echo esc_html(get_the_excerpt());
                } else {
                    esc_html_e('Publicación informativa de la comunidad educativa.', 'alatina-base');
                }
                ?>
              </p>
            </div>

            <div class="page-sidecard__panel">
              <p class="card__eyebrow"><?php esc_html_e('Accesos rápidos', 'alatina-base'); ?></p>
              <div class="page-sidecard__links">
                <a class="text-link" href="<?php echo esc_url($news_page_url); ?>">
                  <?php esc_html_e('Volver a noticias', 'alatina-base'); ?>
                </a>
                <a class="text-link" href="<?php echo esc_url(home_url('/')); ?>">
                  <?php esc_html_e('Volver a portada', 'alatina-base'); ?>
                </a>
                <a class="text-link" href="<?php echo esc_url($contact_page_url); ?>">
                  <?php esc_html_e('Ir a contacto', 'alatina-base'); ?>
                </a>
              </div>
            </div>
          </aside>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php
get_footer();
