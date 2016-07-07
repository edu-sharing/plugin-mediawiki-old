$(document).ready(function() {

	$.ajaxSetup({ cache: false });
	
	function renderEsObject(esObject, wrapper) {
		var url = esObject.attr("data-url");
		if(typeof wrapper == 'undefined')
			var wrapper = esObject.parent();

		$.get(url, function(data) {
			wrapper.html('').append(data);
			if (data.toLowerCase().indexOf('data-view="lock"') >= 0)
				setTimeout(function(){ renderEsObject(esObject, wrapper);}, 1111);
		});
		
		$('.edu_wrapper').css({width: 'auto', height: 'auto'});
		esObject.removeAttr("data-type");
	}
	
	$("[data-type='esObject']:near-viewport(400)").each(function() {
		renderEsObject($(this));
	});

	$(window).scroll(function() {
		$("[data-type='esObject']:near-viewport(400)").each(function() {
			renderEsObject($(this));
		});
	});
});