<?php

// Action qui permet de charger des scripts dans notre thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles(){
    // Chargement du style.css du thème parent Astra
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), 
    filemtime(get_stylesheet_directory() . '/css/theme.css'));
}


// HOOKS FILTER POUR HEADER

/**
 * Supprime l'élément "Admin" du menu si l'utilisateur n'est pas connecté.
 * L'élément est identifié par son ID HTML généré dans WordPress (ex: menu-item-110).
 */
add_filter('wp_nav_menu_items', function($items) {
    if (!is_user_logged_in()) {
        $items = preg_replace('/<li[^>]*menu-item-2608[^>]*>.*?<\/li>/is', '', $items);
    }
    return $items;
});


// Pour implémenter modèles elementor
function forcer_shortcode_elementor($atts = []) {
    if (empty($atts['id'])) return '';
    return \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($atts['id']);
}
add_shortcode('elementor-template', 'forcer_shortcode_elementor');


?>
