#!/usr/local/bin/perl

print "Content-type: text/html\n\n";
print "<html>\n<head>\n<title>CGI Playground</title>\n</head>\n<body>\n";
@names = qw(Paul Michael John Tommy);
print "<table border='1'>";
$count = 0;
foreach $name(@names){
	print '<tr><td>'.$count.'<td>'.$name.'</td></tr>';
	$count++;
}
print "</table>";
print "\n</body>\n</html>";