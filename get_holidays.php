<?php
// Güvenlik kontrolü
if (!isset($_GET['start']) || !isset($_GET['end'])) {
    http_response_code(400);
    echo json_encode(['error' => "start ve end parametreleri gerekli. Örn: ?start=2025-01-01&end=2025-12-31"]);
    exit;
}

$startDate = $_GET['start'];
$endDate = $_GET['end'];
$apiKey = 'YOUR_GOOGLE_API_KEY'; // 🔐 Google API Key buraya

$calendarId = 'turkish__tr@holiday.calendar.google.com';
$url = "https://www.googleapis.com/calendar/v3/calendars/$calendarId/events?key=$apiKey&timeMin=" . urlencode($startDate . 'T00:00:00Z') . "&timeMax=" . urlencode($endDate . 'T23:59:59Z');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$results = [];

if (isset($data['items'])) {
    foreach ($data['items'] as $item) {
        $results[] = [
            'summary' => $item['summary'] ?? '',
            'start' => $item['start']['date'] ?? '',
            'end' => $item['end']['date'] ?? '',
        ];
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
