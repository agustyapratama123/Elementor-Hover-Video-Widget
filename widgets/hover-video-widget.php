<?php


if ( ! defined( 'ABSPATH' )) {
    exit; // Exit if accessed directly.
}

class Elementor_Hover_Video_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hover_video_widget';
    }

    public function get_title() {
        return __( 'Hover Video Widget', 'elementor-hover-video-widget' );
    }

    public function get_icon() {
        return 'eicon-video-camera';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function _register_controls() {
        // Image Section
        $this->start_controls_section(
            'image_section',
            [
                'label' => __( 'Image Settings', 'elementor-hover-video-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Video Section
        $this->start_controls_section(
            'video_section',
            [
                'label' => __( 'Video Settings', 'elementor-hover-video-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video',
            [
                'label' => __( 'Choose Video', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'video', // Hanya mengizinkan file video
            ]
        );

        $this->end_controls_section();

        // Overlay Section
        $this->start_controls_section(
            'overlay_section',
            [
                'label' => __( 'Overlay Settings', 'elementor-hover-video-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'overlay_text',
            [
                'label' => __( 'Overlay Text', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Video Overlay Text', 'elementor-hover-video-widget' ),
            ]
        );

        $this->add_control(
            'overlay_background_color',
            [
                'label' => __( 'Overlay Background Color', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.7)',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'container_style_section',
            [
                'label' => __( 'Container Style', 'elementor-hover-video-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'container_height',
            [
                'label' => __( 'Container Height (px)', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-hover-video-container' => 'height: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-hover-video-container, 
                     {{WRAPPER}} .elementor-hover-image, 
                     {{WRAPPER}} .elementor-hover-video' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
        
        $this->add_control(
            'object_fit',
            [
                'label' => __( 'Object Fit', 'elementor-hover-video-widget' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'cover' => __( 'Cover', 'elementor-hover-video-widget' ),
                    'contain' => __( 'Contain', 'elementor-hover-video-widget' ),
                    'fill' => __( 'Fill', 'elementor-hover-video-widget' ),
                ],
                'default' => 'cover',
                'selectors' => [
                    '{{WRAPPER}} .elementor-hover-image, {{WRAPPER}} .elementor-hover-video' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        $image_url = $settings['image']['url'];
        $video_url = $settings['video']['url'];
        $overlay_text = $settings['overlay_text'];
        $overlay_background_color = $settings['overlay_background_color'];
        ?>
        <div class="elementor-hover-video-container">
            <!-- <img src="<?php echo esc_url( $image_url ); ?>" alt="Hover to play video" class="elementor-hover-image"> -->
            <div class="elementor-hover-image" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>

            <video class="elementor-hover-video" muted playsinline loop>
                <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="elementor-hover-overlay" style="background-color: <?php echo esc_attr( $overlay_background_color ); ?>;">
                <?php echo esc_html( $overlay_text ); ?>
            </div>
        </div>
        <?php
    }
}