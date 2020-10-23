<?php 
function binSearchInFile(string $fileName, string $key): ?string {
	$file = new SplFileObject($fileName, 'r');
    $file->seek($file->getSize());
    $end = $file->key();
    $start = 0;
	
    while($end >= $start){
        $mid = floor(($start + $end) / 2);
        $file->seek($mid);
        $currentLine = $file->current();
        $currentArr = explode("\t", $currentLine);
        $comp = strnatcmp($currentArr[0], $key);
		
		switch ($comp) {
			case 1 : 
				$end = $mid - 1;
				break;
			case -1 :
				$start = $mid + 1;
				break;
			case 0 : 
				return $currentArr[1];
		}
    }
	return null;
}