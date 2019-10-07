class Doodle {

  constructor() {

    this.itemActive = document.querySelector('.active');
    this.doodle = document.querySelector('.doodle');
    this.init();
  }

  bindAll() {
    ['setDoodleInitialStyles', 'setDoodlePosition', 'drawDoodle' ]
      .forEach( fn => this[fn] = this[fn].bind(this));
  }

  addEvents() {
    window.addEventListener( 'resize', this.setDoodlePosition);
  }

  setDoodleInitialStyles() {
    this.doodle.style.cssText = 'display: block; position: fixed; bottom:0; opacity:0;'
  }

  setDoodlePosition() {

    if (!this.itemActive) {
      return;
    }
    
    const itemActiveRect = this.itemActive.getBoundingClientRect();
    const doodleRect = this.doodle.getBoundingClientRect();
    
    const horizontalPositon = itemActiveRect.x - (doodleRect.width - itemActiveRect.width)/2;
    const verticalPosition = itemActiveRect.y - doodleRect.y - (doodleRect.height-itemActiveRect.height)/2;
    
    if (verticalPosition === 0) {

      return; 
    }

    // This is a cleaner alternative but its buggy with iphone
    // probably because when scrolling document client height changes
    // it's value, due safary & chrome bars.

    // const verticalPosition = ((document.documentElement.clientHeight - itemActiveRect.y) - (doodleRect.height + itemActiveRect.height)/2) * -1;

    // if (this.verticalPosition === verticalPosition) {
    //   console.log('stop');
    //   return; 
    // }

    // this.verticalPosition = verticalPosition;
    
    this.doodle.style.transform = `translate3d(
      ${horizontalPositon}px, 
      ${verticalPosition}px, 
      0)`;


    this.doodle.style.opacity = '1';
  }

  drawDoodle() {
    const path = this.doodle.querySelector('.path');
    const offset = getComputedStyle(path).strokeDashoffset;
  }

  init() {
    this.bindAll();
    this.setDoodleInitialStyles();
    this.setDoodlePosition();
    this.addEvents();
  }
}



export default Doodle;