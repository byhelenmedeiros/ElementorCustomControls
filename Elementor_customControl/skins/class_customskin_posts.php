<?php 

namespace ElementorPro\Modules\Posts\Widgets;

use Elementor\Controls_Manager;
use ElementorPro\Modules\Posts\Skins\Skin_Base;

class Skin_Custom extends Skin_Base {

    public function __construct() {
        parent::__construct();
        add_action('elementor/element/posts/classic/section_design_layout/after_section_end', [$this, 'add_extends_classic_skin'], 10, 2);
    }

    public function add_extends_classic_skin($element, $args) {
        $element->start_controls_section(
            'section_design_content',
            [
                'label' => esc_html__( 'Content', 'elementor-pro' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $element->add_control(
            'read_more_background',
            [
                'label' => esc_html__( 'Background - Read More', 'elementor-pro' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-post__read-more a' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $element->end_controls_section();
    }
}
