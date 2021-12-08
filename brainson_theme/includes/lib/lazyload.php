<?php
/**
 * @see              https://github.com/aFarkas/wp-lazysizes
 * @since             2.0.0
 *
 * @package           https://github.com/aFarkas/wp-lazysizes
 *
 * @wordpress-plugin
 */

if (!class_exists('LazySizes')) :

    class LazySizes
    {
        const version = '0.9.4';

        private static $instance;

        public function __construct()
        {
            if (!is_admin()) {
                add_filter('the_content', [$this, 'filter_content'], 200);
                add_filter('post_thumbnail_html', [$this, 'filter_content'], 200);
                add_filter('widget_text', [$this, 'filter_content'], 200);
                add_filter('acf_the_content', [$this, 'filter_content'], 200);
                add_filter('wp_get_attachment_image_attributes', [$this, 'filter_attributes'], 200);
            }
        }

        public function filter_content($content)
        {
            if (!$this->isAllowed()) {
                return $content;
            }

            $content = $this->filter_images($content);

            return $content;
        }

        // @codeCoverageIgnoreStart
        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        // @codeCoverageIgnoreEnd

        protected function isAllowed()
        {
            if (is_feed()
                || (int) (get_query_var('print')) == 1
                || (int) (get_query_var('printpage')) == 1
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            ) {
                return false;
            }

            return true;
        }

        public function filter_attributes($attributes)
        {
            $srcset = isset($attributes['srcset']) ? $attributes['srcset'] : null;
            $sizes = isset($attributes['sizes']) ? $attributes['sizes'] : null;
            $src = isset($attributes['src']) ? $attributes['src'] : null;
            $class = isset($attributes['class']) ? $attributes['class'] : null;

            if (strpos($class, 'lazyload') !== false) {
                return $attributes;
            }

            unset($attributes['srcset'], $attributes['sizes']);

            if (!$sizes) {
                $sizes = 'auto';
            }

            $class .= ' lazyload';

            $attributes['data-src'] = $src;

            if ($sizes) {
                $attributes['data-sizes'] = $sizes;
            }

            if ($srcset) {
                $attributes['data-srcset'] = $srcset;
            }

            $attributes['src'] = $this->get_placeholder_img();
            $attributes['class'] = $class;

            return $attributes;
        }

        public function filter_images($content)
        {
            $respReplace = 'data-sizes="auto" data-srcset=';

            $matches = [];
            $skip_images_regex = '/class=".*lazyload.*"/';
            preg_match_all('/<\b(img|iframe)\s+.*?>/', $content, $matches);

            $search = [];
            $replace = [];

            foreach ($matches[0] as $x => $imgHTML) {
                $tag = $matches[1][$x];

                // Don't to the replacement if a skip class is provided and the image has the class.
                if (!(preg_match($skip_images_regex, $imgHTML))) {
                    $replaceHTML = preg_replace(
                        '/<' . $tag . '(.*?)src=/i',
                        '<' . $tag . '$1src="' . $this->get_placeholder_img() . '" data-src=',
                        $imgHTML
                    );

                    $replaceHTML = preg_replace('/srcset=/i', $respReplace, $replaceHTML);

                    $replaceHTML = $this->_add_class($replaceHTML, 'lazyload');

                    if ($tag != 'iframe') {
                        $replaceHTML .= '<noscript>' . $imgHTML . '</noscript>';
                    }

                    array_push($search, $imgHTML);
                    array_push($replace, $replaceHTML);
                }
            }

            $content = str_replace($search, $replace, $content);

            return $content;
        }

        private function _add_class($htmlString, $newClass)
        {
            $pattern = '/class="([^"]*)"/';

            // Class attribute set.
            if (preg_match($pattern, $htmlString, $matches)) {
                $definedClasses = explode(' ', $matches[1]);
                if (!in_array($newClass, $definedClasses)) {
                    $definedClasses[] = $newClass;
                    $htmlString = str_replace(
                        $matches[0],
                        sprintf('class="%s"', implode(' ', $definedClasses)),
                        $htmlString
                    );
                }
                // Class attribute not set.
            } else {
                $htmlString = preg_replace('/(\<\w+\s)/', sprintf('$1class="%s" ', $newClass), $htmlString);
            }

            return $htmlString;
        }

        public function get_placeholder_img()
        {
            return apply_filters(
                'lazysizes_placeholder_image',
                'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='
            );
        }
    }

    LazySizes::get_instance();

endif;
