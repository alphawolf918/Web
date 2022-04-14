<?php
require 'functions.php';
connect();
AuthCheck(4);
#implement per-user real-time log checks..
$data = sql("SELECT userid,action,posted,id FROM userLogs ORDER BY id DESC LIMIT 1");
extract($data);
$userdata = sql("SELECT ip FROM members WHERE id = '".intval($userid)."'");
echo "(".dateFormat($posted).") ".getDisplay($data["userid"])." (".$userdata["ip"].") ".ubbc($action);
?>