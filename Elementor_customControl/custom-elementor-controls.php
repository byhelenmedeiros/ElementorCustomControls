<?php
/**
 * Plugin Name: Elementor CustomControl
 * Description: Plugin para controles personalizados 
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.2
 * Text Domain: elementor-test-addon 
 */

namespace Eef\Includes;
require_once( 'widgets/class_customskin_posts.php' );

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Global_Colors;
use Elementor\Skin_Base as Elementor_Skin_Base;


if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Custom_Form_Extension {
    public function __construct() {
        add_action('elementor/element/form/section_form_fields/after_section_end', [$this, 'add_error_message_background_control'], 10, 2);
    }

    public function add_error_message_background_control($element, $args) {
        $element->start_controls_section(
            'section_error_message_background',
            [
                'label' => __('Alterar o fundo das mensagens de erro', 'extensions-for-elementor-form'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $element->add_control(
            'error_message_bg_color',
            [
                'label' => __('Alterar a cor do brackground da mensagem de erro', 'extensions-for-elementor-form'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-message.elementor-message-danger' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $element->add_control(
            'error_message_margin',
            [
                'label' => __('Margin', 'extensions-for-elementor-form'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 2,
					'right' => 0,
					'bottom' => 2,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
                'selectors' => [
                    '{{WRAPPER}} .elementor-message.elementor-message-danger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_control(
            'error_message_padding',
            [
                'label' => __('Padding', 'extensions-for-elementor-form'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 2,
					'right' => 0,
					'bottom' => 2,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
                'selectors' => [
                    '{{WRAPPER}} .elementor-message.elementor-message-danger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
$element->add_control(
    'error_message_padding',
    [
        'label' => __('Padding', 'extensions-for-elementor-form'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem', 'custom'],
        'default' => [
            'top' => 2,
            'right' => 0,
            'bottom' => 2,
            'left' => 0,
            'unit' => 'em',
            'isLinked' => false,
        ],
        'selectors' => [
            '{{WRAPPER}} .elementor-message.elementor-message-danger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);


        
        $element->end_controls_section();
    }
}

//alteracao para remover customcodecss para trocar cor no responsivo 
class Elementor_Custom_Heading_Extension{

    public function __construct() {
        add_action('elementor/element/heading/section_title_style/before_section_start', [$this, 'add_heading_mobile_control'], 10, 2);
    }

    public function add_heading_mobile_control($element, $args) {
       

        $element->start_controls_section(
            'title_color_responsive',
            [
                'label' => __('Alterar cor texto - responsivo ', 'extensions-for-elementor-form'),
            ]
        );

        $element->add_responsive_control(
            'title_color_mobile',
            [
                'label' => __('Cor do Título em Dispositivos Móveis', 'extensions-for-elementor-form'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
                ],
                'devices' => ['mobile'], // Define para dispositivos móveis
                'separator' => 'after', 
            ]
        );

        $element->end_controls_section(); 
    }
}


// Inclua o arquivo da sua skin


// Adicione sua skin personalizada na inicialização do Elementor
add_action( 'elementor/elements/posts/skins_registered', function( $widget ) {
    $widget->add_skin( new \element\Skins\Skin_Custom( $widget ) );
} );



new Elementor_Custom_Form_Extension();
new Elementor_Custom_Heading_Extension();
