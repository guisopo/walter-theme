class Doodle {

  constructor() {
    // 1. Initial SVG
    this.svg = '<svg class="doodle" width="73" height="48" viewBox="0 0 73 48" xmlns="http://www.w3.org/2000/svg"><g fill="none"><g stroke="#353232"><path class="path" d="M54.9 41.5C70 22.4 68.8 10 51.4 4.3 15 3-1.7 11.6 1.3 30.2 5.9 58 62.4 32.3 70.2 24.8 78 17.4 59.5-1.6 27.2 1.3 -5 4.3 4.8 43.7 27.2 46.8 42.2 48.8 55.5 37.8 67 13.8"/></g></g></svg>';
    // 2. Item to append SVG
    this.itemActive = document.querySelector('.active');
    // 3. SVG once appended to item
    this.doodle;
    // 4. Length of path of Doodle
    this.pathLength;

    this.checker(this.itemActive);
  }

  bindAll() {
    [ 'appendSvg', 'getPathLength', 'setSvgInitialStyles' ]
      .forEach( fn => this[fn] = this[fn].bind(this));
  }

  checker(variable) {
    // 1. Init just if variable exists
    if(typeof variable === 'undefined' || variable === null) {
      return false;
    };

    this.init();
  }

  addEvents() {
    window.addEventListener('resize', () => this.init());
    window.addEventListener('orientationchange', () => this.init());
  }

  appendSvg(element) {
    if(typeof this.doodle === 'undefined' || this.doodle === null) {
      element.insertAdjacentHTML('beforeend', this.svg);
      // Select SVG once appended to element
      this.doodle = document.querySelector('.doodle');
    }
  }

  getPathLength() {
    const path = this.doodle.querySelector('path');
    this.pathLength = path.getTotalLength();
  }

  setSvgInitialStyles() {
    this.doodle.parentElement.style.position ='relative';
    
    this.doodle.style.cssText = 'position: absolute; top: 0; overflow: visible;';
    this.doodle.pointerEvents = 'none';

    this.getPathLength();
    this.doodle.style.strokeDasharray = this.pathLength + ' ' + this.pathLength;
    // this.doodle.style.strokeDashoffset = this.pathLength;  
    // this.doodle.style.transition =
    // 'stroke-dashoffset 0.6s ease-in-out';  
  }

  setSvgPosition() {
    // 1. Get elements position
    const activeRect = this.itemActive.getBoundingClientRect();
    const svgRect = this.doodle.getBoundingClientRect();
    // 2. Calculate Doodle displacement 
    const translateX = (svgRect.width - activeRect.width)/2;
    const translateY = -(svgRect.height - activeRect.height)/2;
    // 3.2 Works in every scenario
    this.doodle.style.right = -translateX + 'px';
    this.doodle.style.top = translateY + 'px';
  }

  animateSvg() {
    // this.itemActive.style.backgroundColor = 'rgba(255, 0, 0, 0.7)';
    // this.svg.style.backgroundColor = 'rgba(0, 255, 0, 0.4)';
  }

  init() {
    this.bindAll();

    this.appendSvg(this.itemActive);
    this.setSvgInitialStyles();
    this.setSvgPosition();

    this.animateSvg();

    this.addEvents();
  }
}



export default Doodle;