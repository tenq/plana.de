<?php

use Brainson\Scaffold\ScaffoldContainer;
use \Brainson\Scaffold\Slot as Slot;
use Timber\Twig_Function;

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

if (!defined('THEME_DOMAIN')) {
    define('THEME_DOMAIN', 'brainson_theme');
}

//Initialize Timber
$timber = new Timber\Timber();

include_once __DIR__ . '/vendor/autoload.php';

include_once __DIR__ . '/includes/settings.php'; // settings page
include_once __DIR__ . '/includes/shortcodes.php'; // shortcodes
include_once __DIR__ . '/includes/custom_post_type.php'; // custom post types
include_once __DIR__ . '/includes/lib/lazyload.php'; // LazyLoading IMG
include_once __DIR__ . '/includes/lib/Breadcrumb.php'; // Breadcrumb class


if (SMTP_HOST) {
    function smtp_mailing($phpmailer)
    {
        $phpmailer->isSMTP();
        $phpmailer->Host = SMTP_HOST;
        $phpmailer->SMTPAuth = SMTP_AUTH == '1' ? true : false;
        $phpmailer->Port = SMTP_PORT;
        $phpmailer->Username = SMTP_USER ?: null;
        $phpmailer->Password = SMTP_PASS ?: null;
        if (SMTP_AUTO_TLS) {
            $phpmailer->SMTPAutoTLS = SMTP_AUTO_TLS;
        }
        $phpmailer->SMTPSecure = SMTP_SECURE;
        $phpmailer->SetFrom('test@test.com', 'Firma xyz');
    }

    add_action('phpmailer_init', 'smtp_mailing');
}

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

function setup_theme_settings()
{
    // Add Menu Support
    add_theme_support('menus');
    add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail

    add_image_size('square_small', 280, 280, true); // Small Square
    add_image_size('square_medium', 560, 560, true); // Medium Square
    add_image_size('square_large', 960, 960, true); // Large Square

    // Image Sizes: C1 Image
    add_image_size('c1-full', 1920, 1080, true); // Large Thumbnail
    add_image_size('c1-desktop', 1280, 720, true); // Large Thumbnail
    add_image_size('c1-tablet', 786, 442, true); // Large Thumbnail
    add_image_size('c1-mobile', 480, 270, true); // Large Thumbnail

    // Image Sizes: C4 Image
    add_image_size('c4-cta-box', 700, '', true); // Large Thumbnail

    // Image Sizes: C7 Video
    add_image_size('c7-full', 1600, 900, true); // Large Thumbnail
    add_image_size('c7-desktop', 1280, 720, true); // Large Thumbnail
    add_image_size('c7-tablet', 786, 442, true); // Large Thumbnail
    add_image_size('c7-mobile', 480, 270, true); // Large Thumbnail
    
    // Image Sizes: C9 Image Nestable
    add_image_size('c9-full', 1200, '', true); // Large Thumbnail
    add_image_size('c9-desktop', 700, '', true); // Large Thumbnail
    add_image_size('c9-tablet', 786, '', true); // Large Thumbnail
    add_image_size('c9-mobile', 480, '', true); // Large Thumbnail

    // Image Sizes: C12 Image Slider
    add_image_size('c12-image-slider-retina', 1920, 896, true); // Desktop Slider Image Retina
    add_image_size('c12-image-slider', 960, 448, true); // Desktop Slider Image 

    // Image Sizes: C15 Teaser Card
    add_image_size('teaser_card_small', 347, 231, true); // Small Teaser Card
    add_image_size('teaser_card_medium', 694, 462, true); // Medium Teaser Card

    // Load Language
    if (file_exists(__DIR__ . '/languages')) {
        load_theme_textdomain(THEME_DOMAIN, __DIR__ . '/languages');
    }
}

//Remove the editor (the_content) from post and page
add_action('init', function () {
    remove_post_type_support('page', 'editor');
    remove_post_type_support('post', 'editor');
});

/*------------------------------------*\
    Scaffold Container
\*------------------------------------*/

