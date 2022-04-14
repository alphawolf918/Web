function sendMail(){
	var $subject = $('#txtSubject').val();
	var $message = $('#txtMessage').val();
	$subject = escape($subject);
	$message = escape($message);
	location.href = 'mailto:parris.leah@gmail.com&subject='+$subject+"&body="+$message;
}