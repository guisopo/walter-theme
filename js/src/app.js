import '../../css/src/main.scss';

const addEvents = () => {
  scribbleItem();
  document.addEventListener( 'click', scribbleItem);
  window.addEventListener( 'resize', scribbleItem);
}

const scribbleItem = () => {
  const navActive = document.querySelector('.active');

  if (!navActive) {
    return;
  }

  const scrawl = document.querySelector('.scrawl');
  scrawl.style.cssText = 'display: block; position: fixed; bottom:0;'

  const navActiveRect = navActive.getBoundingClientRect();
  const scrawlRect = scrawl.getBoundingClientRect();

  const path = scrawl.querySelector('.path');
  const offset = getComputedStyle(path).strokeDashoffset;
  
  scrawl.style.transform = `translate3d(
    ${navActiveRect.x - (scrawlRect.width - navActiveRect.width)/2}px, 
    ${navActiveRect.y - scrawlRect.y - (scrawlRect.height - navActiveRect.height)/2}px, 
    0)`;

  scrawl.style.opacity = '1';
}

window.addEventListener('load', addEvents, false);