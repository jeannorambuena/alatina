<?php
$recent_posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'ignore_sticky_posts' => true,
));
$events = alatina_base_get_home_events();
$milestones = alatina_base_get_home_milestones();
$quick_access_items = alatina_base_get_quick_access_items();
$hero_asset_base = get_template_directory_uri() . '/assets/images';
$hero_slides = alatina_base_get_hero_slides();
$school_calendar_page = get_page_by_path('calendario-escolar');
$school_calendar_url = $school_calendar_page ? get_permalink($school_calendar_page) : home_url('/calendario-escolar/');
$contact_page = get_page_by_path('contacto');
$contact_url  = $contact_page ? get_permalink($contact_page) : home_url('/contacto/');
$subjects_page = get_page_by_path('asignaturas');
$subjects_url  = $subjects_page ? get_permalink($subjects_page) : home_url('/asignaturas/');

$cgp_page = get_page_by_path('cgp');
$cgp_url  = $cgp_page ? get_permalink($cgp_page) : home_url('/cgp/');

$cgp_highlight = array(
    'label' => __('Centro General de Padres', 'alatina-base'),
    'title' => __('Información importante para padres y apoderados', 'alatina-base'),
    'text'  => __('Reuniones, hitos del calendario escolar, comunicaciones oficiales y avisos prácticos para acompañar el año académico.', 'alatina-base'),
    'url'   => $cgp_url,
    'cta'   => __('Ver información del CGP', 'alatina-base'),
);

$milestones = array_map(static function ($milestone) {
    $title = isset($milestone['title']) ? (string) $milestone['title'] : '';
    $text  = isset($milestone['text']) ? (string) $milestone['text'] : '';
    $combined = $title . ' ' . $text;

    if (preg_match('/\[CONTENIDO TEMPORAL\]|Información en validación/i', $combined) || preg_match('/borrad|placehold|validar/i', $combined)) {
        $milestone['title'] = __('[CONTENIDO TEMPORAL] Hito institucional en validación', 'alatina-base');
        $milestone['text']  = __('Información en actualización: próximamente se incorporarán hitos oficiales entregados por la escuela para esta sección.', 'alatina-base');
    }

    return $milestone;
}, $milestones);

