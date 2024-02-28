<?php
//// Envoyer l'en-tête avant toute sortie de données.
//header('Content-Type: application/json');
//function get_instagram_data() {
//    $cacheFile = 'instagram_cache.json';
//    $accessToken = 'IGQWRQRld1VG5XN2s0OXZAnek9XQVVyRWlMQUZAMNnE4UUNMd242LWZAFMjN4WmlIM0FHb09xOHpJbFpGWFhFZAWV4SFdyMUxBamVQa1BTRWFuRzVtbzZAJODlIZA2lsZAXJ3SzJUOHNXRmV4a0FSUQZDZD';
//    $userId = '5166246823500178';
//
//    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 1800) {
//        // Utilisez les données mises en cache.
//        $cachedData = file_get_contents($cacheFile);
//        return json_decode($cachedData, true);
//    } else {
//        // Effectuez une nouvelle requête à l'API Instagram.
//        try {
//            // Effectuez une nouvelle requête à l'API Instagram.
//            $apiUrl = "https://graph.instagram.com/v12.0/{$userId}/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token={$accessToken}";
//            $apiUrl = "https://graph.instagram.com/v12.0/5166246823500178/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token=IGQWRQRld1VG5XN2s0OXZAnek9XQVVyRWlMQUZAMNnE4UUNNd242LWZAFMjN4WmlIM0FHb09xOHpJbFpGWFhFZAWV4SFdyMUxBamVQa1BTRWFuRzVtbzZAJODlIZA2lsZAXJ3SzJUOHNXRmV4a0FSUQZDZD";
//            $response = file_get_contents($apiUrl);
//
//            if ($response === false) {
//                throw new Exception('Failed to retrieve data from Instagram API.');
//            }
//
//            $instagramData = json_decode($response, true);
//
//            // Filtrer uniquement les vidéos.
//            $videosData = array_filter($instagramData['data'] ?? [], function($item) {
//                return $item['media_type'] === 'VIDEO';
//            });
//
//            // Réorganiser les données avec la structure souhaitée.
//            $formattedData = ['data' => array_values($videosData)];
//
//            // Mettez en cache les résultats.
//            file_put_contents($cacheFile, json_encode($videosData));
//
//            return $videosData;
//        } catch (Exception $e) {
//            // Gérer les erreurs ici
//            echo 'Error: ' . $e->getMessage();
//            return [];
//        }
//
//    }
//}
//
//// Appel de la fonction et envoi des données en tant que JSON
//echo json_encode(get_instagram_data());


// Envoyer l'en-tête avant toute sortie de données.
header('Content-Type: application/json');

function get_instagram_data()
{
    $cacheFile = 'instagram_cache.json';
    $accessToken = 'Your  Access Token'; //Add here your accessToken
    $userId = 'User Id';

    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 1800) {
        // Utilisez les données mises en cache.
        $cachedData = file_get_contents($cacheFile);
        return json_decode($cachedData, true);
    } else {
        // Effectuez une nouvelle requête à l'API Instagram.
        try {
            // Effectuez une nouvelle requête à l'API Instagram.
       //     $apiUrl = "https://graph.instagram.com/v12.0/{$userId}/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token={$accessToken}";
            $apiUrl = "https://graph.instagram.com/v12.0/{$userId}/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token={$accessToken}"; //Example
            $response = file_get_contents($apiUrl);

            if ($response === false) {
                throw new Exception('Failed to retrieve data from Instagram API.');
            }

            $instagramData = json_decode($response, true);

            // Filtrer uniquement les vidéos.
            $videosData = array_filter($instagramData['data'] ?? [], function ($item) {
                return $item['media_type'] === 'VIDEO';
            });

            // Réorganiser les données avec la structure souhaitée.
            $formattedData = ['data' => array_values($videosData)];

            // Mettez en cache les résultats.
            file_put_contents($cacheFile, json_encode($formattedData));

            return $formattedData;
        } catch (Exception $e) {
            // Gérer les erreurs ici
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
}

// Appel de la fonction et envoi des données en tant que JSON
echo json_encode(get_instagram_data());
