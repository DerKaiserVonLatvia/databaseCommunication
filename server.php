<?php
error_reporting(E_ALL & ~E_NOTICE);
define("DB_HOST", "localhost");
define("DB_NAME", "jauniesu_centrs");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "password");


$a=$_POST;

function responseDBfetch()
{

  $pdo;
  try {
    $pdo = new PDO(
      "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, 
      DB_USER, DB_PASSWORD
    );
  } catch (Exception $ex) { exit($ex->getMessage()); }

  $stmt = $pdo->prepare("SELECT * FROM `events`");
  $stmt->execute();
  $table = $stmt->fetchAll();
  $retVal="";
  foreach ($table as &$row)
  {
    foreach ($row as &$col)
    {
      $retVal = $retVal . ($col."\n");
    }
  }
  return $retVal;
};


function writeToDB($data)
{
  $pdo;
  try {
    $pdo = new PDO(
      "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET . ";dbname=" . DB_NAME, 
      DB_USER, DB_PASSWORD
    );
  } catch (Exception $ex) { exit($ex->getMessage()); }

  $org=$data["org_name"];
  $evnt=$data["event_name"];
  $cont=$data["contacts"];
  $start=$data["start_date"];
  $end=$data["end_date"];
  echo($start);
  //echo("insert into events(org_name, event_name, contacts, start_date, end_date)
  //values({$org}, {$evnt}, {$cont}, {$start}, {$end});");
  $stmt = $pdo->prepare("insert into events(org_name, event_name, contacts, start_date, end_date)
  values({$org}, {$evnt}, {$cont}, {$start}, {$end});");
  $stmt->execute();
  $table = $stmt->fetchAll();
  $retVal="";
  foreach ($table as &$row)
  {
    foreach ($row as &$col)
    {
      $retVal = $retVal . ($col."\n");
    }
  }
  echo($retVal);
}

if ($a["dataSent"]=="request_DB")
{
  print_r(responseDBfetch());
}
else
{
  $sendData=[
    "org_name" => "",
    "event_name" => "",
    "contacts" => "",
    "start_date" => "",
    "end_date" => "",
  ];

  

  $allData=explode(",", $a["dataSent"]);

  for ($i=0; $i<count($allData); $i++)
  {
    echo($allData[$i]."\n");

    $divided=explode('=', $allData[$i]);
    if ($sendData[$divided[0]]!==NULL)
    {
      $sendData[$divided[0]]="'".$divided[1]."'";
    }
  }

  writeToDB($sendData);   
}
/*
create table events(
	id INT NOT NULL auto_increment,
    org_name VARCHAR(255),
    event_name VARCHAR(255),
    contacts VARCHAR(255),
    start_date datetime,
    end_date datetime,
    PRIMARY KEY (id)
);
*/
$pdo = null;
$stmt = null;
