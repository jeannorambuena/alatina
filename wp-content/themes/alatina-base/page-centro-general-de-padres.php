<?php
/*
Template Name: Centro General de Padres
*/
get_header();

if (have_posts()) {
    the_post();
}

$page_title   = get_the_title() ? get_the_title() : __('Centro General de Padres', 'alatina-base');
$page_content = trim((string) get_post_field('post_content', get_the_ID()));

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
        'posts_per_page'      => 6,
        'ignore_sticky_posts' => true,
        'cat'                 => (int) $cgp_category->term_id,
    ));
}
?>

<main class="site-main cgp-page">
  <section class="cgp-page__hero py-5">
    <div class="container">
      <div class="cgp-page__hero-card">
        <span class="section-tag">PRUEBA CGP ACTIVA</span>
        <h1 class="section-title">CGP - Verificación de plantilla</h1>
        <p class="section-copy mb-0">Si este texto aparece en pantalla, el template correcto de /cgp/ sí está siendo modificado.</p>

        <div class="cgp-page__actions mt-4 d-flex flex-wrap gap-2">
          <a class="btn btn-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-integrantes/')); ?>"><?php esc_html_e('Ver integrantes', 'alatina-base'); ?></a>
          <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-transparencia/')); ?>"><?php esc_html_e('Ver transparencia', 'alatina-base'); ?></a>
          <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-noticias/')); ?>"><?php esc_html_e('Ver noticias', 'alatina-base'); ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="cgp-page__overview py-5">
    <div class="container">
      <div class="row g-4 align-items-start">
        <div class="col-lg-8">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h2 class="section-title"><?php esc_html_e('Rol del CGP', 'alatina-base'); ?></h2>
              <p><?php esc_html_e('El CGP cumple un rol relevante en la representación de las familias, en la coordinación de actividades y en el apoyo a procesos que fortalecen la vida escolar. Su trabajo busca favorecer la participación, la comunicación y el compromiso con los objetivos formativos del establecimiento.', 'alatina-base'); ?></p>
              <p><?php esc_html_e('Esta sección busca reunir la información principal del Centro General de Padres y facilitar el acceso a noticias, iniciativas, responsables y antecedentes relevantes para la comunidad escolar.', 'alatina-base'); ?></p>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <aside class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <p class="section-tag mb-3"><?php esc_html_e('Áreas del CGP', 'alatina-base'); ?></p>
              <ul class="content-list mb-4">
                <li><?php esc_html_e('Organización y representación de apoderados.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Información y comunicados del CGP.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Transparencia contable y gestión de recursos.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Proyectos, iniciativas y convivencia escolar.', 'alatina-base'); ?></li>
              </ul>
              <a class="btn btn-light border rounded-pill px-4" href="#cgp-publicaciones"><?php esc_html_e('Ir a noticias', 'alatina-base'); ?></a>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>

  <section id="cgp-directorio" class="cgp-page__directory py-5">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Directorio CGP', 'alatina-base'); ?></span>
          <h2 class="section-title">Integrantes del CGP</h2>
          <p class="section-copy mb-0"><?php esc_html_e('Funciones habituales del cargo dentro del trabajo del Centro General de Padres, listadas para facilitar el contacto y la organización.', 'alatina-base'); ?></p>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-6 col-xl-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Presidente/a">
            <div class="card-body">
              <h3 class="h5"><?php esc_html_e('Presidente/a', 'alatina-base'); ?></h3>
              <p class="mb-2 text-muted"><?php esc_html_e('Representa al CGP ante la comunidad educativa y coordina acuerdos con el establecimiento.', 'alatina-base'); ?></p>
              <ul class="content-list">
                <li><?php esc_html_e('Representar al CGP ante familias y directiva.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Coordinar reuniones y acuerdos de trabajo.', 'alatina-base'); ?></li>
              </ul>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Secretario/a">
            <div class="card-body">
              <h3 class="h5"><?php esc_html_e('Secretario/a', 'alatina-base'); ?></h3>
              <p class="mb-2 text-muted"><?php esc_html_e('Registra actas y comunicaciones, y apoya la gestión de la documentación del CGP.', 'alatina-base'); ?></p>
              <ul class="content-list">
                <li><?php esc_html_e('Llevar control de actas y acuerdos.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Gestionar comunicaciones internas y externas.', 'alatina-base'); ?></li>
              </ul>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Tesorero/a">
            <div class="card-body">
              <h3 class="h5"><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></h3>
              <p class="mb-2 text-muted"><?php esc_html_e('Registra ingresos y gastos, y apoya la transparencia contable del CGP.', 'alatina-base'); ?></p>
              <ul class="content-list">
                <li><?php esc_html_e('Registrar ingresos, gastos y aportes.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Colaborar en la presentación de comprobantes.', 'alatina-base'); ?></li>
              </ul>
            </div>
          </article>
        </div>

        <div class="col-md-6 col-xl-4">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <img class="card-img-top" src="https://via.placeholder.com/360x240?text=Foto" alt="Foto Encargado/a de Comunicaciones">
            <div class="card-body">
              <h3 class="h5"><?php esc_html_e('Encargado/a de Comunicaciones', 'alatina-base'); ?></h3>
              <p class="mb-2 text-muted"><?php esc_html_e('Coordina los canales de información y el flujo de mensajes hacia las familias.', 'alatina-base'); ?></p>
              <ul class="content-list">
                <li><?php esc_html_e('Coordinar comunicaciones y avisos.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Apoyar la difusión de actividades del CGP.', 'alatina-base'); ?></li>
              </ul>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section id="transparencia" class="cgp-page__transparency py-5 bg-light">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Transparencia', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php esc_html_e('Transparencia contable', 'alatina-base'); ?></h2>
          <p class="section-copy mb-0"><?php esc_html_e('Control contable preparado para registrar ingresos, gastos y comprobantes del CGP.', 'alatina-base'); ?></p>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-light">
            <tr>
              <th><?php esc_html_e('Fecha', 'alatina-base'); ?></th>
              <th><?php esc_html_e('Tipo', 'alatina-base'); ?></th>
              <th><?php esc_html_e('Descripción', 'alatina-base'); ?></th>
              <th><?php esc_html_e('Responsable', 'alatina-base'); ?></th>
              <th><?php esc_html_e('Monto', 'alatina-base'); ?></th>
              <th><?php esc_html_e('Comprobante', 'alatina-base'); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2026-03-02</td>
              <td><?php esc_html_e('Ingreso', 'alatina-base'); ?></td>
              <td><?php esc_html_e('Cuota de apoderados para actividades escolares.', 'alatina-base'); ?></td>
              <td><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></td>
              <td>$45.000</td>
              <td><a class="text-primary" href="<?php echo esc_url(home_url('/documentos/cgp-comprobante-1.pdf')); ?>"><?php esc_html_e('Ver boleta', 'alatina-base'); ?></a></td>
            </tr>
            <tr>
              <td>2026-03-15</td>
              <td><?php esc_html_e('Gasto', 'alatina-base'); ?></td>
              <td><?php esc_html_e('Compra de materiales para actividad de curso.', 'alatina-base'); ?></td>
              <td><?php esc_html_e('Tesorero/a', 'alatina-base'); ?></td>
              <td>$28.000</td>
              <td><a class="text-primary" href="<?php echo esc_url(home_url('/documentos/cgp-comprobante-2.pdf')); ?>"><?php esc_html_e('Ver comprobante', 'alatina-base'); ?></a></td>
            </tr>
            <tr>
              <td>2026-04-05</td>
              <td><?php esc_html_e('Gasto', 'alatina-base'); ?></td>
              <td><?php esc_html_e('Apoyo a actividad escolar y materiales para convivencia.', 'alatina-base'); ?></td>
              <td><?php esc_html_e('Encargado/a de Proyectos', 'alatina-base'); ?></td>
              <td>$18.500</td>
              <td><a class="text-primary" href="<?php echo esc_url(home_url('/documentos/cgp-comprobante-3.pdf')); ?>"><?php esc_html_e('Ver comprobante', 'alatina-base'); ?></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section class="cgp-page__projects py-5">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Proyectos e iniciativas', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php esc_html_e('Participación y comunidad', 'alatina-base'); ?></h2>
          <p class="section-copy mb-0"><?php esc_html_e('El CGP apoya actividades que involucran a familias, estudiantes y docentes para fortalecer el trabajo formativo y la convivencia escolar.', 'alatina-base'); ?></p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-lg-6">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h3 class="h5"><?php esc_html_e('Iniciativas participativas', 'alatina-base'); ?></h3>
              <p><?php esc_html_e('El CGP impulsa reuniones, apoyo a actividades de curso y proyectos conjuntos entre familias y la escuela.', 'alatina-base'); ?></p>
            </div>
          </article>
        </div>
        <div class="col-lg-6">
          <article class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h3 class="h5"><?php esc_html_e('Vínculo con la comunidad', 'alatina-base'); ?></h3>
              <p><?php esc_html_e('Se busca fortalecer la comunicación y la colaboración entre el establecimiento y las familias, con foco en el bienestar escolar.', 'alatina-base'); ?></p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <?php if (! empty($page_content)) : ?>
    <section class="cgp-page__intro-section pb-2">
      <div class="container">
        <article class="cgp-page__intro-card">
          <?php echo wp_kses_post(wpautop($page_content)); ?>
        </article>
      </div>
    </section>
  <?php endif; ?>

  <section id="cgp-publicaciones" class="cgp-page__stream py-5">
    <div class="container">
      <div class="section-heading-row section-heading-row--news d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
        <div class="section-heading-copy">
          <span class="section-tag"><?php esc_html_e('Comunicados y novedades', 'alatina-base'); ?></span>
          <h2 class="section-title"><?php esc_html_e('Noticias del CGP', 'alatina-base'); ?></h2>
          <p class="section-copy mb-0"><?php esc_html_e('Publicaciones ordenadas para mantener a las familias actualizadas sobre actividades, avances y avisos del CGP.', 'alatina-base'); ?></p>
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
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <div class="cgp-empty-state">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body py-5">
              <h3><?php esc_html_e('Noticias del CGP próximas a publicarse', 'alatina-base'); ?></h3>
              <p class="text-muted mb-4"><?php esc_html_e('Este espacio mostrará avisos, comunicados y novedades del Centro General de Padres. Mientras no haya publicaciones reales, revisa los tipos de contenido que estarán disponibles.', 'alatina-base'); ?></p>
              <div class="row g-4 mb-4">
                <div class="col-md-4">
                  <article class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                      <h4 class="h6"><?php esc_html_e('Convocatoria de reunión', 'alatina-base'); ?></h4>
                      <p class="text-muted mb-0"><?php esc_html_e('Aviso sobre la próxima reunión del CGP con fecha, hora y lugar.', 'alatina-base'); ?></p>
                    </div>
                  </article>
                </div>
                <div class="col-md-4">
                  <article class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                      <h4 class="h6"><?php esc_html_e('Informe de recursos', 'alatina-base'); ?></h4>
                      <p class="text-muted mb-0"><?php esc_html_e('Resumen de aportes, gastos y proyectos respaldados por el CGP.', 'alatina-base'); ?></p>
                    </div>
                  </article>
                </div>
                <div class="col-md-4">
                  <article class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                      <h4 class="h6"><?php esc_html_e('Resultado de votación', 'alatina-base'); ?></h4>
                      <p class="text-muted mb-0"><?php esc_html_e('Comunicación de acuerdos adoptados por la directiva del CGP.', 'alatina-base'); ?></p>
                    </div>
                  </article>
                </div>
              </div>
              <a class="btn btn-outline-primary rounded-pill px-4" href="<?php echo esc_url(home_url('/cgp-noticias/')); ?>"><?php esc_html_e('Ir a noticias CGP', 'alatina-base'); ?></a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer();
