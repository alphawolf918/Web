function generatePassword(){
	var symb = $('#txtSymbols').prop("checked");
	var rev = $('#txtRev').prop("checked");
	var ul = $('#txtUl').prop("checked");
	$.ajax({
		type: "POST", url: "pw.php", data: "strbase="+$('#txtBase').val()+"&length="+$('#txtLength').val()+"&symbols="+symb+"&rev="+rev+"&n="+$('#txtNumber').val()+"&ul="+ul+"&ft="+$('#txtFt').val(),
		complete: function(data){
			$('#pw').html(data.responseText);
		}
	});
}

function nmbr(){
	var nbr = $('#txtLength').val();
	var wa = $('#warning');
	$('#nmbr').html(nbr);
	if(nbr > 20){
		wa.html("<strong>Note:</strong> Some sites do not allow passwords longer than 20 characters.");
	}else if(nbr <= 12){
		wa.html("<strong>Note:</strong> It is strongly encouraged to use 13-character passwords at the least.");
	}else{
		wa.html("");
	}
}

function showSection(id){
	$('#'+id).slideToggle();
}