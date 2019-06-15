<?php 
/*

!!DNS - PERFORMING DNS LOOKUPS!!

> want to look up a domain name or an IP address

> You can generally trust the address returned by gethostbyname(), but you can’t trust
the name returned by gethostbyaddr()

*gethostbyname - get the IPv4 address corresponding to a given Internet host name
*gethostbyaddr - get the Internet host name corresponding to a given IP address
*gethostbynamel - returns a list of IPv4 addresses to which the Internet host specified by hostname resolves

*/


/*Use gethostbyname() and gethostbyaddr()*/
$ip = gethostbyname('www.example.com');	 // 93.184.216.119
$host = gethostbyaddr('93.184.216.119');	// www.example.com


/*
> If either function can’t successfully look up the IP address or the domain name, it doesn’t
return false, but instead returns the argument passed to it. To check for failure, do this

> This assigns the return value of gethostbyname() to $ip and also checks that $ip is not
equal to the original $host
*/
$host = 'this is not a good host name!';

if ($host == ($ip = gethostbyname($host))) {
	// failure
}


/*Sometimes a single hostname can map to multiple IP addresses. To find all hosts, use
gethostbynamel()*/
$hosts = gethostbynamel('www.yahoo.com');
print_r($hosts);


/*In contrast to gethostbyname() and gethostbyaddr(), gethostbynamel() returns an
array, not a string*/

/*You can also do more complicated DNS-related tasks. For instance, you can get the MX
records using getmxrr()*/
getmxrr('yahoo.com', $hosts, $weight);

for ($i = 0; $i < count($hosts); $i++) {
	print "$weight[$i] $hosts[$i]\n";
}


/*dns_get_record() function retrieves whichever type of DNS record you specify. 
This is useful, for example, to retrieve IPv6 AAAA records, as follows*/
$addrs = dns_get_record('www.yahoo.com', DNS_AAAA);
print_r($addrs);

/*
Read the manual page for dns_get_record() to learn how to indicate which type of
DNS record you are interested in.

To perform zone transfers, dynamic DNS updates, and more, see PEAR’s Net_DNS2
package
*/

?>