<?php 
/*

!!SESSION - CACHING CALCULATED RESULTS IN SUMMARY TABLES!!

> need to collect statistics from log tables that are too large to efficiently query in real time
> create a table that stores summary data from the complete log table, and query the summary table to generate reports in nearly real time

*strtotime - parse about any English textual datetime description into a Unix timestamp

*/


/*logging search queries that website visitors use on search engines like Google and Yahoo! to find your 
website, and tracking those queries in MySQL. Your search term tracking log table has this structure*/
?>

CREATE TABLE searches
(
    searchterm 		VARCHAR(255) NOT NULL, 		-- search term determined from
    											-- HTTP_REFERER parsing
    dt 				DATETIME NOT NULL, 			-- request date
    source 			VARCHAR(15) NOT NULL 		-- site where search was performed
);

<?php 
/*If you are fortunate enough to be logging thousands or tens of thousands of visits from the major 
search engines per hour, the searches table could grow to an unmanageable size over a period of several months*/

/*You may wish to generate reports that illustrate trends of search terms that have driven traffic to your website 
over time from each major search engine so that you can determine which search engine to purchase advertising with*/

/*Create a summary table that reflects what your report needs to display, and then query the full dataset hourly 
and store the result in the summary table for speedy retrieval during report generation*/
?>

CREATE TABLE searchsummary
(
    searchterm 		VARCHAR(255) NOT NULL, 		-- search term
    source 			VARCHAR(15) NOT NULL, 		-- site where search was performed
    sdate			DATE NOT NULL, 				-- date search performed
    searches 		INT UNSIGNED NOT NULL, 		-- number of searches
    PRIMARY KEY (searchterm, source, sdate)
);

<?php 
/*Your report generation script can then use PDO to query the searchsummary table, and if results are not available, 
collect them from the searches table and cache the result in searchsummary*/
$st = $db->prepare("SELECT COUNT (*) FROM searchsummary WHERE sdate = ?");
$st->execute(array(date('Y-m-d', strtotime('yesterday'))));

$row = $st->fetch();

// no matches in cache
if($row[0] == 0) {
	$st2 = $db->prepare("SELECT searchterm, source, date(dt) AD sdate, COUNT(*) as searches FROM WHERE date(dt) = ?");
	$st2->execute(array(date('Y-m-d', strtotime('yesterday'))));
	
	$stInsert = $db->prepare("INSERT INTO searchsummary searchterm, source, sdate, searches VALUES (?, ?, ?, ?)");
	
	while($row = $st2->fetch(PDO::FETCH_NUM)) {
		$stInsert->execute($row);
	}
}


/*Using this technique, your script will only incur the overhead of querying the full log table once, 
and all subsequent requests will retrieve a single row of summary data per search term*/
?>