jQuery(document).ready(function($) {
	// Media Upload
	$('.media-upload-button-vc').click(function(event) {
		event.preventDefault();
		
		var post_id = $('input[name="post_ID"]').val();
		if ( ! post_id )
			post_id = '';
		
		formfield = $(this).attr('data-formfield');
		tb_show('', 'media-upload.php?post_id=' + post_id + '&TB_iframe=1&width=640&height=421');
		
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if ( formfield ) {
				var new_image = false;
				
				if ( $('img', html).attr('src') )
					new_image = $('img', html).attr('src');
				else if ( $(html, 'img').attr('src') )
					new_image = $(html, 'img').attr('src');
					
				if ( new_image ) {
					$('input#' + formfield).val(new_image);
					$('p.' + formfield).html('<img src="' + new_image + '" style="max-height:150px;width:auto;" alt="" />');
					formfield = null;
				}
				
				window.send_to_editor = window.original_send_to_editor;
				tb_remove();
			} else {
				window.original_send_to_editor(html);
			}
		}
		
	}); // end Media Upload
	
	// Manage sortable
	$('body').find('ul.multi-sortable').each(function() {
		var sortableVC = $(this);
		var savePoint;
		
		if ( $(this).attr('data-switch-case') == 'sortable-metadata' )
			savePoint = $('input[name="post_ID"]').val();
		else if ( $(this).attr('data-switch-case') == 'sortable-option' )
			savePoint = 'do-not-know-yet';
		
		$(this).sortable({
			handle:'.sort-handle',
			opacity: 0.6,
			tolerance: 'pointer',
			scroll: true,
			scrollSensitivity: 20,
			scrollSpeed: 5,
			update:function( event, ui ) {
				
				$.post(
					vcAdminAjax.ajaxurl, {
						action		: vcAdminAjax.action,
						switch_case	: $(this).attr('data-switch-case'),
						nonce  		: $(this).attr('data-nonce'),
						list 		: $(this, 'li').sortable('toArray'),
						save_name	: $(this).attr('data-save_name'),
						save_point	: savePoint
					}, function( response ) {
						if( 'success' == response.status ) {
							var i = 0;
							$(sortableVC).find('li').each(function() { // re-set id-index to retain key order
								$(this).attr('id', $(sortableVC).attr('data-save_name') + '-sort-'+i);
								$('input', this).attr('id', $(sortableVC).attr('data-save_name') + '-'+i);
								i++;
							});
						} 
					}, 'json' );
			}
			
		}); // end $(this).sortable()
		
	}); // end $('body').find('ul.multi-sortable').each(function()
	
});