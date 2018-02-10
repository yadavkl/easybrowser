<?php

namespace GCLIENT;

//require_once 'Google/Client.php';
//require_once 'Google/Service/YouTube.php';
require_once('vendor/autoload.php');
define('DEVELOPER_KEY', 'AIzaSyBgrQeyijcSiluvycTgCDidipVXHUVKzfU');

final class gclient {

    private $youtube;

    public function __construct() {

        $client = new \Google_Client();
        $client->setDeveloperKey(DEVELOPER_KEY);
        $this->youtube = new \Google_Service_YouTube($client);
    }

    public function searchVideo($query, $location, $locationRadius = "5km", $maxResults = 12) {
        try {
            $searchResponse = $this->youtube->search->listSearch('id, snippet', array(
                'type' => 'video',
                'q' => $query,
                'location' => $location,
                'locationRadius' => $locationRadius,
                'maxResults' => $maxResults
            ));

            $videoResults = array();
            foreach ($searchResponse['items'] as $searchResult) {                
                array_push($videoResults, $searchResult['id']['videoId']);
            }
            $videoIds = join(',', $videoResults);

            $videosResponse = $this->youtube->videos->listVideos('snippet, recordingDetails', array(
                'id' => $videoIds,
            ));
            $index = 0;
            $videoResult=array();
            foreach ($videosResponse['items'] as $searchResult) {           
                $videoResult[] = array(
                    'url' => "https://www.youtube.com/watch?v=" . $searchResponse['items'][$index++]['id']['videoId'],
                    'title' => $searchResult['snippet']['title'],
                   // 'tdefaulturl' => $searchResult['snippet']['thumbnails']['default']['url'],
                   // 'tmediumurl' => $searchResult['snippet']['thumbnails']['medium']['url'],
                    'image' => $searchResult['snippet']['thumbnails']['high']['url'],
                );
            }
            return $videoResult;
        } catch (Google_Service_Exception $e) {
            return $e->getMessage();
        } catch (Google_Exception $e) {
            return $e->getMessage();
        }
    }

}
