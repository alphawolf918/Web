$(document).ready(function(){
	$('.aquaButton, .hireButton').click(function(){
		var href = $(this).children().first().next().attr("href");
		if(href != null && href != undefined){
			document.location.href = href;
		}
	});

	if(document.location.href.indexOf("hire-me") != -1){
		$('#chkOver18').click(function(){
			if($(this).attr("checked") || $(this).prop("checked")){
				$('#btnSubmit').removeAttr("disabled");
				$('#btnSubmit').addClass("aquaButton");
			}else{
				$('#btnSubmit').attr("disabled","true");
				$('#btnSubmit').removeClass("aquaButton");
			}
		});
	}
	
	$('.header:before').click(function(){
		document.location = '.';
	});
});