<?php
define('DB_HOST','localhost');  			 // Database hostname
define('DB_USER','root');       			 // Database Username
define('DB_PASS','');					 // Database Password
define('DB_DIR','/home/geekpoint/backup/');  // Full Path to directory when backup file store. Should have write permission.
define('DB_KEEP',2);   						 // Number of database backup to store
define('DS', DIRECTORY_SEPARATOR);
$database_to_ignore=array('information_schema','mysql','performance_schema');
