$(document).ready(function(){
	$('.nWin').click(function(){
			nWin($(this).attr('href'));
			return false;
	});
});

$(document).ready(function(){
	$("button[type=reset]").click(function(){
		return confirm('Are you sure you wish to reset?');
	});
});

$(document).ready(function(){
	if(location.href.indexOf("editprofile") != -1){
		if($('#txt2FA').val() == 'yes'){
			$('#tfa').css({
				"display" : "block"
			});
		}
	}
});