<?php

/*
  Rui Santos
  Complete project details at https://RandomNerdTutorials.com/esp32-esp8266-mysql-database-php/
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.
*/

$servername = "192.168.10.15";

// REPLACE with your Database name
$dbname = "SensorData";
// Replace with your Database port
$dbport = "5432";
// REPLACE with Database user
$username = "postgres";
// REPLACE with Database user password
$password = "admin123";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $humidity = $temperature = $date_time = "";
$date_time = time();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $humidity = test_input($_POST["humidity"]);
        $temperature = test_input($_POST["temperature"]);
        $date_time = "2022-10-08 17:52:18.145";
        
        // Create connection
        $ODBCConnection = odbc_connect("DRIVER={Devart ODBC Driver for PostgreSQL};Server=" . $servername . ";Database=" . $dbname . ";Port=" . $dbport . ";String Types=Unicode", $username, $password);
        
        // Check connection
        if (!$ODBCConnection)
        {exit("Connection Failed: " . $ODBCConnection);}

        // SQL Query 
        $sql = "INSERT INTO DHTData (humidity, temperature, date_time) VALUES ('" . (string)$humidity . "', '" . (string)$temperature . "', '" . $date_time . "')";
        
        if (odbc_exec($ODBCConnection, $sql)){
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" ;
        }
    
        odbc_close($ODBCConnection);
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {
    echo "No data posted with HTTP POST." . (string) $date_time;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}