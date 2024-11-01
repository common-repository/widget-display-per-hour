jQuery(document).ready(function($) {

	$('.tutocms-widget').jqte();
	$( document ).ajaxComplete(function() {
		$('.tutocms-widget').jqte();
	});





	jQuery('.image-upload').click(function() {

		window.send_to_editor = function(html) {

			imgurl = jQuery('img', html).attr('src');
			jQuery('.upload-image').val(imgurl);
			tb_remove();

		}

		post_id = jQuery('#post_ID').val();
		tb_show('', 'media-upload.php?post_id='+post_id+'&type=image&TB_iframe=true');
		return false;

	});



});

