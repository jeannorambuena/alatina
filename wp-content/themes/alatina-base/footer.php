<footer class="site-footer">
  <div class="wrap site-footer__inner">
    <div class="site-footer__brand">
      <p class="site-footer__title"><?php bloginfo('name'); ?></p>
      <p class="site-footer__text">
        <?php esc_html_e('Espacio institucional para información, orientación y acceso a contenidos relevantes de la comunidad educativa.', 'alatina-base'); ?>
      </p>
    </div>

    <div class="site-footer__nav">
      <p class="site-footer__heading"><?php esc_html_e('Navegación', 'alatina-base'); ?></p>
      <?php
      wp_nav_menu(array(
          'theme_location' => 'footer',
          'menu_class'     => 'menu menu--footer',
          'container'      => false,
          'fallback_cb'    => 'alatina_base_footer_menu_fallback',
      ));
      ?>
    </div>

    <div class="site-footer__contact">
      <p class="site-footer__heading"><?php esc_html_e('Acceso rápido', 'alatina-base'); ?></p>
      <ul class="footer-links">
        <li><a href="<?php echo esc_url(alatina_base_get_page_url('contacto')); ?>"><?php esc_html_e('Contacto institucional', 'alatina-base'); ?></a></li>
        <li><a href="<?php echo esc_url(alatina_base_get_page_url('documentos')); ?>"><?php esc_html_e('Documentos y recursos', 'alatina-base'); ?></a></li>
        <li><a href="<?php echo esc_url(alatina_base_get_page_url('noticias')); ?>"><?php esc_html_e('Noticias y avisos', 'alatina-base'); ?></a></li>
      </ul>
    </div>
  </div>

  <div class="wrap site-footer__bottom">
    <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?></p>
    <p><?php esc_html_e('Tema base institucional sobre WordPress.', 'alatina-base'); ?></p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
