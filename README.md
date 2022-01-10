# Tiny PHP Mvc Framework

  A tiny MVC written in PHP Programming language with folder structure similar to CodeIgniter framework.

#Disclaimer

  It's not advisable to apply it for live projects, as i developed it to learn better Mvc.


#Getting Started

  Copy the project in your folder and install the database dump in your PhpMyAdmin. Follow the instructions to complete the installation.

#Prerequisites

    Apache Server
    PHP 5.6+
    Mysql Database
    
    
#Config File

  Modify the app/config/config.php file according to your needs. You can use example.config.php file inside the same folder as an example based on my local settings.

  //Database Configuration
  define('DB_HOST', '<databaseHost>');
  define('DB_USER', '<databaseUser>');
  define('DB_PASS', '<databasePassword>');
  define('DB_NAME', '<databaseName>');

  Modify it like this

  //Database Configuration
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'tiny_mvc');

#htaccess file

  Modify che .htaccess file inside the public folder to match the name of your installation folder


#Install the Database

  Create a database of your choice in PhpMyAdmin and import the tiny_mvc.sql file in it.
  
