<?php 
/*

!!XML - CALLING PHP FUNCTIONS FROM XSLT STYLESHEETS!!

> want to call PHP functions from within an XSLT stylesheet

*/


/*Invoke the XSLTProcessor::registerPHPFunctions() method to enable this functionality*/
$xslt = new XSLTProcessor();
$xslt->registerPHPFunctions();

/*And use the function() or functionString() function within your stylesheet*/
?>

<?xml version="1.0" ?>

<xsl:stylesheet version="1.0"
        xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
        xmlns:php="http://php.net/xsl"
        
    xsl:extension-element-prefixes="php">
        <xsl:template match="/">
        	<xsl:value-of select="php:function('strftime', '%c')" />
        </xsl:template>
</xsl:stylesheet>

<?php 
/*XSLT parameters are great when you need to communicate from PHP to XSLT. However, they’re not very useful when you require the reverse*/

/*Fortunately, there’s a method that implements this functionality: registerPHPFunc tions(). Here’s how it’s enabled*/
$xslt = new XSLTProcessor();
$xslt->registerPHPFunctions();

/*This allows you to call any PHP function from your stylesheets. It’s not available by default because it presents a 
security risk if you’re processing stylesheets controlled by other people*/


/*Both built-in and user-defined functions work. Inside your stylesheet, you must define
a namespace and call the function() or functionString() methods*/
?>

<?xml version="1.0" ?>

<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:php="http://php.net/xsl"

xsl:extension-element-prefixes="php">
    <xsl:template match="/">
    	<xsl:value-of select="php:function('strftime', '%c')" />
    </xsl:template>
</xsl:stylesheet>

<?php 
/*At the top of the stylesheet, define the namespace for PHP: http://php.net/xsl. This example sets the namespace 
prefix to php. Also, set the extension-elementprefixes value to php so XSLT knows these are functions*/


/*This example uses the stylesheet, stored as strftime.xsl, to process a single-element XML document*/
$dom = new DOMDocument;
$dom->loadXML('<blank/>');

$xsl = new DOMDocument;
$xsl->load(__DIR__ . '/strftime.xsl');

$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);
$xslt->registerPHPFunctions();

print $xslt->transformToXML($dom);



/*You can also return DOM objects - This takes the XML address book and mangles all the email addresses 
to turn the hostname portion into three dots. Everything else in the document is left untouched*/
/*Spam protecting email addresses*/
function mangle_email($nodes) {
	return preg_replace('/([^@\s]+)@([-a-z0-9]+\.)+[a-z]{2,}/is', '$1@...', $nodes[0]->nodeValue);
}

$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xsl = new DOMDocument;
$xsl->load(__DIR__ . '/mangle-email.xsl');

$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);
$xslt->registerPhpFunctions();

print $xslt->transformToXML($dom);


/*Inside your stylesheet, create a special template for /address-book/person/email elements*/
?>

<?xml version="1.0" ?>

<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:php="http://php.net/xsl"
    xsl:extension-element-prefixes="php">

<xsl:template match="@*|node()">
    <xsl:copy>
    	<xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
</xsl:template>
<xsl:template match="/address-book/person/email">
    <xsl:copy>
    	<xsl:value-of select="php:function('mangle_email', node())" />
    </xsl:copy>
</xsl:template>
</xsl:stylesheet>


<?php 
/*When you know that you’re only interested in the text portion of a node, use the functionString() function. 
This function converts nodes to PHP strings, which allows you to omit the array access and nodeValue dereference*/
function mangle_email($email) {
	return preg_replace('/([^@\s]+)@([-a-z0-9]+\.)+[a-z]{2,}/is', '$1@...', $email);
}
// all other code is the same as before


/*The new stylesheet template for /address-book/person/email is*/
?>

<xsl:template match="/address-book/person/email">
    <xsl:copy>
    <xsl:value-of
    	select="php:functionString('mangle_email', node())" />
    </xsl:copy>
</xsl:template>