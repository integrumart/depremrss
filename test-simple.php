<?php
/**
 * Simple RSS test script
 */

echo "Testing RSS Feed from Kandilli Observatory...\n";
echo "URL: http://koeri.boun.edu.tr/rss/\n\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://koeri.boun.edu.tr/rss/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'DepremRSS Test/1.0');
$content = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $http_code\n";

if (!empty($error)) {
    echo "CURL Error: $error\n";
    exit(1);
}

if ($http_code !== 200) {
    echo "Failed to fetch RSS feed (HTTP $http_code)\n";
    exit(1);
}

echo "Content length: " . strlen($content) . " bytes\n";

if (empty($content)) {
    echo "Empty response\n";
    exit(1);
}

// Try to parse as XML
libxml_use_internal_errors(true);
$xml = simplexml_load_string($content);

if ($xml === false) {
    echo "XML parse failed:\n";
    foreach(libxml_get_errors() as $error) {
        echo "  - " . $error->message . "\n";
    }
    exit(1);
}

echo "✓ XML parsed successfully\n\n";

if (isset($xml->channel->item)) {
    $count = count($xml->channel->item);
    echo "Found $count earthquake items\n\n";
    
    if ($count > 0) {
        echo "=== First 3 Earthquakes ===\n\n";
        
        for ($i = 0; $i < min(3, $count); $i++) {
            $item = $xml->channel->item[$i];
            $title = (string)$item->title;
            $description = (string)$item->description;
            
            echo "[$i] $title\n";
            
            // Extract magnitude
            if (preg_match('/^([0-9.]+)/', $title, $matches)) {
                echo "    Magnitude: {$matches[1]}\n";
            }
            
            // Extract depth from description
            if (preg_match('/Derinlik[:\s]*([0-9.]+)\s*km/i', $description, $matches)) {
                echo "    Depth: {$matches[1]} km\n";
            }
            
            echo "\n";
        }
    }
    
    echo "✓ RSS feed is working correctly!\n";
} else {
    echo "No items found in RSS feed\n";
    exit(1);
}
