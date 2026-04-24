<footer class="site-footer pt-5">
  <div class="container site-footer__inner">
    <div class="site-footer__top row g-4 align-items-start">
      <div class="col-lg-4">
        <span class="site-footer__eyebrow"><?php esc_html_e('Comunidad educativa', 'alatina-base'); ?></span>
        <p class="site-footer__title"><?php bloginfo('name'); ?></p>
        <p class="site-footer__text"><?php echo esc_html(alatina_base_get_theme_text('footer_description')); ?></p>
        <a class="btn btn-outline-light rounded-pill px-4" href="<?php echo alatina_base_get_theme_url('footer_cta_url'); ?>"><?php echo esc_html(alatina_base_get_theme_text('footer_cta_label')); ?></a>
      </div>
      <div class="col-sm-6 col-lg-2">
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
      <div class="col-sm-6 col-lg-3">
        <p class="site-footer__heading"><?php echo esc_html(alatina_base_get_theme_text('footer_contact_heading')); ?></p>
        <ul class="footer-links">
          <?php foreach (alatina_base_get_contact_placeholders() as $item) : ?>
            <li><?php echo esc_html($item); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-sm-6 col-lg-3">
        <p class="site-footer__heading"><?php echo esc_html(alatina_base_get_theme_text('footer_links_heading')); ?></p>
        <ul class="footer-links">
          <?php foreach (alatina_base_get_footer_utility_links() as $link) : ?>
            <li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['label']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="site-footer__bottom d-flex flex-column flex-lg-row justify-content-between gap-2 mt-5">
      <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?></p>
      <p><?php echo esc_html(alatina_base_get_theme_text('footer_bottom_text')); ?></p>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
