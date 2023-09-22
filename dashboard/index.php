<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $siteURL = $data['url'];
} else {
    $siteURL = 'https://www.google.com'; 
}

function checkSiteStatus($url) {
    $startTime = microtime(true);
    $headers = @get_headers($url); 
    $endTime = microtime(true);

    $responseTime = round(($endTime - $startTime) * 1000, 2);
    $isOnline = $headers && strpos($headers[0], '200 OK') !== false;

    return [
        'status' => $isOnline ? 'online' : 'offline',
        'response_time' => $responseTime
    ];
}

$monitoringInterval = 900; 
$siteInfo = checkSiteStatus($siteURL);

header('Content-Type: application/json');
echo json_encode($siteInfo);

$logMessage = "Site: $siteURL | Status: {$siteInfo['status']} | Tempo de Resposta: {$siteInfo['response_time']} ms | Data e Hora: " . date('Y-m-d H:i:s') . PHP_EOL;
file_put_contents('monitoring_log.txt', $logMessage, FILE_APPEND);

sleep(5)
?>
