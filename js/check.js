$(document).ready(function() {
    function playlistStrip(url) {
        return url.split('&list=').pop().split('&')[0];
    }
    function ajax(value) {
        $.ajax( {
            type: 'POST',
            url: 'ajax/youtube_requests.php',
            data: { url: value },
            success: function(data) {
                if (data == "not_valid" || data == "404") {
                    $('.mainInput').css({"border-color": "#ed4545", "box-shadow": "0 0 0 0.2rem rgba(237, 69, 69, 0.25)"});
                    $('.result').css({"color": "#ed4545", "text-weight": "600"});
                    $('.result').html("Invalid YouTube link");
                } else if (data == "playlist") {
                    $('.mainInput').css({"border-color": "#28a745", "box-shadow": "0 0 0 0.2rem rgba(40, 167, 69, 0.25)"});
                    $('.result').css({"color": "#28a745", "text-weight": "600"});
                    $('.result').html("Valid YouTube playlist");
                } else if (data == "video_playlist") {
                    var pid = playlistStrip(value);
                    $('.mainInput').css({"border-color": "#28a745", "box-shadow": "0 0 0 0.2rem rgba(40, 167, 69, 0.25)"});
                    $('.result').html("<p class='playlist_top'>Valid YouTube video in a playlist</p><p class='playlist_warn'>Videos in playlists will only check the video existence, not the playlist.</p>If you want to check the playlist, click the link: <span class='check_playlist' style='text-weight:600; color: #28a745; cursor: pointer;'>https://youtube.com/playlist?list=" + pid + "</span>");
                    $('.playlist_top').css({"color": "#28a745", "text-weight": "600"});
                    $('.playlist_warn').css({"color": "#28a745", "text-weight": "600"});
                    $('.check_playlist').click( function() {
                        $('.mainInput').val($('.check_playlist').html());
                        ajax($('.check_playlist').html());
                    });
                } else if (data == "video") {
                    $('.mainInput').css({"border-color": "#28a745", "box-shadow": "0 0 0 0.2rem rgba(40, 167, 69, 0.25)"});
                    $('.result').css({"color": "#28a745", "text-weight": "600"});
                    $('.result').html("Valid YouTube video");
                } else if (data == "shortened") {
                    $('.mainInput').css({"border-color": "#ed4545", "box-shadow": "0 0 0 0.2rem rgba(237, 69, 69, 0.25)"});
                    $('.result').css({"color": "#ed4545", "text-weight": "600"});
                    $('.result').html("youtu.be links are not supported");
                }
                // $('.result2').html(data);
            }
        });
    }
    $(".mainInput").keyup(function(){
        var value = $(".mainInput").val();
        ajax(value);

    });
 });
