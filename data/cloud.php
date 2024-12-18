<?php

// This script is responsible for taking a query from the user and generating
// a JSON array containing the data necessary for the cloud view.
//
// The results are based on the following fields in the GET data:
//      query - The text that the user is searching for.  This text will
//          be split on non-word characters and then stemmed.
//      location - A place ID.  If given and not -1, results will only be
//          returned if they were either sent from or to the specified location
//

session_start();

require_once '../vendor/autoload.php';
include '../php/porterStemmer.php';
include_once '../php/database.php';
include '../data/query.php';
include '../php/env.php';

$database = connectToDB();



function buildTextLink($text) {
  $new_params = $_GET;
  $new_params['query'] = $new_params['query'] . ' ' . $text;
  return 'search.php?' . http_build_query($new_params);
}

//Text Cloud
$sql = buildWordCloudSearchQuery();

$jsonOut = array();
$docData = array();
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die($sql . "<br>" . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
while ($row = mysqli_fetch_assoc($result))
{
    $row['link'] = buildTextLink($row['text']);
    array_push($docData, $row);
}
array_push($jsonOut, $docData);

//Place Cloud
$sql = buildPlaceCloudSearchQuery();

$docData = array();
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die($sql . "<br>" . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
while ($row = mysqli_fetch_assoc($result))
{
    $row['link'] = buildTextLink($row['text']);
    array_push($docData, $row);
}
array_push($jsonOut, $docData);

//Person Cloud
$sql = buildPersonCloudSearchQuery();
$docData = array();
$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die($sql . "<br>" . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
while ($row = mysqli_fetch_assoc($result))
{
    $row['link'] = buildTextLink($row['text']);
    array_push($docData, $row);
}
array_push($jsonOut, $docData);
print json_encode($jsonOut);

?>



