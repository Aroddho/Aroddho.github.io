<?php
// Set your LimeWire API key
$apiKey = 'lmwr_sk_vrEsd1ORwp_17Z2Ouv5NoQv28jJNQgTNj5XId2kKmskiuNDZ'; // You provided this for the example

// The payload from the front end
$data = json_decode(file_get_contents('php://input'), true);

// The LimeWire API endpoint
$url = 'https://api.limewire.com/api/image/generation';

// Initialize cURL
$ch = curl_init($url);

// Setup the cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json'
));

// Execute the cURL session
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Check if there was a cURL error
if ($error) {
    echo 'cURL Error:' . $error;
} else {
    // Decode the response from LimeWire API
    $decodedResponse = json_decode($response, true);

    // Assuming the API returns a URL to the image in the response
    $imageUrl = $decodedResponse['data'][0]['url'];

    // Send back the URL to the front end
    echo json_encode(array('url' => $imageUrl));
