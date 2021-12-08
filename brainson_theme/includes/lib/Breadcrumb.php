<?php

/**
 * Class Breadcrumb.
 *
 * # Usage:
 *
 * ## Simple:
 * $breadcrumb = new Breadcrumb($settings);
 * echo $breadcrumb->render();
 *
 * ## Extended:
 * $breadcrumb = new Breadcrumb($settings);
 * $breadcrumb->addPart(Breadcrumb::getItemView([
 *      'name' => 'Page Name',
 *      'url' => 'http://....',
 *      'class' => 'home' (optional, added mor classes to the li element),
 * ]);
 * echo $breadcrumb->render();
 *
 * or:
 * $breadcrumb->addPart('<li ...>');
 *
 * ## $settings:
 *       home_text: false|string, if home_text is false the default home text is used
 *       always_home: bool, display the home item when no other items exists
 * TODO: with_categories: when post/page has categories then it output before the current item
 */
class Breadcrumb
{
    public static $defaultSettings = [
        'home_text' => false,
        'always_home' => false,
        'with_categories' => false,
        'structure' => self::STRUCTURE_NAV
    ];

    const STRUCTURE_NAV = 'nav';

    const STRUCTURE_PAGE = 'page';

    public $settings;

    protected $parts;

    public function __construct(array $settings = [])
    {
        $this->settings = array_merge(static::$defaultSettings, $settings);
    }

    public function getParts()
    {
        return $this->parts;
    }

    protected function buildNavStructure()
    {
        $currentItem = $this->getWPNavItem(get_queried_object_id());

        // render home item
        if ($currentItem->object_id != $this->getHomePageId()) {
            $this->addHomePart($this->settings['always_home']);
        }

        // render normal item
        if ($currentItem && ($this->isNormalPage() || $this->isArchivePage())) {
            $tmpOutput = [];

            // when post parent exists loop through it
            $obj = $currentItem;
            while ($obj && $nav_id = $obj->menu_item_parent) {
                $obj = wp_setup_nav_menu_item(get_post($nav_id));

                if ($obj) {
                    $tmpOutput[] = [
                        'url' => get_permalink($obj->object_id),
                        'name' => $obj->title
                    ];
                }
            }

            // reverse the tmpOutput because the search from the inner context
            array_map([$this, 'addToPart'], array_reverse($tmpOutput));

            // add page/post categories
            if ($this->isArchivePage()) {
                if ($this->settings['with_categories']) {
                    $this->addCategoryPart();
                }
            }
            else {
                // add this as item
                $this->addToPart([
                    'url' => get_permalink($currentItem->ID),
                    'name' => $currentItem->post_title,
                    'class' => 'current'
                ]);
            } 
        }

        // handle date archive
        if ($currentItem && $this->isDateArchivePage()) {
            $this->addDateArchivePart();
        }
    }

    protected function buildPageStructure()
    {
        /** @var WP_Post $currentItem */
        $currentItem = get_queried_object();

        if (is_post_type_archive())
        {
            $this->addHomePart($this->settings['always_home']);

            $this->addToPart([
                'url' => get_post_type_archive_link($currentItem->name),
                'name' => $currentItem->labels->name
            ]);
        }
        else
        {
            // render home item
            if ($currentItem->ID != $this->getHomePageId()) {
                $this->addHomePart($this->settings['always_home']);
            }

            // render normal item
            if ($currentItem && ($this->isNormalPage() || $this->isArchivePage())) {
                $tmpOutput = [];

                // when post parent exists loop through it
                $obj = $currentItem;
                while ($obj && $nav_id = $obj->post_parent) {
                    $obj = get_post($nav_id);

                    if ($obj) {
                        $tmpOutput[] = [
                            'url' => get_permalink($obj->ID),
                            'name' => $obj->post_title
                        ];
                    }
                }

                // reverse the tmpOutput because the search from the inner context
                array_map([$this, 'addToPart'], array_reverse($tmpOutput));

                // add page/post categories
                if ($this->isArchivePage()) {
                    if ($this->settings['with_categories']) {
                        $this->addCategoryPart();
                    }
                }
                else {

                    if(is_single())
                    {
                        if (get_post_type(get_the_ID()) == 'post') {
                            $category = get_the_category(get_the_ID());
                            $this->addToPart([
                                'url' => get_category_link($category[0]->cat_ID),
                                'name' => $category[0]->cat_name,
                            ]);
                        }
                        else
                        {
                            $this->addToPart([
                                'url' => get_post_type_archive_link(get_post_type(get_the_ID())),

                                'name' => get_post_type_object(get_post_type())->labels->name
                            ]);
                        }
                    }
                    // add this as item
                    $this->addToPart([
                        'url' => get_permalink($currentItem->ID),
                        'name' => $currentItem->post_title,
                        'class' => 'current'
                    ]);
                }            
            }

            // handle date archive
            if ($currentItem && $this->isDateArchivePage()) {
                $this->addDateArchivePart();
            }
        }

    }

