<?php
// Practical 5: PHP calls an Express REST API running at http://localhost:3000.
$url = 'http://localhost:3000/api/message';
$result = null;
$error = '';
if (!function_exists('curl_init')) {
    $error = 'PHP cURL extension is not enabled. Enable extension=curl in php.ini and restart Apache.';
} else {
    $ch = curl_init($url);
    curl_setopt_array($ch, [CURLOPT_RETURNTRANSFER => true, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 10]);
    $body = curl_exec($ch);
    $curlError = curl_error($ch);
    $status = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($body === false) $error = 'Could not connect to Express. Start the Node server first. Details: ' . $curlError;
    elseif ($status < 200 || $status >= 300) $error = 'Express returned HTTP status ' . $status . '. Response: ' . $body;
    else { $result = json_decode($body, true); if (!is_array($result)) $error = 'Express response was not valid JSON.'; }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><title>PHP Calls Express</title></head><body>
<h1>Practical 5: Call Express REST API in PHP</h1>
<p>Request URL: <code><?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?></code></p>
<?php if ($error !== ''): ?><p style="color:#b00020"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php else: ?><p>Response from Express API:</p><pre><?= htmlspecialchars(json_encode($result, JSON_PRETTY_PRINT), ENT_QUOTES, 'UTF-8') ?></pre><?php endif; ?>
</body></html>
