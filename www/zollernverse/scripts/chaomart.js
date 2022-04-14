$(document).ready(function(){
	$.ajaxSetup({type: "POST"});
});

function buyItem(itemID,resID){
	$(document).ready(function(){
		$('#'+resID).html("Loading..");
		$.ajax({
			url: "store.php", data: "id="+itemID,
			complete: function(data){
				$('#'+resID).parent().html(data.responseText);
			}
		});
	});
}