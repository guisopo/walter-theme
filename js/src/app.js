import '../../css/src/main.scss';

const startApp = () => {
  return new App();
}

class App {

  constructor() {

    this.scribbleItem();
    this.addEvents();
  }

  addEvents() {
    document.addEventListener( 'click', scribbleItem);
    window.addEventListener( 'resize', scribbleItem);
  } 


  scribbleItem() {
    const itemActive = document.querySelector('.active');

    if (!itemActive) {
      return;
    }

    const scrawl = document.querySelector('.scrawl');
    scrawl.style.cssText = 'display: block; position: fixed; bottom:0;'

    const itemActiveRect = itemActive.getBoundingClientRect();
    const scrawlRect = scrawl.getBoundingClientRect();

    const path = scrawl.querySelector('.path');
    const offset = getComputedStyle(path).strokeDashoffset;
    
    scrawl.style.transform = `translate3d(
      ${itemActiveRect.x - (scrawlRect.width - itemActiveRect.width)/2}px, 
      ${itemActiveRect.y - scrawlRect.y - (scrawlRect.height - itemActiveRect.height)/2}px, 
      0)`;

    scrawl.style.opacity = '1';
  }

}

window.addEventListener('load', startApp, false);