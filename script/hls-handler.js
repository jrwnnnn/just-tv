if (Hls.isSupported()) {
    var hls = new Hls();
    hls.loadSource(streamUrl);
    hls.attachMedia(player);
} else if (player.canPlayType('application/x-mpegURL')) {
    player.src = streamUrl;
} else {
    console.error('HLS is not supported in this browser.');
}
var retrycount = 0;

function wait(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function retryPlayer(p, s, e) {
    await wait(15000);
    e.textContent = 'Retrying...';
    console.warn("An error occurred while trying to play the video. Retrying...");
    p.src = "";
    p.load();
    p.src = s;
    p.load();
}

player.addEventListener("canplay", () => {
    console.log("Video loaded successfully.");
    playerStatus.textContent = 'Good';
    retrycount = 0;
});

player.addEventListener("error", () => {
    if (retrycount >= 3) {
        console.error("Unable to load the video.");
        playerStatus.textContent = 'Error';
    } else {
        retryPlayer(player, streamUrl, playerStatus);
    }
});
