<?php
    if (!isset($_GET['channel'])) {
        header('Location: index.php');
        exit();
    }
    require_once 'functions/connect.php';
    require_once 'functions/useragent.php';
    
    $channelData = query("SELECT * FROM channels WHERE id = ?", [$_GET['channel']] , "s");
    $sql = query("SELECT id FROM channels ORDER BY name ASC"); 
    $channels = array_column($sql, 'id');
    $currentIndex = array_search($_GET['channel'], $channels);
    $count = count($channels);
    $previousChannel = $channels[$currentIndex - 1] ?? $channels[$count - 1];
    $nextChannel = $channels[$currentIndex + 1] ?? $channels[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title><?= $channelData['name']; ?> - TV</title>
</head>
<body class="min-h-screen bg-neutral-900 text-white">
    <div class="flex justify-center bg-black max-h-[80vh]">
        <video id="videoPlayer" class="w-full" controls autoplay playsinline></video>
    </div>
    <div class="flex justify-between items-center mt-4 mx-[12.5rem]">
        <img class="w-20 invert scale-x-[-1] hover:cursor-pointer" src="https://cdn-icons-png.flaticon.com/128/15948/15948774.png" onclick="history.replaceState(null, '', 'player.php?channel=<?= $previousChannel ?>'); location.reload();">
        <p class="text-center text-4xl font-bold"><?= $channelData['name']; ?></p>
        <img class="w-20 invert hover:cursor-pointer" src="https://cdn-icons-png.flaticon.com/128/15948/15948774.png" onclick="history.replaceState(null, '', 'player.php?channel=<?= $nextChannel ?>'); location.reload();">
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
    var video = document.getElementById('videoPlayer');
    var videoSource = '<?= $channelData['url']; ?>';

    if (Hls.isSupported()) {
        var hls = new Hls();
        hls.loadSource(videoSource);
        hls.attachMedia(video);
    } else if (video.canPlayType('application/x-mpegURL')) {
        video.src = videoSource;
    } else {
        console.error('HLS is not supported in this browser.');
    }
    </script>
</body>
</html>