<?php
    /**
     * Making a SPARQL SELECT query
     *
     * This example creates a new SPARQL client, pointing at the
     * dbpedia.org endpoint. It then makes a SELECT query that
     * returns all of the countries in DBpedia along with an
     * english label.
     *
     * Note how the namespace prefix declarations are automatically
     * added to the query.
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    set_include_path(get_include_path() . PATH_SEPARATOR . './easyrdf-0.9.0/lib/');
    require_once "./easyrdf-0.9.0/lib/EasyRdf.php";
//    require_once "./easyrdf-0.9.0/examples/html_tag_helpers.php";

    // Setup some additional prefixes for the Drupal Site
    EasyRdf_Namespace::set('schema', 'http://schema.org/');
    EasyRdf_Namespace::set('content', 'http://purl.org/rss/1.0/modules/content/');
    EasyRdf_Namespace::set('dc', 'http://purl.org/dc/terms/');
    EasyRdf_Namespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
    EasyRdf_Namespace::set('og', 'http://ogp.me/ns#');
    EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    EasyRdf_Namespace::set('sioc', 'http://rdfs.org/sioc/ns#');
    EasyRdf_Namespace::set('sioct', 'http://rdfs.org/sioc/types#');
    EasyRdf_Namespace::set('skos', 'http://www.w3.org/2004/02/skos/core#');
    EasyRdf_Namespace::set('xsd', 'http://www.w3.org/2001/XMLSchema#');
    EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
    EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    EasyRdf_Namespace::set('rss', 'http://purl.org/rss/1.0/');
    EasyRdf_Namespace::set('site', 'http://localhost/iksce/ns#');

    $sparql = new EasyRdf_Sparql_Client('http://localhost/drupal-7.42/sparql');
?>

<?php

// Set debug to 1 for debugging
$dbg = 1;
?>

<?php

$subjechtvar = 'http://localhost/drupal-7.42/content/owen-paterson';
$subject = '<'.$subjechtvar.'>';

echo($subject);

 // Perform SELECT query on RDF store to populate array for all triples with schema:isRelatedTo predicate
 $result = $sparql->query(
     'SELECT DISTINCT ?p ?o { '.$subject.' ?p ?o . }'
 );

// 'SELECT DISTINCT ?p ?o { <http://localhost/drupal-7.42/content/owen-paterson> ?p ?o . }'
 //'SELECT DISTINCT ?p ?o { '<'.\''.$subject.'\'.'>' ?p ?o . }'

// Initialize itermediary storage array for subject, predicate, and object from query with schema:isRelatedTo predicate
// $subarray = array();
 $predarray = array();
 $objarray = array();

// Populate the storage arrays including the schema:isRelatedTo predicate
 foreach ($result as $row) {
  //   array_push($subarray, $row->s);
     array_push($predarray, $row->p);
     array_push($objarray, $row->o);
 }

if ($dbg == 1) {
   echo ("Predicates and Objects from the ARC2 Store");
   echo("\r\n");
   foreach($predarray as $i => $value) {
//      echo $subarray[$i].' '.$predarray[$i].' '.$objarray[$i];;
     echo $predarray[$i].' '.$objarray[$i];
     echo("\r\n");
   }
}
/*
$combined_results = implode("\n",$subarray);
$fp = fopen('data.txt','w');
fwrite($fp, $combined_results);
// frwrite allows for appending of data to a file...
fclose($fp);
*/
?>
