jQuery(document).ready(function($) {
	var data = $('.data-widget-all').attr('value');
	if (data) {
	var url = $('.data-widget-all').attr('url');
	var tiempo = new Date();
	var actual = tiempo.getHours()*3600 + tiempo.getMinutes()*60;
	console.log(data);
	$.ajax({
		data: {data:data,actual:actual},
		type:'POST',
		url:url,
		cache:false,
		success: function(response) {
		//console.log(response);
		var result = JSON.parse(response);
			if ( result!='no' ) {
            $('.title').html(result['title']);
            $('.body').html(result['text']);
        }
        }
});
	};
});