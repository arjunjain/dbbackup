<?php
/**
 * Delete directory recursively 
 **/
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir.DS.$object) == "dir") 
					rrmdir($dir.DS.$object); 
				else 
					unlink($dir.DS.$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

/**
 * Compare file creation time and sort directory 
 */
function compare_time($a, $b)
{
	global $dir;
	$timeA = filectime("$dir/$a");
	$timeB = filectime("$dir/$b");
	if($timeA == $timeB) return 0;
	return ($timeA < $timeB) ? -1 : 1;
}