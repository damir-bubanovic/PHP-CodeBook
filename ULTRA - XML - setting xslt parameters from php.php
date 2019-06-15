<?php 
/*

!!XML - SETTING XSLT PARAMETERS FROM PHP!!

> want to set parameters in your XSLT stylesheet from PHP

*/


/*Use the XSLTProcessor::setParameter() method*/
// This could also come from $_GET['city'];
$city = 'San Francisco';

$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xsl = new DOMDocument;
$xsl->load(__DIR__ . '/stylesheet.xsl');

$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);
$xslt->setParameter(NULL, 'city', $city);

print $xslt->transformToXML($dom);

/*This code sets the XSLT city parameter to the value stored in the PHP variable $city*/

/*You can pass data from PHP into your XSLT stylesheet with the setParameter() method.
This allows you to do things such as filter data in your stylesheet based on user input*/


/*this program allows you to find people based on their city*/
// This could also come from $_GET['city'];
$city = 'San Francisco';

$dom = new DOMDocument;
$dom->load(__DIR__ . '/address-book.xml');

$xsl = new DOMDocument;
$xsl->load(__DIR__ . '/stylesheet.xsl');

$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);
$xslt->setParameter(NULL, 'city', $city);

print $xslt->transformToXML($dom);

/*program uses the following stylesheet*/
?>

<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    
<xsl:template match="@*|node()">
    <xsl:copy>
    	<xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
</xsl:template>
    <xsl:template match="/address-book/person">
    <xsl:if test="city=$city">
        <xsl:copy>
        	<xsl:apply-templates select="@*|node()"/>
        </xsl:copy>
    </xsl:if>
    </xsl:template>
</xsl:stylesheet>

<?php 
/*The program and stylesheet combine to produce the following results*/
?>

<?xml version="1.0"?>
<address-book>
    <person id="2">
        <!--Adam Trachtenberg-->
        <firstname>Adam</firstname>
        <lastname>Trachtenberg</lastname>
        <city>San Francisco</city>
        <state>CA</state>
        <email>amt@php.net</email>
    </person>
</address-book>