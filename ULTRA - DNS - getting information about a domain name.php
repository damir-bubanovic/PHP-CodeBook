<?php 
/*

!!DNS - GETTING INFORMATION ABOUT A DOMAIN NAME!!

> want to look up contact information or other details about a domain name

*preg_match - searches subject for a match to the regular expression given in pattern

*/


/*Use PEAR’s Net_Whois class*/
require 'Net/Whois.php';

$server = 'whois.godaddy.com';
$query = 'oreilly.com';

$whois = new Net_Whois();
$data = $whois->query($query, $server);


/*The Net_Whois::query() method returns a large text string whose contents reinforce
how hard it can be to parse different Whois results - OUTPUT*/
?>

Domain Name: OREILLY.COM
Registrar URL: http://www.godaddy.com
Updated Date: 2013-04-22 17:52:42
Creation Date: 1997-05-26 23:00:00
Registrar Expiration Date: 2014-05-25 23:00:00
Registrar: GoDaddy.com, LLC
Registrant Name: O'Reilly Media, Inc.
Registrant Organization: O'Reilly Media, Inc.
Registrant Street: 1005 Gravenstein Highway North
Registrant City: Sebastopol
Registrant State/Province: California
Registrant Postal Code: 95472
Registrant Country: United States
Admin Name: Admin Contact
Admin Organization: O'Reilly Media, Inc.
Admin Street: 1005 Gravenstein Highway North
Admin City: Sebastopol
Admin State/Province: California
Admin Postal Code: 95472
Admin Country: United States
Admin Phone: +1.7078277000
Admin Fax: +1.7078290104
Admin Email: nic-ac@oreilly.com
Tech Name: Tech Contact
Tech Organization: O'Reilly Media, Inc.
Tech Street: 1005 Gravenstein Highway North
Tech City: Sebastopol
Tech State/Province: California
Tech Postal Code: 95472
Tech Country: United States
Tech Phone: +1.7078277000
Tech Fax: +1.7078290104
Tech Email: nic-tc@oreilly.com
Name Server: NSAUTHA.OREILLY.COM
Name Server: NSAUTHB.OREILLY.COM
The data contained in GoDaddy.com, LLC's WhoIs database,
while believed by the company to be reliable, is provided "as is"
with no guarantee or warranties regarding its accuracy. This
information is provided for the sole purpose of assisting you
in obtaining information about domain name registration records.
Any use of this data for any other purpose is expressly forbidden without the
prior written permission of GoDaddy.com, LLC. By submitting an inquiry,
you agree to these terms of usage and limitations of warranty. In particular,
you agree not to use this data to allow, enable, or otherwise make possible,
dissemination or collection of this data, in part or in its entirety, for any
purpose, such as the transmission of unsolicited advertising and
and solicitations of any kind, including spam. You further agree
not to use this data to enable high volume, automated or robotic electronic
processes designed to collect or compile this data for any purpose,
including mining this data for your own personal or commercial purposes.
Please note: the registrant of the domain name is specified
in the "registrant" section. In most cases, GoDaddy.com, LLC
is not the registrant of domain names listed in this database.

<?php 
/*
> Different domains use different Whois servers and different Whois servers return differently formatted results. 
	>> To find the correct Whois server for a domain, start by querying against whois.iana.org. 
		>>> That server’s output will contain a line beginning with whois: which indicates the right server to use 
		for the top-level domain of the particular domain you’re interested in. 
		>>> And then you can query that server for the specific details of the domain
*/

require 'Net/Whois.php';

$query = 'oreilly.com';
$iana_server = 'whois.iana.org';

$whois = new Net_Whois();
$iana_data = $whois->query($query, $iana_server);
preg_match('/^whois:\s+(.+)$/m', $iana_data, $matches);
$tld_whois_server = $matches[1];
$tld_data = $whois->query($query, $tld_whois_server);

print $tld_data;

?>