// Register main slots
ScaffoldContainer::registerSlot(new Slot('main_bb', 'Komponenten vor Breadcrumb', false));
ScaffoldContainer::registerSlot(new Slot('main', 'Komponenten', false));


//Add Functions to Twig
add_filter(
    'timber/twig',
    function ($twig) {


        $twig->addFunction(new Twig_Function('render_slot', function ($post_id, $slot = null, $nestedLayouts = null, $parentObject = null) {

            if (is_object($slot)) {
                $slot->renderComponents($nestedLayouts, $post_id, $parentObject);
            } else {
                ScaffoldContainer::getSlot($slot)->renderComponents($nestedLayouts, $post_id, $parentObject);
            }
        }));

        //Function to wrap wp_get_attachment_image
        $twig->addFunction(new Twig_Function('get_attachment_image', function ($attachment_id, $size, $class = "", $sizes = null, ...$attrs) {
            $attr = [];
            if ($attrs) {
                if (count($attrs) % 2) {
                    throw new Exception("\$attrs must be of even length with key, followed by value - key1,value1,key2,value2,...");
                }
                $keys = array_filter($attrs, function ($input) {
                    return $input & 1;
                }, ARRAY_FILTER_USE_KEY);
                $values = array_filter($attrs, function ($input) {
                    return !($input & 1);
                }, ARRAY_FILTER_USE_KEY);
                $attr = array_combine($keys, $values);
            }
            if (!empty($class)) {
                $attr['class'] = $class;
            }
            if ($sizes !== null) {
                $attr['sizes'] = $sizes;
            }

            return wp_get_attachment_image($attachment_id, $size, false, $attr);
        }));

        $twig->addFilter(new Timber\Twig_Filter('youtubeEmbedOptions', function ($video) {
            // Use preg_match to find iframe src.
            preg_match('/data-src="(.+?)"/', $video, $matches);
            $src = $matches[1];

            // Add extra parameters to src and replcae HTML.
            // Docs for parameters on https://developers.google.com/youtube/player_parameters?hl=de#rel
            $params = array(
                'rel'  => 0,
                'modestbranding' => 1,
                'showinfo' => 0
            );
            $new_src = add_query_arg($params, $src);
            $video = str_replace($src, $new_src, $video);

            $video = str_replace('youtube.com/embed/', 'youtube-nocookie.com/embed/', $video);

            return $video;
        }));

        // Add Array Extension to twig (to enable shuffling of arrays)
        $twig->addExtension(new Twig_Extensions_Extension_Array());

        return $twig;
    }
);

/*------------------------------------*\
    Formfactory
\*------------------------------------*/

define('FORM_CONTACT', 'Kontakt');

try {
    $register = \Brainson\Formfactory\Form\Registry::getInstance();
    $register[FORM_CONTACT] = __DIR__ . '/formfactory/forms/contact';
} catch (Throwable $e) {
    error_log("Formfactory nicht installiert - kann nicht registrieren");
}


/*------------------------------------*\
    Functions
\*------------------------------------*/

// Add anchor id to acf fields
add_filter('acf/update_value', function( $value, $post_id, $field, $original ) {
    // if no uniqueid is set, automatically generate one
    if(isset($field['name']) && (strrpos($field['name'], 'uniqueid') == strlen($field['name']) - strlen('uniqueid')) && empty($value)) {
        $value = crc32(uniqid('', true));
    } 
    return $value;
}, 10, 4);

// Add Preload Elements to wp_head
add_action('wp_head', function () {
    foreach (\apply_filters('scaffold_preload_elements', []) as $element) {
        printf('<link rel="preload" href="%s" as="%s">%s', $element['url'], $element['type'], PHP_EOL);
    };
});

// save method for check if acf function is exists

function get_save_field($selector, $post_id = false, $format = true)
{
    if (!function_exists('get_field')) {
        return false;
    }

    return get_field($selector, $post_id, $format);
}

!defined('THEME_PRODUCTION_MODE') and define('THEME_PRODUCTION_MODE', get_save_field('productive', 'option'));


function brainson_scripts()
{
    wp_enqueue_script('main-scripts', get_template_directory_uri() . '/assets/dist/scripts/bundle.js', [], '1.0', true);
}

