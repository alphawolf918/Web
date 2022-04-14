$(document).ready(function(){
	if(location.href.indexOf("clips") != -1){
		$('.thumbnail').click(function(){
			var $this = $(this);
			window.open($this.attr("src"));
		});
		$('.thumbnail').attr({
			"style" : "cursor: pointer;"
		});
	}
});