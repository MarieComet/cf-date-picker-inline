<?php
$has_lang = '';

$attrs = array(
	'type' => 'text',
	'data-provide' => 'cfdatepicker',
	'name' => $field_name,
	'value' => $field_value,
	'id' => Caldera_Forms_Field_Util::get_base_id( $field ),
	'data-field' => $field_base_id,
	'class' => $field_class . ' cfdatepicker is-cfdatepicker',
	'data-date-format' => $field['config']['format'],

);

$required = '';
if( $field_structure['field_required'] ){
	$attrs[ 'required'] = true;
	$required = 'required';
}

// prevent errors for fields of previous version
$start_end_atts = '';
if( !empty( $field['config']['start_view'] ) ){
	$attrs[  'data-date-start-view' ] = $field['config']['start_view'];
}

if( !empty( $field['config']['start_date'] ) ){
	$attrs[' data-date-start-date' ] = $field['config']['start_date'];
}
if( !empty( $field['config']['end_date'] ) ){
	$attrs[ 'data-date-end-date' ] = $field['config']['end_date'];
}
wp_enqueue_script('jquery-ui-datepicker');

if( !empty( $field['config']['language'] ) ){
	if( file_exists( CF_DP_INLINE . 'js/locales/datepicker-' . $field['config']['language'] . '.js' ) ){
		$attrs[ 'data-date-language' ] = $field['config']['language'];
		wp_enqueue_script( 'date-picker-inline-lang', plugin_dir_url(__FILE__) . 'js/locales/datepicker-' . $field['config']['language'] . '.js', array( 'jquery-ui-datepicker', Caldera_Forms_Render_Assets::field_script_to_localize_slug() ));
	}
} else {
	// default language
	$attrs[ 'data-date-language' ] = 'en-US';
}

wp_enqueue_script('dp-inline', plugin_dir_url(__FILE__) . 'js/setup.js', array('jquery', 'jquery-ui-datepicker'));

if( ! empty( $field[ 'hide_label' ] ) ) {
	if( ! empty( $field[ 'config' ][ 'placeholder' ] ) ){
		$place_holder = $field[ 'config' ][ 'placeholder' ];
	}else{
		$place_holder = $field[ 'label' ];
	}

	$attrs[ 'placeholder' ]  = Caldera_Forms::do_magic_tags( $place_holder );

}
wp_enqueue_style( 'jquery-ui', plugin_dir_url(__FILE__) . 'css/core.css');
wp_enqueue_style( 'jquery-datepicker', plugin_dir_url(__FILE__) . 'css/datepicker.css');

// check for autoclose
$is_autoclose = null;
if( !empty( $field['config']['autoclose'] ) ){
	$attrs[ 'data-date-autoclose' ] = 'true';
}
$attrs[ 'class' ] = 'cf-datepicker-inline-input';
$attr_string =  caldera_forms_field_attributes( $attrs, $field, $form );
?>

<?php echo $wrapper_before; ?>
	<?php echo $field_label; ?>
	<?php echo $field_before; ?>
	<div class="cf-date-picker-inline cfdatepicker-days ll-skin-melon"
		data-attr-input="<?php echo $attrs['id']; ?>" id="cf-date-picker-inline-<?php echo $attrs['id']; ?>">
		<input type="hidden" <?php echo  $attr_string . ' ' . $field_structure['aria'] . ' ' . $required; ?>  />
		<?php echo $field_caption; ?>
		
	</div>
	<?php echo $field_after; ?>
<?php echo $wrapper_after; ?>
