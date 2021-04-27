function accordionToogle(el) {
	var d = document.getElementById(el.getAttribute("aria-controls")),
	hAll = document.querySelectorAll('#accordion_ .panel-element .panel-title a'),
	dAll = document.querySelectorAll('#accordion_ .panel-element .panel-collapse');
	for(var i=0; i<hAll.length; i++){
		hAll[i].setAttribute("class", "collapsed");
		//dAll[i].style.display = "none";

		dAll[i].classList.add('collapse');
	}
	el.setAttribute("class", "");
	//d.style.display = "block";
	d.classList.remove('collapse');
}