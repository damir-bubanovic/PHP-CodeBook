<?php
/*

!!PRINT IN HTML!!

USAGE:
> You should call this method EVERY time you output content within HTML.
> If you allow content to be treated as HTML, you have just opened the door to bugs at a minimum, and total XSS hacks at worst.
> Don't store escaped HTML in your database; it will just make queries more annoying.
  The database should store your actual data, not its HTML representation.

TIPS & EXPLANATIONS:
*htmlspecialchars - Convert special characters to HTML entities
	> string htmlspecialchars ( string $string [, int $flags = ENT_COMPAT | ENT_HTML401 [, string $encoding = ini_get("default_charset") [, bool $double_encode = true ]]] )
	> reverse function is htmlspecialchars_decode()

	> $flags
		ENT_COMPAT	Will convert double-quotes and leave single-quotes alone.
		ENT_QUOTES	Will convert both double and single quotes.
		ENT_NOQUOTES	Will leave both double and single quotes unconverted.
		ENT_IGNORE	Silently discard invalid code unit sequences instead of returning an empty string. Using this flag is discouraged as it » may have security implications.
		ENT_SUBSTITUTE	Replace invalid code unit sequences with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD; (otherwise) instead of returning an empty string.
		ENT_DISALLOWED	Replace invalid code points for the given document type with a Unicode Replacement Character U+FFFD (UTF-8) or &#FFFD; (otherwise) instead of 
						leaving them as is. This may be useful, for instance, to ensure the well-formedness of XML documents with embedded external content.
		ENT_HTML401	Handle code as HTML 4.01.
		ENT_XML1	Handle code as XML 1.
		ENT_XHTML	Handle code as XHTML.
		ENT_HTML5	Handle code as HTML 5.
		
	> $encoding
		ISO-8859-1	ISO8859-1						Western European, Latin-1.
		ISO-8859-5	ISO8859-5						Little used cyrillic charset (Latin/Cyrillic).
		ISO-8859-15	ISO8859-15						Western European, Latin-9. Adds the Euro sign, French and Finnish letters missing in Latin-1 (ISO-8859-1).
		UTF-8	 	ASCII 							compatible multi-byte 8-bit Unicode.
		cp866		ibm866, 866						DOS-specific Cyrillic charset.
		cp1251		Windows-1251, win-1251, 1251	Windows-specific Cyrillic charset.
		cp1252		Windows-1252, 1252				Windows specific charset for Western European.
		...			...								...
		> ALERT <
			default encoding is UTF-8


The translations performed are:

'&' (ampersand) becomes '&amp;'
'"' (double quote) becomes '&quot;' when ENT_NOQUOTES is not set.
"'" (single quote) becomes '&#039;' (or &apos;) only when ENT_QUOTES is set.
'<' (less than) becomes '&lt;'
'>' (greater than) becomes '&gt;'

*/


$string = "This is some <b>bold</b> text.";
print htmlspecialchars($string, ENT_COMPAT,'ISO-8859-1', true) . '<br />';
print htmlentities($string, ENT_COMPAT,'ISO-8859-1', true);

?>