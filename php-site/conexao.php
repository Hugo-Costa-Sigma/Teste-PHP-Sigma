<?php 
$serverName = "HUGOPC\SQL";
$connectionOptions = array(
  "Database" => "Arrays",
  "Uid" => "sa",
  "PWD" => "123",
);

$conn = sqlsrv_connect($serverName, $connectionOptions);