#!/bin/bash 


#!/bin/bash
FILES=*.xml
for fullfile in $FILES
do
    echo "Processing $fullfile ..." 
 	php epi4-backup-parser.php  $fullfile 
done



