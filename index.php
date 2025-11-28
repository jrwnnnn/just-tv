<?php
    require_once 'functions/connect.php';
    require_once 'functions/useragent.php';
    $channels = query("SELECT * FROM channels ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="src/output.css" rel="stylesheet">
    <title>TV</title>
</head>
<body class="min-h-screen bg-neutral-900 text-white p-8">
    <div class="flex justify-end">
        <p class="text-2xl font-bold mb-8 text-center" id="time"></p>
    </div>
    <div class="grid md:grid-cols-5 gap-5">
        <?php foreach ($channels as $channel): ?>
            <div class="flex flex-col items-center justify-center bg-neutral-800 rounded-lg p-10 hover:bg-neutral-700 transition" onclick="window.location.href='player.php?channel=<?= $channel['id']; ?>#navigation'">
                <img src="<?= $channel['logo']; ?>" class="max-w-40 max-h-20 rounded-md" alt="<?= $channel['name']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <div class="flex flex-col justify-center items-center mt-10 text-neutral-500 text-sm">
        <p>This website does not host or store content. All video streams are provided by external third-party sources.</p>
        <p>&copy; <?= date('Y'); ?> <a class="underline" href="https://jrwnnnn.github.io" target="_blank" rel="noopener noreferrer">Project jrwnnnn_</a></p>
    </div>
    <script>
        setInterval(() => document.getElementById('time').textContent = new Date().toLocaleTimeString([], {hour:'2-digit',minute:'2-digit',hour12:true}), 1000);
    </script>
</body>
</html>