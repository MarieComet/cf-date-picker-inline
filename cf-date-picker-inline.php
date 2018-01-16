<?php
/**
* Plugin Name: CF Date Picker Inline
* Text Domain: cf-dp-inline
* Description: Add inline datepicker to Caldera Form (jQuery)
* Author: Marie Comet
* Version: 1.0.0
* Author URI: http://mariecomet.fr
* GitHub Plugin URI: https://github.com/MarieComet/cf-date-picker-inline
*/

/**
 * Full path to this directory
 *
 * Use to set path to template files
 *
 * @since 0.1.0
 */
define('CF_DP_INLINE', plugin_dir_path(__FILE__));


/**
 * Load plugin
 *
 * @since 0.1.0
 *
 * @uses 'caldera_forms_includes_complete' action
 */

add_filter( 'caldera_forms_get_field_types', 'cf_dp_inline_init_field', 15 );

/**
 * Add custom field type
 *
 * @since 0.1.0
 *
 * @uses 'caldera_forms_get_field_types' filter
 *
 * @param array $fields
 *
 * @return array
 */
function cf_dp_inline_init_field( $fields ){
    $fields[ 'date_picker_inline' ]             = array(
        'field'       => __( 'Date Picker inline', 'cf-dp-inline' ),
        'file'        => CF_DP_INLINE . 'datepicker.php',
        'description' => __( 'Inline jQuery date picker', 'cf-dp-inline' ),
        'category'    => __( 'Select', 'caldera-forms' ),
        'handler'     => 'cf_dp_inline_handler',
        'setup'       => array(
            'template' => CF_DP_INLINE . '/setup.php',
            'preview'  => CF_DP_INLINE . '/preview.php',
            'default'  => array(
                'format' => 'yy-mm-dd'
            ),
            'scripts' => array('jquery', 'jquery-datepicker'),
        ),
    );

    return $fields;
}


function cf_dp_inline_handler( $value, $field, $form ) {
    if ( $value ) {
        return $value;
    }
}
