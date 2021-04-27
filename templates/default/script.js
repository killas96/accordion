function accordionToogle(el) {
	var d = document.getElementById(el.getAttribute("aria-controls")),
	hAll = document.querySelectorAll('#accordion_ .panel-element .panel-title a'),
	dAll = document.querySelectorAll('#accordion_ .panel-element .panel-collapse');
	console.log("test" + el.getAttribute("class"))
	if(el.getAttribute("class") == "") {
		el.setAttribute("class", "collapsed");
		d.classList.add('collapse');
	} else {
		el.setAttribute("class", "");
		d.classList.remove('collapse');
	}
}