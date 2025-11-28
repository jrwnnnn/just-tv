<?php
    if (!isset($_GET['channel'])) {
        header('Location: index.php');
        exit();
    }
    require_once 'functions/connect.php';
    require_once 'functions/useragent.php';
    
    $id = $_GET['channel'];
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
        <video id="hlsPlayer" class="w-full" controls autoplay playsinline></video>
    </div>
    <div class="flex justify-between items-center mt-4 mx-[10rem]">
        <img class="w-20 invert scale-x-[-1] hover:cursor-pointer" src="https://cdn-icons-png.flaticon.com/128/15948/15948774.png" onclick="history.replaceState(null, '', 'player.php?channel=<?= $previousChannel ?>'); location.reload();">
        <div class="flex flex-col items-center space-y-1">
            <p class="text-center text-4xl font-bold"><?= $channelData['name']; ?></p>
            <span id="currentShow">Loading...</span>
            <div class="flex space-x-5 font-mono text-sm text-neutral-500">
                <p>Upcoming: <span id="next"></span></p>
            </div>
        </div>
        <img class="w-20 invert hover:cursor-pointer" src="https://cdn-icons-png.flaticon.com/128/15948/15948774.png" onclick="history.replaceState(null, '', 'player.php?channel=<?= $nextChannel ?>'); location.reload();">
    </div>    
    
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script>
        var player = document.getElementById('hlsPlayer');
        var streamUrl = '<?= $channelData['url']; ?>';
        var playerStatus = document.getElementById('playerStatus');
        const channelId = "<?= $id ?>";
    </script>
    <script src="script/hls-handler.js"></script>
    <script src="script/guide.js"></script>
</body>
</html>