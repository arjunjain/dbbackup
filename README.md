MySql database backup
========

PHP script to backup mysql database.

- Script create sql file for every database. 
- Configure for number of database backup to keep in system. 
- Configure list of database to exclude from backup. 

Cronjob setup
----

You can also setup cron job to backup mysql database everyday.  Add this line in crontab file 

```bash
@daily php  <PATH TO BACKUP FOLDER>/backup.php
```
