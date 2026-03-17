<?php
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero">
    <div class="wrap page-hero__content">
      <p class="eyebrow"><?php esc_html_e('Contenido', 'alatina-base'); ?></p>
      <h1><?php bloginfo('name'); ?></h1>
      <p class="lead"><?php bloginfo('description'); ?></p>
    </div>
  </section>

  <section class="page-section">
    <div class="wrap content-layout">
      <div class="content-card">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
              <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              </header>
              <div class="entry-content">
                <?php the_excerpt(); ?>
              </div>
            </article>
          <?php endwhile; ?>
        <?php else : ?>
          <article class="entry entry--empty">
            <h2><?php esc_html_e('Próximamente', 'alatina-base'); ?></h2>
            <p><?php esc_html_e('Aún no hay publicaciones disponibles en esta sección.', 'alatina-base'); ?></p>
          </article>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
