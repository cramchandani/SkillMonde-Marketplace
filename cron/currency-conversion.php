<?php

// Database connection settings
$host = 'localhost';
$username = 'skillmonde_origmarket';
$password = '0Kr#j5QIAX7r8R';
$database = 'skillmonde_origmarket';

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check for a successful connection
if ($mysqli->connect_error) {
   // die('Connection failed: ' . $mysqli->connect_error);
    die('Connection failed');
}

// Set the base and target currencies
$baseCurrency = 'USD'; // Use USD as the base currency
$targetCurrency = 'INR';

// Fetch the latest exchange rates from Open Exchange Rates API for USD as the base currency
$url = "https://openexchangerates.org/api/latest.json?app_id=06c5f37d39b0499e8dc1cb7ce2bb0042&base={$baseCurrency}";

$response = file_get_contents($url);

if ($response === false) {
    die('Failed to fetch exchange rates from the API');
}

$data = json_decode($response, true);

if (!isset($data['rates'][$targetCurrency])) {
    die('Invalid API response');
}

// Get the exchange rate for USD to INR
$exchangeRate = $data['rates'][$targetCurrency];

$dollarRate = 1 / $exchangeRate;
// Update the currency conversion rate in the database
$sql = "UPDATE `currency_conversion` SET `base_value` = 1, `target_value` = $dollarRate, `updated_at`=NOW() WHERE `id`=1";

if ($mysqli->query($sql) === true) {
    echo 'successful';
} else {
  //  echo 'Error updating currency conversion rate: ' . $mysqli->error;
    echo 'Something Went Wrong ';
}

// Close the database connection
$mysqli->close();

//echo $dollarRate;
//echo $baseCurrency;
//echo $targetCurrency;

?>
