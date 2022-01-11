
  navigator.serviceWorker.register('sw.js')
    .then(reg => console.log('SW registered!', reg))
    .catch(err => console.log('Boo!', err));
/*    
  setTimeout(() => {
    const img = new Image();
    img.src = '../assets/brand/FEEDCUBE_square.png';
    document.body.appendChild(img);
  }, 3000);
*/