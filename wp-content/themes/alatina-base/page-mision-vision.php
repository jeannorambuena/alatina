<?php
/*
Template Name: Misión y visión
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--mision-vision">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Misión y visión institucional', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Misión y visión', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('La Escuela América Latina se compromete con la formación integral de niños y niñas, promoviendo una educación de calidad que desarrolle competencias académicas, habilidades sociales y valores éticos para la transformación de la comunidad.', 'alatina-base'); ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="page-section py-5">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body">
              <h2 class="section-title"><?php esc_html_e('Misión', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Proporcionar una educación de calidad que forme integralmente a niños y niñas, desarrollando competencias académicas, habilidades socio-emocionales y una sólida formación valórica que les permita ser ciudadanos responsables, críticos y comprometidos con el desarrollo de su comunidad.', 'alatina-base'); ?></p>

              <h2 class="section-title mt-5"><?php esc_html_e('Visión', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('Ser un establecimiento educativo reconocido por la calidad de su propuesta formativa, la inclusión, la innovación pedagógica y el compromiso con la equidad, contribuyendo a la transformación social a través de la educación integral de sus estudiantes.', 'alatina-base'); ?></p>

              <h2 class="section-title mt-5"><?php esc_html_e('Valores institucionales', 'alatina-base'); ?></h2>
              <ul class="list-unstyled">
                <li class="mb-3">
                  <strong><?php esc_html_e('Inclusión:', 'alatina-base'); ?></strong>
                  <span><?php esc_html_e(' Respeto y valoración de la diversidad, asegurando oportunidades equitativas para todos.', 'alatina-base'); ?></span>
                </li>
                <li class="mb-3">
                  <strong><?php esc_html_e('Excelencia:', 'alatina-base'); ?></strong>
                  <span><?php esc_html_e(' Compromiso con la calidad en la enseñanza y el aprendizaje, fomentando la superación constante.', 'alatina-base'); ?></span>
                </li>
                <li class="mb-3">
                  <strong><?php esc_html_e('Participación:', 'alatina-base'); ?></strong>
                  <span><?php esc_html_e(' Promoción de la participación activa de estudiantes, familias y comunidad en la vida escolar.', 'alatina-base'); ?></span>
                </li>
                <li class="mb-0">
                  <strong><?php esc_html_e('Responsabilidad social:', 'alatina-base'); ?></strong>
                  <span><?php esc_html_e(' Compromiso con el bienestar del entorno natural y social.', 'alatina-base'); ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
              <h3 class="h5 mb-3"><?php esc_html_e('Enlaces relacionados', 'alatina-base'); ?></h3>
              <div class="d-grid gap-2">
                <a href="<?php echo esc_url(home_url('/proyecto-educativo/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Proyecto educativo', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/historia/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Historia', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/comunidad-educativa/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Comunidad educativa', 'alatina-base'); ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
