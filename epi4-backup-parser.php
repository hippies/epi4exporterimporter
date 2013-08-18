<?php
/**
 * 
 * @author Christian Bolstad
 * @version $Id$
 * @copyright Carnaby Solutions, 18 Februari, 2012
 * @package EpiserverExport
 **/
	
	// make sure that we are running in a shell and that a file name is passed as parameter
	if (PHP_SAPI !== 'cli' || !isset($argv[1])) 
	{ 	die ("Please run this tool from the command line with the synax '". $argv[0] . " INFILE.XML'\n");	} 
	
	// load the xml dump into a xml object 
	$infile = $argv[1];						
	if(!$xml=simplexml_load_file($infile)){
	    trigger_error("Error reading XML file '$infile'",E_USER_ERROR);
	}
	
	// walk trough the object, extract the pages one at the time and push them into $articles
 	$articles = array();
	foreach($xml->pages as $user)
	{
		foreach ($user->ArrayOfRawPage->RawPage as $RawPage)
		{
				$dataitem = array();			
				foreach ($RawPage->Property->RawProperty as $RawProperty)
					{						
						global $dataitem;
						$label = (string)$RawProperty->Name;					
						$dataitem[$label] = (string)$RawProperty->Value;
					}
				array_push($articles,$dataitem);			
		}				
	}
	
	// convert $articles into a JSON-encoded string and dump it into a text file 
	$articles_json = json_encode($articles);
	file_put_contents("$infile.json",$articles_json);
	
	// done! 
	echo "Done!\n";


