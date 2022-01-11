<?php

namespace Brainson\Scaffold;

trait GlobalFieldsTrait
{

    private function globalFields(): array
    {
        return [

            'margin_top' => [
                'key' => $this->getComponentName() . '_global_margin_top',
                'label' => '<span class="dashicons dashicons-arrow-up-alt2"></span> Abstand nach oben',
                'name' => 'global_margin_top',
                'type' => 'button_group',
                'required' => 1,
                'choices' => [
                    'large' => 'Groß',
                    'medium' => 'Mittel',
                    'small' => 'Klein',
                    'none' => 'Kein',
                ],
                'default_value' => 'medium',
                'return_format' => 'value',
                'wrapper' => [
                    'width' => '50%'
                ]
            ],

            'alternate_background' => [
                'key' => $this->getComponentName() . '_global_alternate_background',
                'label' => 'Alternative Hintergrundfarbe',
                'name' => 'global_alternate_background',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => '50%'
                ]
            ],

            'padding_top' => [
                'key' => $this->getComponentName() . '_global_padding_top',
                'label' => '<span class="dashicons dashicons-arrow-up"></span> Innenabstand nach oben',
                'name' => 'global_padding_top',
                'type' => 'button_group',
                'conditional_logic' => [
                    [
                        [
                            'field' =>  $this->getComponentName() . '_global_alternate_background',
                            'operator' => '==',
                            'value' => '1',
                        ],
                    ],
                ],
                'wrapper' => [
                    'width' => '50%'
                ],
                'choices' => [
                    'none' => 'kein Abstand',
                    'small' => 'klein',
                    'medium' => 'mittel',
                    'large' => 'groß',
                ],
                'default_value' => 'medium',
            ],
            'padding_bottom' => [
                'key' => $this->getComponentName() . '_global_padding_bottom',
                'label' => '<span class="dashicons dashicons-arrow-down"></span> Innenabstand nach unten',
                'name' => 'global_padding_bottom',
                'type' => 'button_group',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' =>  $this->getComponentName() . '_global_alternate_background',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => [
                    'width' => '50%'
                ],
                'choices' => [
                    'none' => 'kein Abstand',
                    'small' => 'klein',
                    'medium' => 'mittel',
                    'large' => 'groß',
                ],
                'default_value' => 'medium',
            ],
            'container_width' => [
                'key' => $this->getComponentName() . '_global_container_width',
                'label' => '<span class="dashicons dashicons-align-center"></span> Containerbreite',
                'name' => 'global_container_width',
                'type' => 'button_group',
                'choices' => [
                    'default' => 'Standard',
                    'wide' => 'Breit',
                ],
                'default_value' => 'default',
            ],
            'uniqueid' => [
                'key' => $this->getComponentName() . '_uniqueid',
                'label' => 'Anchor ID',
                'name' => 'uniqueid',
                "type" => "text",
                'instructions' => 'Diese ID wird als HTML ID der Komponente genutzt. Sie kann in der URL mit # als Anker-Link verwendet werden.<br />Wenn das Feld leer ist, wird beim nächsten speichern automatisch eine ID generiert.',
            ]

        ];
    }

    private function defineGlobalFields(array $fields = [])
    {
        $returnFields = [];
        foreach ($fields as $field) {
            if (array_key_exists($field, $this->globalFields())) $returnFields[$field] = $this->globalFields()[$field];
        }
        return $returnFields;
    }

    public function get_spacing_top_class_string(): string
    {
        switch ($this->data['global_margin_top']) {
            case 'none':
                return 'mt-0';
                break;
            case 'medium':
                return 'mt-16';
                break;
            case 'small':
                return 'mt-7';
                break;
            case 'large':
                return 'mt-12 lg:mt-32';
                break;
            case 'xlarge':
                return 'mt-16 md:mt-32';
                break;
            default:
                return 'mt-6';
        }
    }
    public function get_container_class_string(): string
    {
        switch ($this->data['global_container_width']) {
            case 'wide':
                return 'o-container o-container--lg';
                break;
            case 'default':
                return 'o-container ';
                break;
            default:
                return '';
        }
    }

    public function get_alternate_background_string(): string
    {
        if (isset($this->data['global_alternate_background']) && $this->data['global_alternate_background'] === true) {
            return 'bg-gray-200';
        } else {
            return '';
        }
    }

    public function get_padding_top_class_string(): string
    {
        if (isset($this->data['global_alternate_background']) && $this->data['global_alternate_background'] == true) {
            switch ($this->data['global_padding_top']) {
                case 'large':
                    return 'pt-16 lg:pt-24';
                    break;
                case 'medium':
                    return 'pt-8 lg:pt-12';
                    break;
                case 'none':
                    return 'pt-0';
                    break;
                default:
                    return 'pt-6';
            }
        } else {
            return "";
        }
    }

    public function get_padding_bottom_class_string(): string
    {
        if (isset($this->data['global_alternate_background']) && $this->data['global_alternate_background'] == true) {
            switch ($this->data['global_padding_bottom']) {
                case 'large':
                    return 'pb-16 pb:mt-24';
                    break;
                case 'medium':
                    return 'pb-8 lg:pb-12';
                    break;
                case 'none':
                    return 'pb-0';
                    break;
                default:
                    return 'pb-6';
            }
        } else {
            return "";
        }
    }
    
    private function getIconSVG($iconName): string
    {
        $svg = '<span class="items-center flex-1"><svg style="vertical-align: text-bottom;margin-right: 5px;" height="15" width="15"><use xlink:href="%s/assets/dist/svg/sprite.svg#icon-%s"></use></svg></span>';
        return sprintf($svg, get_template_directory_uri(), $iconName);
    }
}
