<?php 


function import_epi_exporter_xml($filename)
{
		if (file_exists($filename)) {
	    $xml = simplexml_load_file($filename);
	 	} else {
	    exit('Failed to open ' . $filename);
	}

	return $xml;
}

/*
echo "Here we go!\n";
$xml  = import_epi_exporter_xml('ExportedFile_Farsta_scoutkar_NOfiles.xml');
echo "import done!\n";
print_r($xml);

*/


function import_epi_exporter_json($filename)
{

		if (file_exists($filename)) {
	    $json = json_decode(file_get_contents($filename));
	 	} else {
	    exit('Failed to open ' . $filename);
	}

	return $json;
}


function parse_kar_json($json)
{
	$kardata = array();
	$startpage = '';
	$parents = array();
	foreach ($json as $page)
	{
#		print $page->PageTypeName ."\n";
		if ($page->PageTypeName == 'Startsida')
		{
			$startpage = $page->PageLink; 
		}
		$kardata[$page->PageLink] = $page; 	
		if (!in_array($page->PageParentLink, $parents))	
				$parents[] = $page->PageParentLink;
	}
	if ($startpage)
	{
	echo "Startsida: " . $startpage . "\n";
	print_r($parents);
	}
	else
	{
		echo "Naaah, could not find any startpage!\n";
	}

#	print_r($kardata);
}

$json = import_epi_exporter_json('ExportedFile_Farsta_scoutkar_files_global_kopplade.xml.json');

#print_r($json);
#
parse_kar_json($json);