add_action('wp_head', function(){
    echo "<style>" . file_get_contents(get_template_directory() . '/assets/dist/styles/bundle.css') . "</style>";
}, 100);

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus([ // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', THEME_DOMAIN), // Main Navigation
        'footer-menu' => __('Footer Menu', THEME_DOMAIN), // Extra Navigation if needed (duplicate as many as you need!)
    ]);

    add_filter('timber/context', function ($context) {
        $context['lang_switcher'] = new \Brainson\Scaffold\LanguageSwitcher();

        $context['menus']['header'] = new \Timber\Menu('header-menu');
        $context['menus']['footer'] = new \Timber\Menu('footer-menu');

        return $context;
    });
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', [
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style',
    ]);
}

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
}

function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, ['wpemoji']);
    }

    return [];
}

function disable_embeds_init()
{
    if (!is_admin()) {
        wp_deregister_script('wp-embed');
    }

    remove_action('rest_api_init', 'wp_oembed_register_route'); // Remove the REST API endpoint.
    add_filter('embed_oembed_discover', '__return_false'); // Turn off oEmbed auto discovery.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10); // Don't filter oEmbed results.
    remove_action('wp_head', 'wp_oembed_add_discovery_links'); // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_host_js'); // Remove oEmbed-specific JavaScript from the front-end and back-end.
}

function disable_rest_api($response, $server, $request)
{
    /** @var WP_REST_Request $request */

    $route = $request->get_route();
    $allowedRoutes = [
        '/wp/v2/posts',
        '/formfactory/v1'
    ];

    foreach ($allowedRoutes as $allowedRoute) {
        // check if route is beginning with pattern
        if (strpos($route, $allowedRoute) === 0) {
            return $response;
        }
    }

    if (!is_user_logged_in()) {
        $response = new WP_REST_Response();
        $response->set_data([
            'code'    => 'rest_not_allowed',
            'message' => 'Rest Endpoint is not allowed',
            'status'  => 401,
        ]);
    }

    return $response;
}

function brainson_template_redirect()
{
    /** @var WP_Query $wp_query */
    global $wp_query, $post;

    if (is_attachment()) {
        $post_parent = $post->post_parent;

        if ($post_parent) {
            wp_redirect(get_permalink($post->post_parent), 301);
            exit;
        }

        $wp_query->set_404();
        status_header(404);

        return;
    }

    if (is_author() || is_date()) {
        $wp_query->set_404();
        status_header(404);
    }
}

function hide_update_notification()
{
    if (!is_super_admin()) {
        remove_action('admin_notices', 'update_nag', 3);
    }
}

function async_style_loader($html, $handle, $href)
{
    echo '<link rel="stylesheet" href="' . $href . '" media="print" onload="this.media=\'all\'; this.onload=null;">';
    echo '<noscript><link rel="stylesheet" href="' . $href . '" media="all"></noscript>';

    return '';
}

function defer_script_loader($html)
{
    return str_replace('></script>', ' defer></script>', $html);
}

function load_critical_css()
{
    if (file_exists(__DIR__ . '/assets/dist/styles/critical.css')) {
        echo '<style>' . file_get_contents(__DIR__ . '/assets/dist/styles/critical.css') . '</style>';
    }
}


function disable_logged_in_cache()
{
    global $wp_cache_not_logged_in;

    $wp_cache_not_logged_in = 1;
}

function blacklist_uploaded_file_name($file)
{
    // remove all spaces
    $file['name'] = preg_replace('/\s*/', '', $file['name']);

    // remove multi bytes chars
    $file['name'] = strtolower(remove_accents($file['name']));

    $fileExtensions = '\.(jpg|jpeg|png|gif)';

    $badWords = [
        'IMG_\d*' . $fileExtensions, // IMG_2021
        '[\d_]*' . $fileExtensions, // 1231231_2123
        'DSC[N|_]\d*' . $fileExtensions, // DSC_2922 or DSCN021231
        'P\d*' . $fileExtensions, // P1060077
        'image\d*' . $fileExtensions, // image21,
        'istock_\d*' . $fileExtensions, // istock_1231231230
        'shutterstock_\d*-\d*x\d*' . $fileExtensions, // shutterstock_412391_240x520
        'Unknown.*' . $fileExtensions, // Unknown1 Unknown-9
    ];

    foreach ($badWords as $badWord) {
        $matched = preg_match('/^' . $badWord . '$/i', $file['name'], $matches);

        if ($matched && isset($matches[0])) {
            $file['error'] = __('This filename is not allowed. Please use a meaningful name.', THEME_DOMAIN);
            break;
        }
    }

    return $file;
}

