class Doodle {

  constructor() {

    this.itemParent = document.querySelector
    this.itemActive = document.querySelector('.active');
    this.doodle = document.querySelector('.doodle');

    this.init();
  }

  bindAll() {
    ['setDoodleInitialStyles', 'setDoodlePosition', 'drawDoodle' ]
      .forEach( fn => this[fn] = this[fn].bind(this));
  }

  addEvents() {
    document.addEventListener( 'click', this.setDoodlePosition);
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

    this.doodle.style.transform = `translate3d(
      ${itemActiveRect.x - (doodleRect.width - itemActiveRect.width)/2}px, 
      ${itemActiveRect.y - doodleRect.y - (doodleRect.height - itemActiveRect.height)/2}px, 
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