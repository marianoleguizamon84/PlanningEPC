<?php

// $Id: config.inc.php 2211 2011-12-24 09:27:00Z cimorrison $

/**************************************************************************
 *   MRBS Configuration File
 *   Configure this file for your site.
 *   You shouldn't have to modify anything outside this file
 *   (except for the lang.* files, eg lang.en for English, if
 *   you want to change text strings such as "Meeting Room
 *   Booking System", "room" and "area").
 **************************************************************************/

/**********
 * Timezone
 **********/

// The timezone your meeting rooms run in. It is especially important
// to set this if you're using PHP 5 on Linux. In this configuration
// if you don't, meetings in a different DST than you are currently
// in are offset by the DST offset incorrectly.
//
// Note that timezones can be set on a per-area basis, so strictly speaking this
// setting should be in areadefaults.inc.php, but as it is so important to set
// the right timezone it is included here.
//
// When upgrading an existing installation, this should be set to the
// timezone the web server runs in.  See the INSTALL document for more information.
//
// A list of valid timezones can be found at http://php.net/manual/timezones.php
// The following line must be uncommented by removing the '//' at the beginning
$timezone = "America/Argentina/San_Luis";


/*******************
 * Database settings
 ******************/
// Which database system: "pgsql"=PostgreSQL, "mysql"=MySQL,
// "mysqli"=MySQL via the mysqli PHP extension
$dbsys = "mysql";
// Hostname of database server. For pgsql, can use "" instead of localhost
// to use Unix Domain Sockets instead of TCP/IP.
$db_host = "localhost";
// Database name:
$db_database = "planningfc_qa_db";
// Database login user name:
$db_login = "PlannFC_QAUser";
// Database login password:
$db_password = 'UAplanningfc.125';
// Prefix for table names.  This will allow multiple installations where only
// one database is available
$db_tbl_prefix = "mrbs_";
// Uncomment this to NOT use PHP persistent (pooled) database connections:
// $db_nopersist = 1;


/* Add lines from systemdefaults.inc.php and areadefaults.inc.php below here
   to change the default configuration. Do _NOT_ modify systemdefaults.inc.php
   or areadefaults.inc.php.  */

$mrbs_company = "Universidad Austral";
$weekstarts = 1;
$hidden_days = array(0);
$dateformat = 1;
$default_view = "week";
$auth["type"] = "db";
$mrbs_company_logo = "EPC-Logo.png";
$mrbs_company = "Universidad Austral";
$mrbs_company_url = "http://www.austral.edu.ar/posgrados-comunicacion/";

$mrbs_admin = "Mariano Leguizamon";
$mrbs_admin_email = "mleguizamon-cronon@austral.edu.ar";

#$select_options ['entry.description'] = array('Alejandra', 'Tito');

#Las letras "E" e "I" estan en el archivo systemdefaults.inc.php. Tiraba error cuando las pase a este archivo.
$booking_types[] = "A";
$booking_types[] = "B";
// $booking_types[] = "C";
$booking_types[] = "D";
// $booking_types[] = "F";
$booking_types[] = "G";
$booking_types[] = "H";
$booking_types[] = "J";
$booking_types[] = "K";


//$vocab_override["en"]["type.J"] ="Clubes";

$default_description = "Docente: ";
?>
