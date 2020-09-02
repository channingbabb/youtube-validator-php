<?php

  class YouTube{

    // this function will check if the
    // url returns headers that aren't
    // 404
    public function existence($url) {
        $url = "http://www.youtube.com/oembed?url=$url&format=json";
        $headers = get_headers($url);
        return (substr($headers[0], 9, 3) !== "404");
    }

    // this function will check the format
    // with video, playlist, and videos in playlists
    public function format($url, $type) {
        if ($type == "video") {
            $regex_pattern = "/(youtube.com)\/(watch)?(\?v=)?(\S+)?/";
            $match = [];

            if(preg_match($regex_pattern, $url, $match)){
                return "valid";
            } else {
                return "not_valid";
            }
        } else if ($type == "playlist") {
            $regex_pattern = "/(youtube.com)\/(playlist)?(\?list=)?(\S+)?/";
            $match = [];
    
            if(preg_match($regex_pattern, $url, $match)){
                return "valid";
            } else {
                return "not_valid";
            }
        } else if ($type == "video_playlist") {
            $regex_pattern = "/(youtube.com)\/(watch)?(\?v=)?(\S+)&(\&list=)?(\S+)?/";
            $match = [];
    
            if(preg_match($regex_pattern, $url, $match)){
                return "valid";
            } else {
                return "not_valid";
            }
        }
    }

    public function checkURL($url){ 
        // check if the url is youtu.be
        if (strpos($url, 'youtu.be') !== false) {
            return 'shortened';
            exit;
        }

        // if url is a video in a playlist
        if (strpos($url, 'watch?v=') !== false && strpos($url, '&list') !== false) {
            if (self::format($url, "video_playlist") == "valid") {
                if (self::existence($url)) {
                    echo 'video_playlist';        
                } else {
                    echo '404';
                }
            }
        }
        // else if it's a standalone youtube video
        else if (strpos($url, 'watch?v=') !== false && strpos($url, '&list') == false) {
            if (self::format($url, "video") == "valid") {
                if (self::existence($url, "video")) {
                    echo "video";
                } else {
                    echo '404';
                }
            }
        }
        // else if it's a standalone playlist
        // do not need &watch because watch always comes first
        // this is the only scenario that it doesn't come in 
        // first
        else if (strpos($url, 'playlist?list') !== false) {
            if (self::format($url, "playlist") == "valid") {
                if (self::existence($url, "playlist")) {
                    echo "playlist";
                } else {
                    echo '404';
                }
            }
        }
        else {
            return "not_valid";
        }

    }
}