    public function build()
    {
        if (defined('NO_BREADCRUMB') && NO_BREADCRUMB === true) {
            return '';
        }

        if ($this->settings['structure'] == static::STRUCTURE_NAV) {
            $this->buildNavStructure();
        } else {
            $this->buildPageStructure();
        }


        return $this;
    }

    public function render()
    {
        // if parts are empty, maybe no build was executed
        if (empty($this->parts)) {
            $this->build();
        }

        $parts = $this->parts;


        // if (!empty($parts)) {
        //     foreach ($parts as $i => &$part) {
        //         $part = str_replace('{{count}}', ++$i, $part);
        //     }

        //     array_unshift($parts, '<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">');
        //     array_push($parts, '</ol>');

        //     return implode(PHP_EOL, $parts);
        // }

        return $parts;

    }

    public function addDateArchivePart()
    {
        if ($this->isMonthArchive()) {
            $this->addToPart([
                'url' => get_year_link(get_the_date('Y')) . '?post_type=' . get_post_type(),
                'name' => get_the_date('Y')
            ]);

            $this->addToPart([
                'url' => get_month_link(get_the_date('Y'), get_the_date('d')) . '?post_type=' . get_post_type(),
                'name' => get_the_date('d')
            ]);
        } elseif ($this->isYearArchive()) {
            $this->addToPart([
                'url' => get_year_link(get_the_date('Y')) . '?post_type=' . get_post_type(),
                'name' => get_the_date('Y'),
            ]);
        }

        return $this;
    }

    public function addHomePart($alwaysHome = false)
    {
        $defaultDefaultText = 'Home';

        if ($this->settings['structure'] == static::STRUCTURE_NAV) {
            $homeNav = $this->getWPNavItem($this->getHomePageId());
            $defaultText = $homeNav ? $homeNav->title : $defaultDefaultText;
        } else {
            if ($this->getHomePageId()) {
                $defaultText = get_post($this->getHomePageId())->post_title;
            } else {
                $defaultText = $defaultDefaultText;
            }
        }

        $view = [
            'url' => home_url(),
            'name' => $this->settings['home_text'] === false ? $defaultText : $this->settings['home_text'],
            'class' => 'home'
        ];

        if ($this->isHome()) {
            if ($alwaysHome) {

                $this->addToPart($view);
            }

            if (is_home()) {
                $blog_id = get_option( 'page_for_posts' );

                $this->addToPart([
                    'url' => get_permalink($blog_id),
                    'name' => get_the_title($blog_id),
                    'class' => 'current'
                ]);
            }
                // var_dump(get_permalink( get_option( 'page_for_posts' ) ));
        } else {
            $this->addToPart($view);
        }
    }

    protected function addCategoryPart()
    {
        if ($this->isNormalPage()) {

        }
        else {
            $category = get_category( get_query_var( 'cat' ) );

            $this->addToPart([
                'url' => get_category_link($category->cat_ID),
                'name' => $category->cat_name,
                'class' => 'current'
            ]);
        }
    }

    public function addToPart($part)
    {
        $this->parts[] = $part;

        return $this;
    }

    /**
     * @param $post_id
     *
     * @return null|object
     */
    protected function getWPNavItem($post_id)
    {
        global $wpdb;

        /** @noinspection SqlDialectInspection */
        $posts = $wpdb->get_results('SELECT * FROM ' . $wpdb->postmeta . '
    INNER JOIN ' . $wpdb->posts . ' 
      ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id
         AND ' . $wpdb->posts . ".post_status = 'publish'
WHERE meta_key = '_menu_item_object_id' AND  meta_value = '" . $post_id . "' LIMIT 2", ARRAY_A);

        if (is_array($posts) && !empty($posts)) {
            return wp_setup_nav_menu_item(get_post($posts[0]['post_id']));
        }

        return null;
    }

    public static function getItemView(array $settings)
    {
        $class = 'item';
        $class .= isset($settings['class']) ? ' ' . $settings['class'] : '';

        return <<<HTML
<li class="{$class}" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <meta itemprop="position" content="{{count}}" />
    <a href="{$settings['url']}" itemprop="item" itemscope itemtype="http://schema.org/Thing">
        <span itemprop="name" property="name">{$settings['name']}</span>
    </a>
</li>
HTML;
    }

    protected function getHomePageId()
    {
        return get_option('page_on_front');
    }

    protected function isHome()
    {
        return is_home() || get_option('page_on_front') == get_the_ID();
    }

    protected function isNormalPage()
    {
        return is_page() || is_single();
    }


    protected function isCategoryPage()
    {
        return is_category();
    }

    protected function isArchivePage()
    {
        return is_archive();
    }

    protected function isDateArchivePage()
    {
        return is_date();
    }

    protected function isMonthArchive()
    {
        return is_month();
    }

    protected function isYearArchive()
    {
        return is_year();
    }
}
