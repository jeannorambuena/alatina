<?php
/*
Template Name: Reglamento Interno
*/
get_header();
?>
<main class="site-main site-main--internal">
  <section class="page-hero page-hero--reglamento-interno">
    <div class="container page-hero__content">
      <div class="page-hero__surface page-hero__surface--enhanced">
        <div class="page-hero__grid">
          <div class="page-hero__main">
            <p class="eyebrow"><?php esc_html_e('Reglamento interno', 'alatina-base'); ?></p>
            <h1><?php esc_html_e('Reglamento Interno', 'alatina-base'); ?></h1>
            <p class="lead"><?php esc_html_e('El Reglamento Interno de la Escuela América Latina establece normas, criterios y orientaciones para la convivencia escolar y el funcionamiento del establecimiento, promoviendo un ambiente seguro, respetuoso y formativo para toda la comunidad educativa.', 'alatina-base'); ?></p>
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
              <h2 class="section-title"><?php esc_html_e('Acerca del Reglamento Interno', 'alatina-base'); ?></h2>
              <p class="section-copy mb-4"><?php esc_html_e('En este documento se reúnen disposiciones relacionadas con convivencia escolar, derechos y deberes, organización interna y medidas orientadas al bienestar y desarrollo de los estudiantes dentro del contexto educativo.', 'alatina-base'); ?></p>

              <h3 class="h4 mb-3"><?php esc_html_e('Propósito y alcance', 'alatina-base'); ?></h3>
              <p class="section-copy mb-4"><?php esc_html_e('El Reglamento Interno establece un marco ordenado para la sana convivencia en el establecimiento, definiendo responsabilidades, procedimientos y orientaciones que favorecen el respeto mutuo, la disciplina formativa y la participación responsable de todos los miembros de la comunidad educativa.', 'alatina-base'); ?></p>

              <h3 class="h4 mb-3"><?php esc_html_e('Contenidos principales', 'alatina-base'); ?></h3>
              <ul class="list-unstyled">
                <li class="mb-2"><strong><?php esc_html_e('Derechos y deberes:', 'alatina-base'); ?></strong> <?php esc_html_e('Descripción de derechos y responsabilidades de estudiantes, apoderados, docentes y personal del establecimiento.', 'alatina-base'); ?></li>
                <li class="mb-2"><strong><?php esc_html_e('Convivencia escolar:', 'alatina-base'); ?></strong> <?php esc_html_e('Normas, procedimientos y protocolos para el resguardo de una convivencia respetuosa y segura.', 'alatina-base'); ?></li>
                <li class="mb-2"><strong><?php esc_html_e('Organización interna:', 'alatina-base'); ?></strong> <?php esc_html_e('Estructura, funcionamiento y coordinación de las diferentes áreas del establecimiento.', 'alatina-base'); ?></li>
                <li class="mb-0"><strong><?php esc_html_e('Medidas formativas:', 'alatina-base'); ?></strong> <?php esc_html_e('Estrategias y procedimientos orientados a la formación de hábitos y valores en los estudiantes.', 'alatina-base'); ?></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
              <h3 class="h5 mb-3"><?php esc_html_e('Documento oficial', 'alatina-base'); ?></h3>
              <p class="small text-muted mb-4"><?php esc_html_e('Descarga el documento completo del Reglamento Interno Vigente de la Escuela América Latina.', 'alatina-base'); ?></p>
              <a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/2825/ReglamentodeConvivencia2825.pdf" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-pill w-100">
                <?php esc_html_e('Descargar Reglamento (PDF)', 'alatina-base'); ?>
              </a>
              
              <hr class="my-4">
              
              <h3 class="h5 mb-3"><?php esc_html_e('Enlaces relacionados', 'alatina-base'); ?></h3>
              <div class="d-grid gap-2">
                <a href="<?php echo esc_url(home_url('/mision-vision/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Misión y visión', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/proyecto-educativo/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Proyecto educativo', 'alatina-base'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-outline-primary rounded-pill">
                  <?php esc_html_e('Contacto', 'alatina-base'); ?>
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
