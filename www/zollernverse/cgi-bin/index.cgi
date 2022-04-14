#!/usr/local/bin/perl

$str = "This is a string!";
@someThingsToSay = ($str,"Hello world!");
print "Content-type: text/html\n\n";
print "<html>";
print "<head>";
print "<title>First CGI</title>";
print "</head>";
print "<body>";
print @someThingsToSay;
print "</body>";
print "</html>";