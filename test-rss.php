<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deprem RSS Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .info {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
        }
        .earthquake {
            background: white;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .earthquake h3 {
            margin-top: 0;
            color: #d32f2f;
        }
        .earthquake p {
            margin: 5px 0;
        }
        .magnitude {
            font-size: 24px;
            font-weight: bold;
            color: #d32f2f;
        }
        .error {
            background: #ffebee;
            border-left: 4px solid #f44336;
            padding: 15px;
            margin: 20px 0;
            color: #c62828;
        }
        .success {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            padding: 15px;
            margin: 20px 0;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <h1>🌍 Kandilli Rasathanesi Deprem RSS Test</h1>
    
    <div class="info">
        <strong>Bu sayfa Deprem RSS eklentisinin çalışmasını test eder.</strong><br>
        RSS Kaynağı: <a href="http://koeri.boun.edu.tr/rss/" target="_blank" rel="noopener noreferrer">http://koeri.boun.edu.tr/rss/</a>
    </div>

    <?php
    /**
     * Standalone test script for RSS parsing
     * This demonstrates the RSS fetching and parsing logic
     */
    
    $rss_url = 'http://koeri.boun.edu.tr/rss/';
    
    // Fetch RSS
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $rss_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'DepremRSS Test Script/1.0');
    $rss_content = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code !== 200 || empty($rss_content)) {
        echo '<div class="error">';
        echo '<strong>Hata:</strong> RSS feed alınamadı. HTTP Kodu: ' . $http_code;
        echo '</div>';
        exit;
    }
    
    echo '<div class="success">';
    echo '<strong>Başarılı:</strong> RSS feed başarıyla alındı (' . strlen($rss_content) . ' byte)';
    echo '</div>';
    
    // Parse RSS
    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($rss_content);
    
    if ($xml === false) {
        echo '<div class="error">';
        echo '<strong>Hata:</strong> XML parse edilemedi.<br>';
        foreach(libxml_get_errors() as $error) {
            echo '- ' . $error->message . '<br>';
        }
        echo '</div>';
        exit;
    }
    
    $earthquake_count = 0;
    
    if (isset($xml->channel->item)) {
        foreach ($xml->channel->item as $item) {
            $earthquake_count++;
            
            $title = (string)$item->title;
            $description = (string)$item->description;
            $link = (string)$item->link;
            $pub_date = (string)$item->pubDate;
            
            // Extract magnitude
            $magnitude = '';
            if (preg_match('/^([0-9.]+)/', $title, $matches)) {
                $magnitude = $matches[1];
            }
            
            // Extract depth
            $depth = '';
            if (preg_match('/Derinlik[:\s]*([0-9.]+)\s*km/i', $description, $matches)) {
                $depth = $matches[1];
            }
            
            // Extract coordinates
            $latitude = '';
            $longitude = '';
            if (preg_match('/Enlem[:\s]*([0-9.]+)/i', $description, $matches)) {
                $latitude = $matches[1];
            }
            if (preg_match('/Boylam[:\s]*([0-9.]+)/i', $description, $matches)) {
                $longitude = $matches[1];
            }
            
            echo '<div class="earthquake">';
            echo '<h3>' . htmlspecialchars($title) . '</h3>';
            
            if ($magnitude) {
                echo '<p><span class="magnitude">Büyüklük: ' . htmlspecialchars($magnitude) . '</span></p>';
            }
            
            if ($depth) {
                echo '<p><strong>Derinlik:</strong> ' . htmlspecialchars($depth) . ' km</p>';
            }
            
            if ($latitude && $longitude) {
                echo '<p><strong>Konum:</strong> ' . htmlspecialchars($latitude) . '°N, ' . htmlspecialchars($longitude) . '°E</p>';
            }
            
            if ($pub_date) {
                echo '<p><strong>Tarih:</strong> ' . htmlspecialchars($pub_date) . '</p>';
            }
            
            if ($description) {
                echo '<p><strong>Açıklama:</strong> ' . nl2br(htmlspecialchars($description)) . '</p>';
            }
            
            if ($link) {
                echo '<p><a href="' . htmlspecialchars($link) . '" target="_blank" rel="noopener noreferrer">Detaylar</a></p>';
            }
            
            echo '</div>';
            
            // Limit to 10 items for display
            if ($earthquake_count >= 10) {
                break;
            }
        }
        
        echo '<div class="success">';
        echo '<strong>Toplam ' . min($earthquake_count, 10) . ' deprem gösteriliyor.</strong>';
        echo '</div>';
    } else {
        echo '<div class="error">';
        echo '<strong>Hata:</strong> RSS feed\'de deprem verisi bulunamadı.';
        echo '</div>';
    }
    ?>
    
    <div class="info">
        <strong>Not:</strong> Bu test sayfası WordPress olmadan çalışır ve eklentinin RSS parsing mantığını gösterir.
    </div>
</body>
</html>
