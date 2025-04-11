<?php

// Used for the session ID, must be unique if running more than one WebCP on a server
$cpid = 'EODB';


// Link and site name used in the header
$homeurl = 'http://localhost/';
$sitename = 'MySite';


// Website Links
$client_download = "./download"; // The download link will be the latest updated .zip file within this directory. If no files are within this directory, the default client is set to v3.x(k) download
$donationlink = ''; // Replace with your paypal/patreon donation link, leaving empty will hide the donation button
$discordinvite = ''; // Replace with your discord server invite link, leaving empty will hide the discord button


// Server details, the online list is grabbed from here
$serverhost = '127.0.0.1';
$serverport = 8078;


// Database connection info
$dbtype = 'sqlite';
$dbhost = 'localhost';
$dbuser = 'eoserv';
$dbpass = 'eoserv';
$dbname = 'eoserv';
$salt = 'ChangeMe';


//Data Files
$datafiles = 'C:/data';


// Website Config
$imgperpage = 30; //Images per database page
$template = 'eo'; // Template file to use, directory ./tpl/$template/ must exist
$phpext = '.php'; // Page file extension, keep this as .php unless you know you can change it


// Table Limits
$maxplayers = 2000; // Purely cosmetic, number of players that can be online at once
$perpage = 100; // How many items to show per page (eg. All Character list)
$topplayers = 100; // How many players are shown on the top players page
$topguilds = 100; // How many guilds are shown on the top guilds page 
$onlinecache = 60; // How many seconds to keep the online list/status cached, reducing this will increase the accuracy of the online list/status, but increase server load


// Server Data file locations - [No need to change]
$pubfiles = $$datafiles . '/pub';
$mapfiles = $$datafiles . '/maps';
$questfiles = $datafiles . '/quests';
$newsfile = $datafiles . '/news.txt';
$questext = '.eqf';


// Caching & Debugging
$dynamiccsrf = false; // Turning this on will cause HTTP 400 errors if you refresh a form, but provides a little more security
$DEBUG = false; // Print debug info at the bottom of the page (never use this on live servers)
$pubcache = true;


// Rate-limits authentication requests by IP address 
// Driver can either be 'none', 'file' or 'db' 
// DB driver requires an additional table added to the database (see install.sql) 
//$loginrate_driver = 'none'; 
//$loginrate_driver = 'file'; 
$loginrate_driver = 'file'; 


// File path for loginrate 'file' driver, requires a trailing slash 
// For privacy reasons this path shouldn't be accessible via your webserver 
$loginrate_file_path = './.htloginrate/'; 


// Database & Login config
$hash_method = 'bcrypt'; // DB server hash method [Etheos uses bcrypt rather than sha256]
$loginrate_file_salt = $salt; // Database salt set above
$loginrate_db_table = 'webcp_loginrate'; // Database table for loginrate 'db' driver 


//   Require a CAPTCHA after: 
//    - more than 5 requests in an hour 
//    - or, more than 20 requests in a day 
//   Make blank to disable. 
$loginrate_captcha = '5:3600; 20:86400'; 
//   Rejects requests after: 
//    - more than 2 requests in 10 seconds 
//    - or, more than 10 requests in 5 minutes 
//    - or, more than 100 requests in 24 hours 
$loginrate = '2:10; 10:300; 100:86400'; 
  
// List of fonts to use for CAPTCHA generation 
// Leave blank to use PHP's basic pixel font instead. 
$captcha_fonts = array( 
    '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf', 
    '/usr/share/fonts/truetype/dejavu/DejaVuSerif.ttf', 
);