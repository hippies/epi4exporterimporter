#!/bin/bash 


#!/bin/bash
FILES=*.epi4
for fullfile in $FILES
do
    echo "Processing $fullfile file..."
	filename=$(basename "$fullfile")
	extension="${filename##*.}"
	filename="${filename%.*}"
 	
 	echo mono ../EPi4Decrypt.exe $fullfile ${filename}.zip 
 	mono ../EPi4Decrypt.exe $fullfile ${filename}.zip 
 	unzip ${filename}.zip 
 	mv Data ${filename}.xml
   # take action on each file. $f store current file name
   #  cat $f
done



