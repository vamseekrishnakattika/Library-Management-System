							LIBRARY MANAGEMENT SYSTEM
---------------------------------------------------------------------------------------------------------------------------------------

This project has a Web GUI interface. The application GUI is programmed with HTML and PHP. The database used in MySQL.

Install MAMP software which has both PHP and MySQL inbulit. 

The link for MAMP is given below. Download the appropriate one for Windows/Mac

https://www.mamp.info/en/downloads/

The components and the minimum requirements are

Apache: 2.2.31
Nginx 1.13.1
MySQL: 5.6.34
PHP: 7.1.5 & 7.0.19 (for PHP 7: Windows 7 minimum with SP1 and Windows Vista minimum with SP2)
phpMyAdmin: 4.4.15.5
Operating Systems: Windows/MAC

After installing MAMP, open MAMP.exe

Go to preferences and click on Ports tab. The Apache port should be 80 and MySQL port should be 3306. 

In the PHP tab, select PHP 7.1.5 or 7.0.19.

In the Web Server tab select Web Server as Apache.

By default Document Root is C:\MAMP\htdocs.

Click on OK and then Click on Start Servers. It will start both Apache Server and MySQL Server.

Copy all the code files into the path provided above that is C:\MAMP\htdocs.

Server name : localhost 
Username :root
Password :root
Database :librarymanagement

To setup the database use the following link.

http://localhost/phpMyAdmin/?lang=en

Click on the Database tab and click on import button

Browse for the librarymanagement.sql file which is provided in the zip folder and select it and click on Go button.

All the tables will be copied to the librarymanagement database.

Now  open any browser and access the files copied in the folder htdocs by typing localhost/'filename'

Ex. localhost/librarymanagement.html