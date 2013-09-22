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
	    $json = json_decode(file_get_contents($filename),true);
	 	} else {
	    exit('Failed to open ' . $filename);
	}

	return $json;
}

function createTree(&$list, $parent){
    $tree = array();
    foreach ($parent as $k=>$l){
        if(isset($list[$l['PageLink']])){
            $l['children'] = createTree($list, $list[$l['PageLink']]);
        }
        $tree[] = $l;
    } 
    return $tree;
}

function parse_kar_json($arr)
{

foreach ($arr as $a){
    $new[$a['PageParentLink']][] = $a;
}
$tree = createTree($new, array($arr[0]));
print_r($tree);



}

#$json = import_epi_exporter_json('ExportedFile_Farsta_scoutkar_files_global_kopplade.xml.json');
$json = import_epi_exporter_json('Birka_ExportedFile.xml.json');

#print_r($json);
#
parse_kar_json($json);