function remove_hentry_class($classes)
{
    return array_diff($classes, ['hentry']);
}

function tinymce_allow_microdata($options)
{
    if (!isset($options['extended_valid_elements'])) {
        $options['extended_valid_elements'] = '';
    } else {
        $options['extended_valid_elements'] .= ',';
    }

    // Erlaubte microdata auf <p>
    $options['extended_valid_elements'] .= 'p[itemref|itemid|itemscope|itemtype|itemprop|class|style]';

    // Erlaubte microdata auf <span>
    $options['extended_valid_elements'] .= ',span[itemref|itemid|itemscope|itemtype|itemprop|class|style]';

    // Erlaubte microdata auf <a>
    $options['extended_valid_elements'] .= ',a[itemref|itemid|itemscope|itemtype|itemprop|href|title|target|class|style]';

    return $options;
}

function disable_attachment_link()
{
    $image_set = get_option('image_default_link_type');

    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}

function add_last_file_mod_time_as_version($src)
{
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }

    if (is_admin()) {
        return $src;
    }

    $file = str_replace(home_url(), '', $src);
    $templateDir = str_replace(WP_CONTENT_DIR, '', TEMPLATEPATH);

    // check if file in template folder
    if (($pos = strpos($file, $templateDir)) !== false) {
        // get only the filename
        $filename = substr($file, $pos + strlen($templateDir));

        // generate the full path of the file
        $file = TEMPLATEPATH . $filename;

        if (file_exists($file)) {
            $time = filemtime($file);
            $fileInfo = new SplFileInfo($file);

            // generate new filename
            $filename = $fileInfo->getBasename('.' . $fileInfo->getExtension()) . '.' . $time . '.' . $fileInfo->getExtension();

            return str_replace(basename($file), $filename, $src);
        }
    }

    return $src;
}

function brainson_do_robots()
{
    header('Content-Type: text/plain; charset=utf-8');

    do_action('do_robotstxt');
    $output = "User-agent: *\n";
    $public = get_option('blog_public');
    if (WP_ENV == 'production') {
        if ('0' == $public) {
            $output .= "Disallow: /\n";
            $output .= "# option set\n";
        } else {
            $site_url = parse_url(site_url());
            $path = (!empty($site_url['path'])) ? $site_url['path'] : '';
            $output .= "Disallow: $path/wp-admin/\n";
        }
    } else {
        $output .= "Disallow: /\n";
        $output .= "# local or staging\n";
        if ('0' == $public) {
            $output .= "# warning: option also checked!\n";
        }
    }
    # $output .= 'Sitemap: ' . site_url() . "/sitemap_index.xml\n";
    $output .= 'Sitemap: ' . site_url() . "/sitemap.xml\n";

    echo apply_filters('robots_txt', $output, $public);
}

/**
 * @see https://wordpress.stackexchange.com/questions/12863/check-if-wp-login-is-current-page
 * @return bool
 */
function is_wplogin()
{
    $ABSPATH_MY = str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, ABSPATH);

    return ((in_array($ABSPATH_MY . 'wp-login.php', get_included_files()) || in_array($ABSPATH_MY . 'wp-register.php', get_included_files())) ||
        (isset($_GLOBALS['pagenow']) && $GLOBALS['pagenow'] === 'wp-login.php') || $_SERVER['PHP_SELF'] == '/wp-login.php');
}


