<?php
/**
 * Enqueue scripts and styles.
 */

function theme_scripts()
{

    //    <!-- Icons -->
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css', array());
//    wp_enqueue_style('font', get_template_directory_uri() . '/public/fonts/yekanBakh/fontface.css', array());
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/public/css/style.css', array(), true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/public/js/app.js', array(), true);

    wp_localize_script('main-js', 'jsData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('my-nonce')
    ));
}

add_action('wp_enqueue_scripts', 'theme_scripts');


add_theme_support('title-tag');
add_theme_support('post-thumbnails');



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function theme_setup()
{

    add_theme_support(
        'custom-logo',
        array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
    register_nav_menu('headerMenuLocation', 'منوی اصلی');
    register_nav_menu('footerLocationOne', 'منوی اول فوتر');
    register_nav_menu('footerLocationTwo', 'منوی دوم فوتر');
    register_nav_menu('footerLocationThree', 'منوی سوم فوتر');

    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'theme_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baloochy_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'baloochy'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'baloochy'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'baloochy_widgets_init');


/**
 * @snippet       Add Inline Field Error Notifications @ WooCommerce Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=86570
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */


/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';


add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{

    // Check function exists.
    if (function_exists('acf_add_options_page')) {

        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title' => __('Theme General Settings'),
            'menu_title' => __('Theme Settings'),
            'redirect' => false,
        ));

        // Add subpage
        $child = acf_add_options_page(array(
            'page_title' => __('Contact and Social'),
            'menu_title' => __('Contact and Social'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}


function add_menu_link_class($classes, $item, $args)
{
    if (isset($args->link_class)) {
        $classes['class'] = $args->link_class;
    }

    return $classes;


}

add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

//populate gravity form
/**
 * Populate ACF select field options with Gravity Forms
 */
function acf_populate_gf_forms_ids($field)
{
    if (class_exists('GFFormsModel')) {
        $choices = [];

        foreach (\GFFormsModel::get_forms() as $form) {
            $choices[$form->id] = $form->title;
        }

        $field['choices'] = $choices;
    }

    return $field;
}

// add_filter('acf/load_field/name=gravity_choices', 'acf_populate_gf_forms_ids');


// helper function to find a menu item in an array of items
function wpd_get_menu_item($field, $object_id, $items)
{
    foreach ($items as $item) {
        if ($item->$field == $object_id) {
            return $item;
        }
    }

    return false;
}

// add_filter('found_posts', 'myprefix_adjust_offset_pagination', 1, 2);
function myprefix_adjust_offset_pagination($found_posts, $query)
{

    $offset = 3;

    if ($query->is_home()) {
        return $found_posts - $offset;
    }
    return $found_posts;
}


function the_breadcrumb()
{
    global $post;
    echo '<ul class="breadcrumb my-0 py-4">';
    if (!is_home()) {
        echo '<li class="breadcrumb-item"><a class="text-decoration-none text-semi-light" href="';
        echo get_post_type_archive_link('post');
        echo '">';
        echo 'مقاله';
        echo '</a></li>';
        if (is_category() || is_single()) {
            echo '<li class="breadcrumb-item">';
            the_category(' </li><li class="breadcrumb-item"> ');
            if (is_single()) {
                echo '</li><li class="breadcrumb-item">';
                the_title();
                echo '</li>';
            }
        } elseif (is_page()) {
            if ($post->post_parent) {
                $anc = get_post_ancestors($post->ID);
                $title = get_the_title();
                foreach ($anc as $ancestor) {
                    $output = '<li><a class="breadcrumb-item" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li> <li class="separator">/</li>';
                }
                echo $output;
                echo '<strong title="' . $title . '"> ' . $title . '</strong>';
            } else {
                echo '<li><strong> ' . get_the_title() . '</strong></li>';
            }
        }
    }
    echo '</ul>';
}

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}

add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 *
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 *
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

        $urls = array_diff($urls, array($emoji_svg_url));
    }

    return $urls;
}


add_filter('is_xml_preprocess_enabled', 'wpai_is_xml_preprocess_enabled', 10, 1);
function wpai_is_xml_preprocess_enabled($is_enabled)
{
    return false;
}

