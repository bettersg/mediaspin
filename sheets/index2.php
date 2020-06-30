<?php

require_once 'vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('mediaspin');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('keys/linen-shape-235814-8f56fff7fca3.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = "1UFxBBWljwEjL26PeS0is0bHMFKE0N_xLa_DmI9jngAE";

// print results 
$range = 'issues!A2:H12';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if (empty($values)) {
   print 'No data found.\n';
} else {
    foreach ($values as $value) {
        echo $value[0] ;
        echo $value[1] ;
        echo $value[2] ;
        
        echo '<hr>';
    }
}
/*
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if (empty($values)) {
   print 'No data found.\n';
} else {
    $jsonData = json_encode($values, JSON_PRETTY_PRINT);
    echo '<pre>';
    print_r($jsonData);
    echo '</pre> <hr>';  
}
*/

// update cell

$range = 'issues!C3:D3';
$values = [
    ['ABCDEF123', ' hello world'],
];
$body = new Google_Service_Sheets_ValueRange([   
    'values' => $values 
]);
$params = [    
    'valueInputOption' => "RAW" 
];

$result = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);

// add new row 


$range = 'issues';
$values = [
    ['1', 'today', 'title of new row'],
];
$body = new Google_Service_Sheets_ValueRange([   
    'values' => $values 
]);
$params = [    
    'valueInputOption' => "RAW" 
];
$insert = [
    "insertDataOption" => "INSERT_ROW"
];

$result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params,$insert);


 

 
/*

$range = 'issues!A:E';
$values = [    ["a", "b", "C", "D", "E"]   ];
$body = new Google_Service_Sheets_ValueRange([    'values' => $values ]);
$params = [    'valueInputOption' => "RAW" ];
$result = $service->spreadsheets_values->append($spreadsheet_id, $range, $body, $params);

$client = getClient();
$service = new Google_Service_Sheets($client);

// The ID of the spreadsheet to update.
// $spreadsheetId = 'my-spreadsheet-id';  // TODO: Update placeholder value.

// The A1 notation of a range to search for a logical table of data.
// Values will be appended after the last row of the table.
$range = 'my-range';  // TODO: Update placeholder value.

// TODO: Assign values to desired properties of `requestBody`:
$requestBody = new Google_Service_Sheets_ValueRange();

$response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody);

// TODO: Change code below to process the `response` object:
echo '<pre>', var_export($response, true), '</pre>', "\n";

function getClient() {
  // TODO: Change placeholder below to generate authentication credentials. See
  // https://developers.google.com/sheets/quickstart/php#step_3_set_up_the_sample
  //
  // Authorize using one of the following scopes:
  //   'https://www.googleapis.com/auth/drive'
  //   'https://www.googleapis.com/auth/drive.file'
  //   'https://www.googleapis.com/auth/spreadsheets'
  return null;
}

*/

/*


$range = 'issues!C12';
$body = new Google_Service_Sheets_ValueRange([
    'values' => 'YOUR_VALUE'
]);
$params = [
    'valueInputOption' => 'USER_ENTERED'
];
$result = $service->spreadsheets_values->update($spreadsheetId, $range,$body, $params);



$range = 'issues';
$values = [
    [
       ' some Cell values ...'
    ],
    [ ' more Cell values'
    ]
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);
$params = [
    'valueInputOption' => $valueInputOption
];
$result = $service->spreadsheets_values->update($spreadsheetId, $range,$body, $params);
printf("%d cells updated.", $result->getUpdatedCells());

*/

?>

hello