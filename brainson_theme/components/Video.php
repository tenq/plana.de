<?php

namespace Brainson\Scaffold\ContentComponents;

use \Brainson\Scaffold\ContentComponentAbstract as ContentComponentAbstract;
use Brainson\Scaffold\GlobalFieldsTrait;

class Video extends ContentComponentAbstract
{
    use GlobalFieldsTrait;

    public static $isNestable = true;


    public static function getComponentName(): string
    {
        return 'video';
    }

    public static function getComponentLabel(): string
    {
        return 'Video';
    }

    protected function getComponentTemplatePath(): string
    {
        return __DIR__ . '/../templates/components/video.twig';
    }

    public function getEmbedHTML(): string
    {
        $output = $this->data['video'];
        if (\is_plugin_active('dsgvo_toolkit/dsgvo-toolkit.php')) {
            if((strpos($output, 'https://player.vimeo.com') !== false)){
                // filter DSGVO Vimeo if DSGVOT is active
                $service = new \Brainson\DSGVOT\Service\VimeoService();
                $service->name = 'vimeo';
                $output = $service->filterContent($output);
                
            }else{
                // filter DSGVO YouTube if DSGVOT is active
                $service = new \Brainson\DSGVOT\Service\YoutubeService();
                $service->name = 'youtube';
                $output = $service->filterContent($output);

                // replace URL to no-cookie URL
                $output = str_replace('youtube.com/embed/', 'youtube-nocookie.com/embed/', $output);
            }
        }

        return $output;
    }


    public function defineFields(): array
    {
        $globalFields = $this->isNested ? ['margin_top'] : ['margin_top', 'alternate_background', 'padding_top', 'padding_bottom', 'container_width'];

        return [

            'key' => 'content_component_video',
            'name' => self::getComponentName(),
            'label' => self::getComponentLabel(),
            'display' => 'block',
            'sub_fields' => array_merge(
                $this->defineGlobalFields($globalFields),
                [
                    array(
                        'key' => 'field_5fb51df94dfa9',
                        'label' => 'Video-URL',
                        'name' => 'video',
                        "type" => "oembed",
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_5fb51ee324c1b',
                        'label' => 'Titel',
                        'name' => 'title',
                        "type" => "text",
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_5fb51f06ed287',
                        'label' => 'Beschreibung',
                        'name' => 'description',
                        "type" => "text",
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                        ),
                    ),
                ],
                $this->defineGlobalFields(['uniqueid']),
            )
        ];
    }
}