get_header();
?>
<main class="site-main homepage-school">
  <div class="home-enrollment-toast" data-home-enrollment-toast aria-live="polite">
    <div class="home-enrollment-toast__backdrop" data-home-enrollment-close></div>
    <div class="home-enrollment-toast__dialog" role="dialog" aria-label="<?php esc_attr_e('Matrículas abiertas 2026', 'alatina-base'); ?>">
      <button type="button" class="home-enrollment-toast__close" data-home-enrollment-close aria-label="<?php esc_attr_e('Cerrar aviso de matrículas', 'alatina-base'); ?>">
        <span aria-hidden="true">×</span>
      </button>

      <a class="home-enrollment-toast__card" href="<?php echo esc_url($contact_url); ?>">
        <div class="home-enrollment-toast__grid">
          <div class="home-enrollment-toast__content">
            <span class="home-enrollment-toast__eyebrow"><?php esc_html_e('Información en validación', 'alatina-base'); ?></span>
            <h2>
              <span class="home-enrollment-toast__title-main"><?php esc_html_e('Admisión y matrícula', 'alatina-base'); ?></span>
              <span class="home-enrollment-toast__title-accent"><?php esc_html_e('2026', 'alatina-base'); ?></span>
              <span class="home-enrollment-toast__title-support"><?php esc_html_e('contenido temporal sujeto a confirmación', 'alatina-base'); ?></span>
            </h2>
            <p class="home-enrollment-toast__lead"><?php esc_html_e('Este aviso funciona como apoyo visual mientras la escuela confirma vacantes, niveles disponibles, horarios de atención y requisitos oficiales de matrícula.', 'alatina-base'); ?></p>

            <div class="home-enrollment-toast__status-list" aria-hidden="true">
              <span class="home-enrollment-toast__status home-enrollment-toast__status--available"><?php esc_html_e('Contacto disponible', 'alatina-base'); ?></span>
              <span class="home-enrollment-toast__status home-enrollment-toast__status--warm"><?php esc_html_e('Datos por validar', 'alatina-base'); ?></span>
              <span class="home-enrollment-toast__status home-enrollment-toast__status--soft"><?php esc_html_e('Información institucional', 'alatina-base'); ?></span>
              <span class="home-enrollment-toast__status home-enrollment-toast__status--lilac"><?php esc_html_e('Orientación para familias', 'alatina-base'); ?></span>
            </div>

            <span class="home-enrollment-toast__cta"><?php esc_html_e('Revisar contacto y orientación', 'alatina-base'); ?></span>
          </div>

          <div class="home-enrollment-toast__visual" aria-hidden="true">
            <div class="home-enrollment-toast__visual-frame home-enrollment-toast__visual-frame--illustrated">
              <div class="home-enrollment-illustration">
                <div class="home-enrollment-illustration__sun"></div>
                <div class="home-enrollment-illustration__cloud home-enrollment-illustration__cloud--one"></div>
                <div class="home-enrollment-illustration__cloud home-enrollment-illustration__cloud--two"></div>
                <div class="home-enrollment-illustration__school"></div>
                <div class="home-enrollment-illustration__ground"></div>
                <div class="home-enrollment-illustration__kids">
                  <span class="home-enrollment-illustration__kid home-enrollment-illustration__kid--one"></span>
                  <span class="home-enrollment-illustration__kid home-enrollment-illustration__kid--two"></span>
                  <span class="home-enrollment-illustration__kid home-enrollment-illustration__kid--three"></span>
                </div>
              </div>
            </div>
            <span class="home-enrollment-toast__badge home-enrollment-toast__badge--sky"><?php esc_html_e('Información y contacto', 'alatina-base'); ?></span>
            <span class="home-enrollment-toast__badge home-enrollment-toast__badge--gold"><?php esc_html_e('Contenido temporal', 'alatina-base'); ?></span>
          </div>
        </div>
      </a>
    </div>
  </div>
  <section class="hero-shell hero-shell--school">
    <div class="container py-3 py-lg-4">
      <section class="hero-surface hero-surface--school">
        <div class="hero-school-grid hero-school-grid--news">
          <div class="hero-school-main hero-school-main--identity">
            <div class="hero-school-copy hero-school-copy--identity">
              <h1 class="visually-hidden"><?php esc_html_e('Escuela América Latina', 'alatina-base'); ?></h1>

              <div class="hero-kicker hero-kicker--brand">
                <span class="hero-kicker__school"><?php esc_html_e('Escuela', 'alatina-base'); ?></span>
                <span class="hero-kicker__name"><?php esc_html_e('América Latina', 'alatina-base'); ?></span>
              </div>

              <p class="hero-seal-statement"><?php esc_html_e('Formamos a nuestras y nuestros estudiantes con una mirada integral, promoviendo el respeto a la diversidad, el compromiso con el medio ambiente y una participación activa en la vida escolar.', 'alatina-base'); ?></p>

              <p class="hero-support-copy"><?php esc_html_e('Impulsamos aprendizajes significativos junto al arte, el deporte y experiencias formativas que abren oportunidades reales para cada trayectoria educativa.', 'alatina-base'); ?></p>
            </div>

            <div class="hero-cta-row hero-cta-row--identity hero-cta-row--single">
              <a class="btn btn-light rounded-pill px-4 hero-cta-primary" href="<?php echo esc_url($school_calendar_url); ?>"><?php esc_html_e('Calendario escolar', 'alatina-base'); ?></a>
            </div>
          </div>

          <div class="hero-school-side hero-school-side--news">
            <div id="heroVisualCarousel" class="carousel slide carousel-fade hero-news-carousel" data-bs-ride="carousel" data-bs-interval="5200">
              <div class="carousel-inner hero-news-carousel__inner">
                <?php foreach ($hero_slides as $index => $slide) : ?>
                  <?php $slide_url = ! empty($slide['url']) ? $slide['url'] : ''; ?>
                  <div class="carousel-item <?php echo 0 === $index ? 'active' : ''; ?>">
                    <?php if ($slide_url) : ?>
                      <a class="hero-news-card hero-news-card--link <?php echo esc_attr($slide['class']); ?>" href="<?php echo esc_url($slide_url); ?>">
                    <?php else : ?>
                      <article class="hero-news-card <?php echo esc_attr($slide['class']); ?>">
                    <?php endif; ?>
                      <div class="hero-news-card__media">
                        <img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['image_alt']); ?>" loading="lazy" decoding="async">
                      </div>
                      <div class="hero-news-card__body">
                        <span class="hero-news-card__tag"><?php echo esc_html($slide['tag']); ?></span>
                        <span class="hero-news-card__eyebrow"><?php echo esc_html($slide['eyebrow']); ?></span>
                        <h2><?php echo esc_html($slide['title']); ?></h2>
                        <p><?php echo esc_html($slide['text']); ?></p>
                        <?php if ($slide_url) : ?>
                          <span class="hero-news-card__cta"><?php esc_html_e('Ver más', 'alatina-base'); ?></span>
                        <?php endif; ?>
                      </div>
                    <?php if ($slide_url) : ?>
                      </a>
                    <?php else : ?>
                      </article>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="hero-news-carousel__controls">
                <button class="carousel-control-prev" type="button" data-bs-target="#heroVisualCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden"><?php esc_html_e('Anterior', 'alatina-base'); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroVisualCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden"><?php esc_html_e('Siguiente', 'alatina-base'); ?></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <section class="events-strip events-strip--compact py-3" aria-label="<?php esc_attr_e('Información importante para padres y apoderados', 'alatina-base'); ?>">
    <div class="container">
      <div class="event-card event-card--notice event-card--compact event-card--hero-secondary" id="centro-general-de-padres-home">
        <div class="event-card__badge-wrap event-card__badge-wrap--compact">
          <div class="event-date"><?php echo esc_html($cgp_highlight['label']); ?></div>
        </div>
        <div class="event-content event-content--compact">
          <h2><?php echo esc_html($cgp_highlight['title']); ?></h2>
          <p><?php echo esc_html(wp_trim_words($cgp_highlight['text'], 16)); ?></p>
        </div>
        <div class="event-action">
          <a class="btn btn-light rounded-pill px-4" href="<?php echo esc_url($cgp_highlight['url']); ?>"><?php echo esc_html($cgp_highlight['cta']); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="news-section py-5">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Noticias', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php echo esc_html(alatina_base_get_theme_text('home_news_heading')); ?></h2>
          <p class="section-copy mb-0"><?php echo esc_html(alatina_base_get_theme_text('home_news_text')); ?></p>
        </div>
        <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo alatina_base_get_theme_url('home_news_action_url'); ?>"><?php echo esc_html(alatina_base_get_theme_text('home_news_action_label')); ?></a>
      </div>

      <div class="news-layout-grid">
        <?php if ($recent_posts->have_posts()) : ?>
          <?php $rendered_posts = array(); ?>
          <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <?php $rendered_posts[] = get_post(); ?>
          <?php endwhile; wp_reset_postdata(); ?>

          <?php if (!empty($rendered_posts[0])) : ?>
            <?php $post = $rendered_posts[0]; setup_postdata($post); ?>
            <article class="news-card-v2 news-card-v2--featured news-card-v2--lead">
              <a class="news-thumb" href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                  <div class="news-thumb-placeholder news-thumb-placeholder--lead"><span><?php esc_html_e('Noticia principal', 'alatina-base'); ?></span></div>
                <?php endif; ?>
              </a>
              <div class="news-body news-body--lead">
                <div class="news-date"><?php echo esc_html(get_the_date()); ?></div>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 32)); ?></p>
                <a class="news-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Leer noticia principal', 'alatina-base'); ?></a>
              </div>
            </article>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>

          <div class="news-stack">
            <?php for ($i = 1; $i < 3; $i++) : ?>
              <?php if (!empty($rendered_posts[$i])) : ?>
                <?php $post = $rendered_posts[$i]; setup_postdata($post); ?>
                <article class="news-card-v2 news-card-v2--stacked news-card-v2--secondary">
                  <a class="news-thumb" href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('medium_large'); ?>
                    <?php else : ?>
                      <div class="news-thumb-placeholder"><span><?php esc_html_e('Actualidad escolar', 'alatina-base'); ?></span></div>
                    <?php endif; ?>
                  </a>
                  <div class="news-body">
                    <div class="news-date"><?php echo esc_html(get_the_date()); ?></div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
                    <a class="news-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Ver más', 'alatina-base'); ?></a>
                  </div>
                </article>
                <?php wp_reset_postdata(); ?>
              <?php else : ?>
                <article class="news-card-v2 news-card-v2--stacked news-card-v2--secondary news-card-v2--placeholder">
                  <div class="news-thumb-placeholder"><span><?php esc_html_e('[CONTENIDO TEMPORAL]', 'alatina-base'); ?></span></div>
                  <div class="news-body">
                    <div class="news-date"><?php esc_html_e('Información en validación', 'alatina-base'); ?></div>
                    <h3><?php esc_html_e('[CONTENIDO TEMPORAL] Comunicado institucional pendiente de reemplazo', 'alatina-base'); ?></h3>
                    <p><?php esc_html_e('Este bloque mantiene activa la portada mientras la escuela entrega nuevas noticias, comunicados y actividades oficiales para publicación.', 'alatina-base'); ?></p>
                    <a class="news-more" href="<?php echo esc_url(alatina_base_get_page_url('noticias')); ?>"><?php esc_html_e('Ir a noticias', 'alatina-base'); ?></a>
                  </div>
                </article>
              <?php endif; ?>
            <?php endfor; ?>
          </div>
        <?php else : ?>
          <article class="news-card-v2 news-card-v2--featured news-card-v2--lead news-card-v2--placeholder-main">
            <div class="news-thumb-placeholder news-thumb-placeholder--lead"><span><?php esc_html_e('[CONTENIDO TEMPORAL]', 'alatina-base'); ?></span></div>
            <div class="news-body news-body--lead">
              <div class="news-date"><?php esc_html_e('Información en validación', 'alatina-base'); ?></div>
              <h3><?php esc_html_e('[CONTENIDO TEMPORAL] Comunicado institucional de portada', 'alatina-base'); ?></h3>
              <p><?php esc_html_e('Este espacio se mantendrá activo mientras se reemplaza por noticias oficiales, actividades escolares y comunicados entregados por la escuela.', 'alatina-base'); ?></p>
              <span class="news-more"><?php esc_html_e('Se actualizará con contenido oficial', 'alatina-base'); ?></span>
            </div>
          </article>
          <div class="news-stack">
            <?php for ($i = 1; $i <= 2; $i++) : ?>
              <article class="news-card-v2 news-card-v2--stacked news-card-v2--secondary news-card-v2--placeholder">
                <div class="news-thumb-placeholder"><span><?php esc_html_e('[CONTENIDO TEMPORAL]', 'alatina-base'); ?></span></div>
                <div class="news-body">
                  <div class="news-date"><?php esc_html_e('Información en actualización', 'alatina-base'); ?></div>
                  <h3><?php esc_html_e('[CONTENIDO TEMPORAL] Actividad escolar de ejemplo', 'alatina-base'); ?></h3>
                  <p><?php esc_html_e('Este contenido temporal será reemplazado por información oficial entregada por la escuela para fortalecer la sección de noticias.', 'alatina-base'); ?></p>
                  <span class="news-more"><?php esc_html_e('Pendiente de reemplazo oficial', 'alatina-base'); ?></span>
                </div>
              </article>
            <?php endfor; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="milestones-section py-5">
    <div class="container">
      <div class="milestones-layout">
        <div class="milestones-intro-card">
          <span class="section-tag"><?php esc_html_e('Hitos importantes', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php echo esc_html(alatina_base_get_theme_text('home_milestones_heading')); ?></h2>
          <p class="section-copy"><?php echo esc_html(alatina_base_get_theme_text('home_milestones_text')); ?></p>
          <div class="milestones-intro-card__highlight">
            <span><?php esc_html_e('Recorrido institucional', 'alatina-base'); ?></span>
            <strong><?php echo esc_html(count($milestones)); ?> <?php esc_html_e('hitos visibles en la portada', 'alatina-base'); ?></strong>
          </div>
        </div>
        <div class="timeline-grid timeline-grid--editorial">
          <?php foreach ($milestones as $milestone) : ?>
            <article class="timeline-card">
              <div class="timeline-card__year"><?php echo esc_html($milestone['year']); ?></div>
              <div class="timeline-card__content">
                <h3><?php echo esc_html($milestone['title']); ?></h3>
                <p><?php echo esc_html($milestone['text']); ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section id="asignaturas" class="links-section links-section--subjects py-5">
    <div class="container">
      <div class="section-heading-row mb-4">
        <span class="section-tag"><?php esc_html_e('Asignaturas', 'alatina-base'); ?></span>
        <h2 class="section-title"><?php esc_html_e('Áreas de aprendizaje con base visual revisable', 'alatina-base'); ?></h2>
        <p class="section-copy mb-0"><?php esc_html_e('[CONTENIDO TEMPORAL] Esta sección resume las asignaturas y áreas formativas mientras la escuela valida el contenido oficial para publicación.', 'alatina-base'); ?></p>
      </div>
      <div class="row g-4 subject-preview-grid">
        <?php $subject_preview_cards = array(
          array('slug' => 'lenguaje-y-comunicacion', 'title' => __('Lenguaje y Comunicación', 'alatina-base')),
          array('slug' => 'matematica', 'title' => __('Matemática', 'alatina-base')),
          array('slug' => 'ciencias-naturales', 'title' => __('Ciencias Naturales', 'alatina-base')),
          array('slug' => 'historia-geografia-y-ciencias-sociales', 'title' => __('Historia, Geografía y Ciencias Sociales', 'alatina-base')),
          array('slug' => 'ingles', 'title' => __('Inglés', 'alatina-base')),
          array('slug' => 'educacion-fisica-y-salud', 'title' => __('Educación Física y Salud', 'alatina-base')),
        ); ?>
        <?php foreach ($subject_preview_cards as $subject_card) : ?>
          <div class="col-md-6 col-xl-4">
            <article id="<?php echo esc_attr($subject_card['slug']); ?>" class="quicklink-card quicklink-card--home quicklink-card--subject h-100">
              <span class="quicklink-eyebrow"><?php esc_html_e('[CONTENIDO TEMPORAL]', 'alatina-base'); ?></span>
              <h3><?php echo esc_html($subject_card['title']); ?></h3>
              <p><?php esc_html_e('Información referencial en validación. Será reemplazada por el detalle oficial entregado por la escuela.', 'alatina-base'); ?></p>
              <span class="quicklink-cta"><?php esc_html_e('Contenido temporal revisable', 'alatina-base'); ?></span>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="mt-4">
        <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url($subjects_url); ?>"><?php esc_html_e('Ir a la página de Asignaturas', 'alatina-base'); ?></a>
      </div>
    </div>
  </section>

  <section id="enlaces-importantes" class="links-section py-5">
    <div class="container">
      <div class="section-heading-row mb-4">
        <span class="section-tag"><?php esc_html_e('Enlaces importantes', 'alatina-base'); ?></span>
        <h2 class="section-title"><?php echo esc_html(alatina_base_get_theme_text('home_links_heading')); ?></h2>
        <p class="section-copy mb-0"><?php echo esc_html(alatina_base_get_theme_text('home_links_text')); ?></p>
      </div>
      <div class="row g-4 quicklinks-row">
        <?php foreach ($quick_access_items as $index => $item) : ?>
          <div class="col-sm-6 <?php echo $index < 2 ? 'col-xl-6' : 'col-xl-3'; ?>">
            <a class="quicklink-card quicklink-card--home <?php echo $index < 2 ? 'quicklink-card--priority' : ''; ?> h-100" href="<?php echo esc_url($item['url']); ?>">
              <span class="quicklink-icon"><?php echo alatina_base_get_bootstrap_icon($item['icon']); ?></span>
              <span class="quicklink-eyebrow"><?php echo esc_html($item['eyebrow']); ?></span>
              <h3><?php echo esc_html($item['title']); ?></h3>
              <p><?php echo esc_html($item['text']); ?></p>
              <span class="quicklink-cta"><?php echo esc_html($item['cta']); ?></span>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="home-prefooter">
    <div class="container">
      <div class="home-prefooter__card">
        <div>
          <span class="section-tag"><?php esc_html_e('Cierre de portada', 'alatina-base'); ?></span>
          <h2><?php esc_html_e('Una transición más sólida hacia el pie del sitio', 'alatina-base'); ?></h2>
          <p><?php esc_html_e('El cierre de la home conecta enlaces, actualidad y navegación institucional antes de llegar al footer, evitando un corte visual débil.', 'alatina-base'); ?></p>
        </div>
        <div class="d-flex flex-wrap gap-2 justify-content-lg-end">
          <a class="btn btn-light rounded-pill px-4" href="<?php echo esc_url($subjects_url); ?>"><?php esc_html_e('Asignaturas', 'alatina-base'); ?></a>
          <a class="btn btn-light rounded-pill px-4" href="<?php echo esc_url(alatina_base_get_page_url('contacto')); ?>"><?php esc_html_e('Contacto y orientación', 'alatina-base'); ?></a>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var toast = document.querySelector('[data-home-enrollment-toast]');
    if (!toast) {
      return;
    }

    var closeElements = toast.querySelectorAll('[data-home-enrollment-close]');
    var autoHideTimer = window.setTimeout(closeToast, 10000);

    function closeToast() {
      if (toast.classList.contains('is-closing') || toast.classList.contains('is-hidden')) {
        return;
      }

      toast.classList.add('is-closing');

      window.setTimeout(function () {
        toast.classList.add('is-hidden');
      }, 260);
    }

    closeElements.forEach(function (element) {
      element.addEventListener('click', function (event) {
        event.preventDefault();
        window.clearTimeout(autoHideTimer);
        closeToast();
      });
    });
  });
</script>
<?php get_footer();
