<?php

if ( !class_exists('Mage_Carousel_Setting' ) ):
class Mage_Carousel_Setting {

    private $settings_api;

    function __construct() {
        $this->settings_api = new Mage_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'Mage Carousel', 'Mage Carousel', 'delete_posts', 'mage_carousel_settings', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(

            array(
                'id'    => 'mps_carousel',
                'title' => __( 'Mage Carousel', 'mps' )
            ),                                       
            array(
                'id'    => 'mps_custom_css',
                'title' => __( 'Custom CSS', 'mps' )
            )

        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(

            'mps_Carousel' => array(

                array(
                    'name'    => 'mps_autoplay',
                    'label'   => __( 'Auto play', 'mps' ),                    
                    'type'    => 'select',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false' => 'No'
                        )
                ),

                array(
                    'name'    => 'mps_speed',
                    'label'   => __( 'Carousel Speed', 'mps' ),
                    'type'    => 'number',
                    'default'    => '500',
                ), 
                
                array(
                    'name'    => 'mps_delay',
                    'label'   => __( 'Carousel Delay', 'mps' ),
                    'type'    => 'number',
                    'default'    => '5000',
                ),   
                              
                array(
                    'name'    => 'mps_width',
                    'label'   => __( 'Carousel Width', 'mps' ),
                    'type'    => 'text',
                    'default'    => '100%',
                ), 
                array(
                    'name'    => 'mps_height',
                    'label'   => __( 'Carousel Height', 'mps' ),
                    'type'    => 'text',
                    'default'    => '400px',
                ),  

                array(
                    'name'    => 'mps_title_color',
                    'label'   => __( 'Carousel Title Color', 'mkb' ),
                    'type'    => 'color',
                    'default' => '#fff'
                ),
                array(
                    'name'    => 'mps_text_color',
                    'label'   => __( 'Carousel Text Color', 'mkb' ),
                    'type'    => 'color',
                    'default' => '#fff'
                ),   
 

                array(
                    'name'    => 'mps_overly_color',
                    'label'   => __( 'Carousel Overlay Color', 'mkb' ),
                    'type'    => 'color',
                    'default' => '#333333'
                ),                                            
                array(
                    'name'    => 'mps_overlay_opecity',
                    'label'   => __( 'Overlay Opecity', 'mps' ),                    
                    'type'    => 'select',
                    'default' => '0.5',
                    'options' => array(
                        '0.1' => '0.1',
                        '0.2' => '0.2',
                        '0.3' => '0.3',
                        '0.4' => '0.4',
                        '0.5' => '0.5',
                        '0.6' => '0.6',
                        '0.7' => '0.7',
                        '0.8' => '0.8',
                        '0.9' => '0.9',
                        '1' => '1',
                        )
                ),

            ),           
            'mps_custom_css' => array(




            )

        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';
                $this->settings_api->show_navigation();
                $this->settings_api->show_forms();
        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
new Mage_Carousel_Setting();
endif;


function mpc_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}