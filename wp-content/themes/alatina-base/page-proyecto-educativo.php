<?php
/**
 * Template Name: Proyecto Educativo
 */

get_header();
?>
<main class="site-main site-main--internal">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <section class="page-hero page-hero--proyecto-educativo page-hero--info-school">
        <div class="container page-hero__content">
          <div class="page-hero__surface page-hero__surface--enhanced">
            <div class="page-hero__grid">
              <div class="page-hero__main">
                <p class="eyebrow"><?php esc_html_e('Proyecto Educativo', 'alatina-base'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="lead">El Proyecto Educativo Institucional de la Escuela América Latina orienta el trabajo pedagógico y formativo del establecimiento, poniendo en el centro el desarrollo integral de los estudiantes. A través de este instrumento, la comunidad educativa define sus principios, sellos, objetivos y lineamientos de acción, fortaleciendo una educación inclusiva, participativa y comprometida con la mejora continua.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>
  <?php endif; ?>

  <section class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="content-card">
            <h2><?php esc_html_e('Fundamentos Institucionales', 'alatina-base'); ?></h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
              <div>
                <h4><?php esc_html_e('Misión', 'alatina-base'); ?></h4>
                <p><?php esc_html_e('Potenciar la formación integral de todos los estudiantes, impulsando el respeto a la diversidad y formando ciudadanos responsables, respetuosos, honestos, solidarios, autónomos y tolerantes. La escuela busca fortalecer conocimientos, habilidades y actitudes, integrando tecnología, expresión artística y deportiva para mejorar los aprendizajes y contribuir a una sana convivencia escolar.', 'alatina-base'); ?></p>
              </div>
              <div>
                <h4><?php esc_html_e('Visión', 'alatina-base'); ?></h4>
                <p><?php esc_html_e('Ser reconocidos en la comuna de Romeral por la integralidad de la propuesta educativa y por la atención permanente a los desafíos de una sociedad en constante evolución, promoviendo una formación de calidad centrada en el desarrollo académico, personal y valórico de los estudiantes.', 'alatina-base'); ?></p>
              </div>
            </div>
            <div style="margin-bottom: 2rem;">
              <h4><?php esc_html_e('Valores Institucionales', 'alatina-base'); ?></h4>
              <p><?php esc_html_e('Responsabilidad, respeto, honestidad, solidaridad, autonomía y tolerancia.', 'alatina-base'); ?></p>
            </div>
            <div style="margin-bottom: 2rem;">
              <h4><?php esc_html_e('Sellos Formativos', 'alatina-base'); ?></h4>
              <ul style="margin-left: 1.25rem; margin-top: 0.5rem;">
                <li><?php esc_html_e('Formación integral de los estudiantes, abordando desarrollo académico, personal y social.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Expresión artística y deportiva como sello educativo distintivo.', 'alatina-base'); ?></li>
                <li><?php esc_html_e('Trabajo colaborativo con las familias y compromiso con una convivencia escolar sana y respetuosa.', 'alatina-base'); ?></li>
              </ul>
            </div>
            <hr>
            <h2><?php esc_html_e('Contenido del PEI', 'alatina-base'); ?></h2>
            <div class="entry-content entry-content--page">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="page-sidecard">
            <div class="page-sidecard__panel">
              <h3><?php esc_html_e('Descarga', 'alatina-base'); ?></h3>
              <p><a href="https://wwwfs.mineduc.cl/Archivos/infoescuelas/documentos/2825/ProyectoEducativo2825.pdf" target="_blank">Descargar PEI completo (PDF)</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