/*------------------------------------*\
    Actions + Filters
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'brainson_scripts'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'disable_emojis'); // remove emojis js code
add_action('init', 'disable_embeds_init', 9999); // remove embed js
add_action('cache_init', 'disable_logged_in_cache'); // disable wp super cache for logged in user
add_action('template_redirect', 'brainson_template_redirect'); // disallow specific pages like attachment
add_action('admin_menu', 'hide_update_notification'); // hide update notification for non admins
add_action('after_setup_theme', 'setup_theme_settings'); // settings for initial configuration
add_action('admin_init', 'disable_attachment_link', 10); // do not link medias to there attachment page
add_action('do_robots', 'brainson_do_robots'); // add custom robots.txt

// Add Filters
add_filter('tiny_mce_before_init', 'tinymce_allow_microdata'); // allow schema.org attributes in TinyMCE
add_filter('comments_open', '__return_false'); // not allow to comments on pages
add_filter('rest_post_dispatch', 'disable_rest_api', 10, 3); // disable the rest api
add_filter('disable_wpseo_json_ld_search', '__return_true'); // remove structured data for search URL
add_filter('wp_handle_upload_prefilter', 'blacklist_uploaded_file_name'); // disallow specific file names
add_filter('post_class', 'remove_hentry_class'); // remove hentry class because google think its a schema (like schema.org)
add_filter('xmlrpc_enabled', '__return_false'); // disable xml-rpc interface
add_filter('style_loader_src', 'add_last_file_mod_time_as_version');
add_filter('script_loader_src', 'add_last_file_mod_time_as_version');
add_filter('wp_sitemaps_enabled', '__return_false');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('do_robots', 'do_robots'); // remove default robots
remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles'); // removes gutenberg frontend styles

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

if (THEME_PRODUCTION_MODE && !is_admin() && !is_wplogin()) {
    add_action('style_loader_tag', 'async_style_loader', 10, 3);
    add_action('wp_head', 'load_critical_css', 1);
    add_action('script_loader_tag', 'defer_script_loader');
}


/*------------------------------------*\
    404 Page
\*------------------------------------*/

// show 404 status in admin page overview
add_filter('display_post_states', function ($post_states, $post) {

    $page_404_id = get_field('404_page', 'option');
    if ($post->ID == $page_404_id) {
        $post_states[] = '404 Seite';
    }

    return $post_states;
}, 1, 2);

/*------------------------------------*\
    oEmbed remove do not track https://developer.wordpress.org/reference/hooks/oembed_fetch_url/
    Since WP 4.9.0 Wordpress add the do not track option by default.
    This functions disabels do not track so for example the vimeo analytics can track views
\*------------------------------------*/
function custom_remove_embed_url_dnt($provider, $url, $args)
{
    return add_query_arg(array('dnt' => false), $provider);
}

add_filter('oembed_fetch_url', 'custom_remove_embed_url_dnt', 10, 3);

/*
* Avoid 404 redirect for the Pagination
*/

// Remove the offending parts of the URL before WP tries to process the URL
if (!function_exists('brainson_request'))
{
    function brainson_request($query_string)
    {
        if (isset( $query_string['page'] ))
        {
            if ('' != $query_string['page'])
            {
                if (isset( $query_string['name'] ))
                {
                    unset( $query_string['name'] );
                }
            }
        }

        return $query_string;
    }
    add_filter('request', 'brainson_request');
}

// Append the page number from the URL to the WP query in the required format
if (!function_exists('brainson_pre_get_posts'))
{
    function brainson_pre_get_posts($query)
    {
        if ($query->is_main_query() && !$query->is_feed() && !is_admin())
        {
            $query->set('paged', str_replace('/', '', get_query_var('page')));
        }
    }
    add_action('pre_get_posts', 'brainson_pre_get_posts');
}

add_filter('show_admin_bar', '__return_false');
//
//if (function_exists('acf_add_options_page')) {
//    $option_page = acf_add_options_page(array(
//        'page_title' => 'Themen Einstellungen',
//        'menu_title' => 'Themen Einstellungen',
//        'menu_slug' => 'theme-general-settings',
//        'capability' => 'edit_posts',
//        'redirect' => false
//    ));
//}