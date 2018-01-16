
jQuery(function($){

	$('.caldera-editor-body').on('keyup', '.cfdatepicker-set-format', function(){
		var format_field	= $(this),
			default_field	= format_field.closest('.caldera-config-field-setup').find('.is-cfdatepicker');

		default_field.data('date-format', format_field.val());

		default_field.cfdatepicker('remove');

	});
    $( document ).on( 'cf.form.init', function( e, obj ){

        var $form = $( '#' + obj.idAttr );
        var dateToday = new Date();

        //find all fields in form with field_slug class
        var $fields = $form.find( '.cf-date-picker-inline' );

        if( $fields.length ){
            $fields.each( function (i,field) {

                var field_id = $(field).attr( 'data-attr-input' );
                var alt_field = $(field).find('#'+field_id);
                var alt_format = $(alt_field).attr('data-date-format');
                var language = $(alt_field).attr('data-date-language');

                $(field).datepicker({
                    altField: alt_field,
                    altFormat: alt_format,
                    minDate: dateToday, // start today
                    beforeShowDay: $.datepicker.noWeekends, // disable weekends
                },
                $.datepicker.setDefaults($.datepicker.regional[language]))
            })
        }
    });
});