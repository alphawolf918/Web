<?php
require 'functions.php';
connect();
onlineCheck();
if(!isset($_POST["type"]) OR !isset($_POST["val"])) 
	exit("Error.");
switch($_POST["type"]){
	default:
		exit("Error.");
	break;
	case 'deposit':
		$value = intval($_POST["val"]);
		$userTokens = getTokens($_COOKIE["id"]);
		if($value > $userTokens)
			exit("You do not have that many tokens in your pocket!");
		if($value <= 0 OR $value == "")
			exit("Deposited value must be greater than zero.");
		$newBalance = $userTokens - $value;
		query("UPDATE members SET tokens = '".$newBalance."' WHERE id = '".$_COOKIE["id"]."'");
		$bankBalance = sql("SELECT balance FROM bank_accounts WHERE userid = '".$_COOKIE["id"]."'");
		$newBankBalance = $bankBalance["balance"] + $value;
		query("UPDATE bank_accounts SET balance = '".$newBankBalance."', deposits = (deposits+1), last_accessed = CURRENT_TIMESTAMP WHERE userid = '".$_COOKIE["id"]."'");
		loguser($_COOKIE["id"],"deposited $".number_format($value)." into their account.");
		echo "Deposited $".number_format($value)." into your account successfully.";
	break;
	case 'withdraw':
		$value = intval($_POST["val"]);
		$userTokens = getTokens($_COOKIE["id"]);
		$bankBalance = sql("SELECT balance FROM bank_accounts WHERE userid = '".$_COOKIE["id"]."'");
		if($value >= $bankBalance["balance"])
			exit("You do not have that many tokens in your account!");
		if($value <= 0 OR $value == "")
			exit("Withdrawn value must be greater than zero.");
		$newBalance = $userTokens + $value;
		$newBankBalance = $bankBalance["balance"] - $value;
		query("UPDATE members SET tokens = '".$newBalance."' WHERE id = '".$_COOKIE["id"]."'");
		query("UPDATE bank_accounts SET balance = '".$newBankBalance."', withdrawals = (withdrawals+1), last_accessed = CURRENT_TIMESTAMP WHERE id = '".$_COOKIE["id"]."'");
		loguser($_COOKIE["id"],"withdrew $".number_format($value)." from their account.");
		echo "Withrew $".number_format($value)." from your account successfully.";
	break;
}
?>