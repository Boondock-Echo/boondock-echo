<?php

include "_config.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$target_dir = $uploadFolder . basename($_FILES["audioFile"]["name"]) . "/";
$datum = mktime(date('H') + 0, date('i'), date('s'), date('m'), date('d'), date('y'));
$target_file = $target_dir . date('Y_m_d_H_i_s', $datum) . ".wav";
$uploadOk = 1;
$audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$directoryName = $uploadFolder . basename($_FILES["audioFile"]["name"]);

$mac =  basename($_FILES["audioFile"]["name"]);

$errorMessage = "";


// Check if file already exists
if (!file_exists($directoryName)) {
  mkdir($directoryName);
}


// Check if audio file is a actual audio or fake audio


// Check if file already exists
if (file_exists($target_file)) {
  $errorMessage = "File exists:";
  $uploadOk = 0;
}

$file_size = $_FILES["audioFile"]["size"];

// Check file size
if ($_FILES["audioFile"]["size"] > 50000000) {
  $errorMessage = "File Large:";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $audioFileType != "wav" && $audioFileType != "mp3" && $audioFileType != "raw"
  && $audioFileType != "wma"
) {

  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "ERR0";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["audioFile"]["tmp_name"], $target_file)) {
    $errorMessage = "OK";

    //Add to database
    echo $target_file;

    try {
        // Establish connection to database 1
        $pdo = new PDO("mysql:host=$db_host;dbname=$dbname", $db_user, $db_password);
        // Execute the stored procedure for database 1
        $sql = 'CALL add_message("' . $mac . '","' . $target_file . '",' . $file_size . ')';
        $q = $pdo->prepare($sql);
        $q->execute();

        // Establish connection to database 2
        $pdo2 = new PDO("mysql:host=$db_host;dbname=$dbname2", $db_user, $db_password);
        // Execute the prepared statement for database 2
        $sql2 = 'CALL add_message("' . $mac . '","' . $target_file . '",' . $file_size . ')';
        $q2 = $pdo2->prepare($sql2);
        $q2->execute();

        // Establish connection to database 3
        $pdo3 = new PDO("mysql:host=$db_host;dbname=$dbname3", $db_user, $db_password);
        // Execute the prepared statement for database 3
        $sql3 = 'CALL add_message("' . $mac . '","' . $target_file . '",' . $file_size . ')';
        $q3 = $pdo3->prepare($sql3);
        $q3->execute();
      }
      catch (PDOException $e)
       {
        $errorMessage = "Database insert error:";
        die("Error occurred:" . $e->getMessage());
      }
  } else {
    $errorMessage = "Error Moving file:";
  }
}
//Get the KPI's
try {

    // execute the stored procedure
    $sql = 'CALL get_device_settings( "' . $mac . '" );';

    // call the stored procedure
    $q = $pdo->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);

    $r = $q->fetch();

    $count = $q->rowCount();
    $currentDateTime = date('Y-m-d H:i:s');;

    if ($count > 0) {
      $rx_enabled = $r['rx_enabled'];
      $tx_enabled = $r['tx_enabled'];
      $speaker_out = $r['speaker_out'];
      $silence = $r['silence'];
      $audio_trigger = $r['audio_trigger'];
      $volume = $r['volume'];
      $max_recording = $r['max_recording'];
      $min_recording = $r['min_recording'];
      $data = array(
        "tm" => "$currentDateTime", "rx" => $rx_enabled, "tx" => $tx_enabled, "so" => $speaker_out,
        "si" => $silence, "at" => $audio_trigger, "vo" => $volume, "mx" => $max_recording, "mi" => $min_recording
      );
    } else {
      $rx_enabled = 1;
      $tx_enabled = 0;
      $speaker_out = 0;
      $silence = 50;
      $audio_trigger = 50;
      $volume = 50;
      $max_recording = 50;
      $min_recording = 5;

      $data = array(
        "tm" => "$currentDateTime", "rx" => $rx_enabled, "tx" => $tx_enabled, "so" => $speaker_out,
        "si" => $silence, "at" => $audio_trigger, "vo" => $volume, "mx" => $max_recording, "mi" => $min_recording, "de" => "True"
      );
    }
  } catch (PDOException $e) {
    echo "Error";
    die("Error occurred:" . $e->getMessage());
  }


$resp = json_encode($data);
echo $resp;
