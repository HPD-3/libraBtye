<?php
if (!isset($_GET['query'])) {
    echo json_encode(["error" => "Missing query."]);
    exit;
}

$query = urlencode($_GET['query']);
$url = "https://www.googleapis.com/books/v1/volumes?q={$query}";
$response = file_get_contents($url);
header('Content-Type: application/json');
echo $response;
?>
