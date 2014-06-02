<?php
	require_once 'config.php';
	require_once 'utils.php';	
	
	$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS);
	if(mysqli_connect_errno())
		die ('Failed to connect to MySql : '.mysqli_connect_error());
	

	// Get all database
	$dbres=mysqli_query($connect,'SHOW DATABASES');
	$alldatabases=array();
	while ($row = mysqli_fetch_object($dbres)){
		if(!in_array($row->Database,$database_to_ignore)){
			$alldatabases[]= $row->Database;			
		}
	}
	if(sizeof($alldatabases) ==  0)
		die ('No database found');

	// check database store directory exists or not
	if(!is_dir(DB_DIR)){
		@mkdir(DB_DIR);
	}
	
	// check whether to delete old database or not
	$dirs=array_filter(glob(DB_DIR.'*'),'is_dir');
	$total_backup=sizeof($dirs);
	$delete_old_backup=0;
	if($total_backup+1 > DB_KEEP){
		$delete_old_backup=1;
	}
	
	$basedir=DB_DIR.date('d-m-Y-H-i-s').DS;
	if(!is_dir($basedir)){
		@mkdir($basedir);
	}
	
	foreach ($alldatabases as $database){
		$bkp_filename=$database.'.sql';
		$bkp_command='mysqldump --hex-blob --routines --skip-lock-tables --log-error='.DB_DIR.'mysqldump_error.log -h '.DB_HOST.' -u'.DB_USER.' -p'.DB_PASS.' --databases '.$database.' > '.$basedir.$bkp_filename;
		exec($bkp_command,$output,$log);
	}
	
	if($delete_old_backup){
		$number_of_delete=$total_backup+1-DB_KEEP;
		usort($dirs, 'compare_time');
		for($i=0;$i<$number_of_delete;$i++){
			rrmdir($dirs[$i]);
		}
	}
	
	mysqli_close($connect);
?>