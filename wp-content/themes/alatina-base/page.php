<?php
/**
 * Generic page template refined for Alatina.
 * Compact v4: removes extra vertical space inside the top header card and
 * brings the main content much closer.
 *
 * @package alatina-base
 */

get_header();
?>
<main class="site-main institutional-page institutional-page--compact-v4<?php echo is_page('quienes-somos') ? ' institutional-page--quienes-somos' : ''; ?>">
    <style>
        .institutional-page--compact-v4 .institutional-page__intro {
            padding-top: .7rem !important;
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }

        .institutional-page--compact-v4 .institutional-page__content-wrap {
            padding-top: 0 !important;
            padding-bottom: 1.35rem !important;
            margin-top: -1.05rem !important;
        }

        .institutional-page--quienes-somos.institutional-page--compact-v4 .institutional-page__content-wrap {
            margin-top: 1.65rem !important;
        }

        .institutional-page--compact-v4 .institutional-page__content-wrap .row {
            --bs-gutter-y: .5rem;
        }

        .institutional-page--compact-v4 .institutional-page__intro-card,
        .institutional-page--compact-v4 .institutional-page__content-card,
        .institutional-page--compact-v4 .institutional-page__side-card {
            display: block !important;
            height: auto !important;
            min-height: 0 !important;
            margin-bottom: 0 !important;
        }

        .institutional-page--compact-v4 .institutional-page__intro-inner {
            padding: 1rem 1.35rem .85rem !important;
        }

        .institutional-page--compact-v4 .institutional-page__content-card .card-body,
        .institutional-page--compact-v4 .institutional-page__side-card .card-body {
            padding: 1.15rem 1.35rem !important;
            height: auto !important;
            min-height: 0 !important;
        }

        .institutional-page--compact-v4 .section-tag {
            margin-bottom: .45rem !important;
        }

        .institutional-page--compact-v4 .section-title {
            margin-bottom: .3rem !important;
            line-height: 1.08;
        }

        .institutional-page--compact-v4 .institutional-page__summary {
            margin-bottom: .65rem !important;
        }

        .institutional-page--compact-v4 .institutional-page__hero-actions {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            gap: .45rem !important;
        }

        .institutional-page--compact-v4 .institutional-page__hero-actions .btn {
            padding-top: .38rem;
            padding-bottom: .38rem;
        }

        .institutional-page--compact-v4 .institutional-page__intro-inner > *:last-child,
        .institutional-page--compact-v4 .card-body > *:last-child,
        .institutional-page--compact-v4 .entry-content > *:last-child {
            margin-bottom: 0 !important;
        }

        .institutional-page--compact-v4 .entry-content > *:first-child,
        .institutional-page--compact-v4 .entry-content h2:first-child,
        .institutional-page--compact-v4 .entry-content h3:first-child {
            margin-top: 0 !important;
        }

        .institutional-page--compact-v4 .institutional-page__placeholder {
            padding: .1rem 0 !important;
        }

        @media (min-width: 992px) {
            .institutional-page--compact-v4 .institutional-page__intro {
                padding-top: .7rem !important;
                padding-bottom: 0 !important;
            }

            .institutional-page--compact-v4 .institutional-page__intro-inner {
                padding: 1.05rem 1.45rem .9rem !important;
            }

            .institutional-page--compact-v4 .institutional-page__content-wrap {
                padding-bottom: 1.55rem !important;
                margin-top: -1.05rem !important;
            }

            .institutional-page--compact-v4 .institutional-page__content-card .card-body,
            .institutional-page--compact-v4 .institutional-page__side-card .card-body {
                padding: 1.2rem 1.45rem !important;
            }
        }
    </style>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $page_slug = get_post_field('post_name', get_the_ID());
    $model     = function_exists('alatina_base_get_institutional_page_model')
        ? alatina_base_get_institutional_page_model($page_slug)
        : array();

    $eyebrow = !empty($model['eyebrow'])
        ? $model['eyebrow']
        : __('Página institucional', 'alatina-base');

    $summary = '';
    if (has_excerpt()) {
        $summary = get_the_excerpt();
    } elseif (!empty($model['summary'])) {
        $summary = $model['summary'];
    } else {
        $summary = __('Información institucional disponible para la comunidad educativa.', 'alatina-base');
    }

    $highlights = !empty($model['highlights']) && is_array($model['highlights'])
        ? array_values(array_filter($model['highlights']))
        : array();

    $hero_cta_label = !empty($model['header_cta_label']) ? $model['header_cta_label'] : '';
    $hero_cta_url   = !empty($model['header_cta_url']) ? $model['header_cta_url'] : '';

    $raw_content = get_post_field('post_content', get_the_ID());
    $has_content = '' !== trim(wp_strip_all_tags($raw_content));

    $cgp_url = function_exists('alatina_base_get_page_url') ? alatina_base_get_page_url('cgp') : '';
    if (empty($cgp_url) || home_url('/') === $cgp_url) {
        $cgp_url = home_url('/cgp-noticias/');
    }

    $quick_links = array(
        array(
            'label' => __('Historia', 'alatina-base'),
            'url'   => function_exists('alatina_base_get_page_url') ? alatina_base_get_page_url('historia') : home_url('/historia/'),
        ),
        array(
            'label' => __('Noticias', 'alatina-base'),
            'url'   => function_exists('alatina_base_get_page_url') ? alatina_base_get_page_url('noticias') : home_url('/noticias/'),
        ),
        array(
            'label' => __('CGP', 'alatina-base'),
            'url'   => $cgp_url,
        ),
        array(
            'label' => __('Contacto', 'alatina-base'),
            'url'   => function_exists('alatina_base_get_page_url') ? alatina_base_get_page_url('contacto') : home_url('/contacto/'),
        ),
    );

    $quick_links = array_values(array_filter(
        $quick_links,
        static function ($item) use ($page_slug) {
            return !empty($item['url']) && untrailingslashit($item['url']) !== untrailingslashit(home_url('/' . $page_slug . '/'));
        }
    ));
    ?>

    <section class="institutional-page__intro">
        <div class="container">
            <div class="row g-2 align-items-start">
                <div class="col-12">
                    <section class="card border-0 shadow-sm rounded-4 institutional-page__intro-card">
                        <div class="institutional-page__intro-inner">
                            <span class="section-tag"><?php echo esc_html($eyebrow); ?></span>
                            <h1 class="section-title"><?php the_title(); ?></h1>
                            <p class="section-copy institutional-page__summary"><?php echo esc_html($summary); ?></p>

                            <?php if (!empty($quick_links) || (!empty($hero_cta_label) && !empty($hero_cta_url))) : ?>
                                <div class="d-flex flex-wrap institutional-page__hero-actions">
                                    <?php foreach ($quick_links as $link) : ?>
                                        <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url($link['url']); ?>">
                                            <?php echo esc_html($link['label']); ?>
                                        </a>
                                    <?php endforeach; ?>

                                    <?php if (!empty($hero_cta_label) && !empty($hero_cta_url)) : ?>
                                        <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url($hero_cta_url); ?>">
                                            <?php echo esc_html($hero_cta_label); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="institutional-page__content-wrap">
        <div class="container">
            <div class="row g-3 align-items-start">
                <div class="col-lg-8">
                    <article <?php post_class('card border-0 shadow-sm rounded-4 overflow-hidden institutional-page__content-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="institutional-page__featured-media">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid w-100 h-auto')); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <?php if ($has_content) : ?>
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                    <?php
                                    wp_link_pages(array(
                                        'before' => '<div class="page-links mt-4"><span class="page-links__label">' . esc_html__('Páginas:', 'alatina-base') . '</span>',
                                        'after'  => '</div>',
                                    ));
                                    ?>
                                </div>
                            <?php else : ?>
                                <div class="institutional-page__placeholder">
                                    <h2 class="h3 mb-2"><?php esc_html_e('Próximamente', 'alatina-base'); ?></h2>
                                    <p class="mb-2 text-muted">
                                        <?php echo esc_html($summary); ?>
                                    </p>

                                    <?php if (!empty($highlights)) : ?>
                                        <div class="row g-3 mt-0">
                                            <?php foreach ($highlights as $highlight) : ?>
                                                <div class="col-md-6">
                                                    <div class="card border-0 bg-light rounded-4">
                                                        <div class="card-body p-3">
                                                            <p class="mb-0 text-dark"><?php echo esc_html($highlight); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>

                <div class="col-lg-4">
                    <div class="d-grid gap-3">
                        <?php if (!empty($highlights)) : ?>
                            <section class="card border-0 shadow-sm rounded-4 institutional-page__side-card">
                                <div class="card-body">
                                    <p class="section-tag mb-3"><?php esc_html_e('Claves de lectura', 'alatina-base'); ?></p>
                                    <div class="d-grid gap-3">
                                        <?php foreach ($highlights as $highlight) : ?>
                                            <div class="border rounded-4 px-3 py-3 bg-light-subtle">
                                                <p class="mb-0 text-dark"><?php echo esc_html($highlight); ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif; ?>

                        <section class="card border-0 shadow-sm rounded-4 institutional-page__side-card">
                            <div class="card-body">
                                <p class="section-tag mb-3"><?php esc_html_e('Accesos directos', 'alatina-base'); ?></p>
                                <div class="d-grid gap-2">
                                    <?php foreach ($quick_links as $link) : ?>
                                        <a class="btn btn-light border rounded-pill text-start px-4" href="<?php echo esc_url($link['url']); ?>">
                                            <?php echo esc_html($link['label']); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>
</main>
<?php
get_footer();
