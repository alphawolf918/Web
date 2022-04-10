var memory = [];

$('.zml, x-zml').each(function(){

	var $t = $(this);
	var $h = $t.html();
	
	//{{req}}
	var req = $h.replace(/\{\{req\}\}/i, "<span style=\"color: #f00;\">*</span>");
	$t.html(req);
	
	$t = $(this);
	$h = $t.html();
	
	//{{top}}
	var toTop = $h.replace(/\{\{top\}\}/i, "<a href=\"#top\">Back to Top</a>");
	$t.html(toTop);
	
	$t = $(this);
	$h = $t.html();
	
	//{{def:var="value"}}
	if($h.match(/\{\{defvar:(.*?)=(.*?)\}\}/i)){
		var theVar = RegExp.$1;
		var theVal = RegExp.$2;
		memory[theVar] = theVal;
		var $defVar = $h.replace(/\{\{defvar:(.*?)=(.*?)\}\}/i, "");
		$t.html($defVar);
	}
	
	$t = $(this);
	$h = $t.html();
	
	//{{var:x}}
	if($h.match(/\{\{var:(.*?)\}\}/i)){
		var theVal = memory[RegExp.$1];
		theVal = (theVal == undefined) ? "Variable Unrecognized" : theVal;
		var $var = $h.replace(/\{\{var:(.*?)\}\}/i, theVal);
		$t.html($var);
	}
	
	$t = $(this);
	$h = $t.html();
});