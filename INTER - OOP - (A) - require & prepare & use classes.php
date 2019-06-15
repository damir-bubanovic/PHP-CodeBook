<?php
/*1) require classes for the page*/
require_once("classes/html_class.inc");
require_once("classes/table_class.inc");
require_once("classes/form_class.inc");

/*2) prepare classes for use*/
$HTML	= new html("GuestBook Page");
$MyTable = new table();
$MyForm  = new form();

/*3) use methods in classes*/
?>