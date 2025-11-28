fetch('guide.xml')
  .then(r => r.text())
  .then(t => new DOMParser().parseFromString(t, "text/xml"))
  .then(xml => {
    const now = new Date();
    let currentShow = null;
    let currentRuntime = "";
    let nextShow = null;

    const seen = new Set(); // track duplicates
    const programmes = Array.from(xml.querySelectorAll('programme'))
      .filter(p => p.getAttribute('channel') === channelId)
      .map(p => {
        const startStr = p.getAttribute('start').slice(0,14);
        const stopStr = p.getAttribute('stop').slice(0,14);
        const key = startStr + "-" + stopStr;
        if(seen.has(key)) return null; // skip duplicate
        seen.add(key);

        const start = new Date(
          startStr.slice(0,4), startStr.slice(4,6)-1, startStr.slice(6,8),
          startStr.slice(8,10), startStr.slice(10,12), startStr.slice(12,14)
        );
        const stop = new Date(
          stopStr.slice(0,4), stopStr.slice(4,6)-1, stopStr.slice(6,8),
          stopStr.slice(8,10), stopStr.slice(10,12), stopStr.slice(12,14)
        );
        return {title: p.querySelector('title').textContent, start, stop};
      })
      .filter(p => p) // remove nulls
      .sort((a,b) => a.start - b.start);

    for(let i=0; i<programmes.length; i++){
      const p = programmes[i];
      if(now >= p.start && now < p.stop){
        currentShow = p.title;
        currentRuntime = p.start.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}) + 
                         " - " + 
                         p.stop.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
        if(i+1 < programmes.length){
          nextShow = programmes[i+1];
        }
        break;
      }
      if(p.start > now && !currentShow && !nextShow){
        nextShow = p;
        break;
      }
    }

    document.getElementById('currentShow').textContent = currentShow ? `${currentShow} (${currentRuntime})` : 'No programme airing now';
    document.getElementById('next').textContent = nextShow ? `${nextShow.title} (${nextShow.start.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})})` : 'No upcoming programme';
  });