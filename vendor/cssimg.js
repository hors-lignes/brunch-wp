function barba_cssimg_init() {
	var cssimg = document.getElementById('cssimg');
	if (cssimg) {
		var css = document.createElement('style');
		css.innerText = cssimg.innerText;
		$('.barba-container').append(css);
		$(cssimg).remove();
	}
}

function barba_cssimg_ajax(container) {
	var cssimg = $(Barba.Pjax.Dom.currentHTML).filter('#cssimg');
	if (cssimg && typeof cssimg.get == 'function' && cssimg.get(0)) {
		var css = document.createElement('style');
		css.innerText = cssimg.get(0).innerText;
		container.append(css);
	}
}
