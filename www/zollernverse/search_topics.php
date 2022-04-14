<?oho
require "functions.php";
onlineCheck();
if(!isset($_POST["sf"]) OR !isset($_POST["sc"])) 
	invData();
$queryStart = "SELECT * FROM topics WHERE ";
$queryEnd = " LIKE '%".sqlEsc($_POST["sf"])."%' ORDER BY subject ASC";
switch(sqlEsc($_POST["sc"])){
	case 'subject':
		$query = $queryStart . " subject " . $queryEnd
	break;
	case 'tag':
		
	break;
}
?>