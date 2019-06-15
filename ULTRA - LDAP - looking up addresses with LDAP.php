<?php 
/*

!!INTERNET SERVECES - LOOKING UP ADDRESSES WITH LDAP!!

> want to query an LDAP server for address information

LDAP (Lightweight Directory Access Protocol) 
> server stores directory information, such as names and addresses, and allows you to query it for results. 
	>> like a database, but optimized for storing information about people.
	>> ADVANTAGE - allows you to organize people in a hierarchical fashion. 
		>>> npr. employees may be divided into marketing, technical, and operations divisions, 

> When using LDAP, the address repository is called as a data source. 
	>> Each entry in the repository has a globally unique identifier, known as a distinguished name. 
		>>> npr. John Q. Smith, who works at Example Inc., a U.S. company => cn=John Q. Smith, o=Example Inc., c=US. 
		>>> In LDAP, cn stands for common name, o for organization, and c for country.

> You must enable PHP’s LDAP support with --with-ldap. 

> Communicating with an LDAP server requires four steps: 
	1) connecting
	2) authenticating
	3) searching records
	4) logging off


*ldap_connect - connect to an LDAP server
*ldap_bind - bind to LDAP directory
*ldap_search - search LDAP tree
*ldap_get_entries - get all result entries
*ldap_close - unbind from LDAP directory - USE ldap_unbind
*ldap_search - search LDAP tree

*/


/*Use PHP’s LDAP extension*/
$ds = ldap_connect('ldap.example.com') or die($php_errormsg);
ldap_bind($ds) or die($php_errormsg);
$sr = ldap_search($ds, 'o=Example Inc., c=US', 'sn=*') or die($php_errormsg);
$e = ldap_get_entries($ds, $sr) or die($php_errormsg);

for($i=0; $i < $e['count']; $i++) {
	print $info[$i]['cn'][0] . ' (' . $info[$i]['mail'][0] . ')<br>';
}

ldap_close($ds) or die($php_errormsg);


/*The opening transactions require you to connect to a specific LDAP server 
and then authenticate yourself in a process known as binding*/
$ds = ldap_connect('ldap.example.com') or die($php_errormsg);
ldap_bind($ds) or die($php_errormsg);


/*Passing only the connection handle, $ds, to ldap_bind() does an anonymous bind. To
bind with a specific username and password, pass them as the second and third parameters*/
ldap_bind($ds, $username, $password) or die($php_errormsg);


/*here’s how to find all people with a surname of Jones at company Example Inc. located in the country US*/
$sr = ldap_search($ds, 'o=Example Inc., c=US', 'sn=Jones') or die($php_errormsg);
$e = ldap_get_entries($ds, $sr) or die($php_errormsg);


/*After ldap_search() returns results, use ldap_get_entries() to retrieve the specific
data records. Then iterate through the array of entries, $e*/
for($i=0; $i < $e['count']; $i++) {
	print $e[$i]['cn'][0] . ' (' . $e[$i]['mail'][0] . ')<br>';
}

?>