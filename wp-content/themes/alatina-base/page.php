<?php
get_header();
?>
<main class="site-main site-main--internal">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero">
        <div class="wrap page-hero__content">
          <div class="page-hero__surface">
            <p class="eyebrow"><?php esc_html_e('Página institucional', 'alatina-base'); ?></p>
            <h1><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
              <p class="lead"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php else : ?>
              <p class="lead"><?php bloginfo('description'); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </section>

      <section class="page-section">
        <div class="wrap content-layout">
          <article id="post-<?php the_ID(); ?>" <?php post_class('content-card entry entry--page'); ?>>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
          </article>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>
</main>
<?php
get_footer();
