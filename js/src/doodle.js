class Doodle {

  constructor() {
    this.svg = ' <svg class="doodle" width="41px" height="82px" viewBox="0 0 41 82" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="iPhone-8" transform="translate(-6.000000, -302.000000)" stroke="#353232"><g id="Nav-Menu" transform="translate(6.000000, 302.000000)"><path class="path" stroke= “#000000” d="M41.5471152,56.2205478 C58.7195827,39.605151 57.3610014,28.811803 37.4713713,23.8405039 C-4.02223755,22.7317761 -23.0474477,30.2430441 -19.6042593,46.374308 C-14.4394766,70.5712038 50.0235756,48.2115805 58.9619536,41.7333944 C67.9003317,35.2552084 46.694508,18.7013327 9.91499511,21.2679874 C-26.8645177,23.834642 -15.7067613,58.1348619 9.91499511,60.7919565 C26.996166,62.563353 42.1293125,53.0227669 55.3144346,32.1701984" id="Path" transform="translate(20.500000, 41.000000) rotate(-90.000000) translate(-20.500000, -41.000000) "></path></g></g></g></svg>';
    this.itemActive = document.querySelector('.active');

    this.pathLength;
    this.svg;

    this.init();
  }

  bindAll() {
    [ 'appendSvg', 'getPathLength', 'setSvgInitialStyles' ]
      .forEach( fn => this[fn] = this[fn].bind(this));
  }

  addEvents() {
    window.addEventListener( 'resize', this.setDoodlePosition);
  }

  appendSvg() {
    this.itemActive.insertAdjacentHTML('beforeend', this.svg);
    this.svg = document.querySelector('.doodle');
  }

  getPathLength() {
    const path = this.svg.querySelector('path');
    this.pathLength = path.getTotalLength();
  }

  setSvgInitialStyles() {
    this.itemActive.style.position ='relative';

    this.svg.pointerEvents = 'none';
    this.svg.style.cssText = 'position: absolute; top: 0; overflow: visible;';

    this.svg.style.strokeDasharray = this.pathLength + ' ' + this.pathLength;
    // this.svg.style.strokeDashoffset = this.pathLength;  
    // this.svg.style.transition =
    // 'stroke-dashoffset 0.6s ease-in-out';  
  }

  setSvgPosition() {
    const activeRect = this.itemActive.getBoundingClientRect();
    const svgRect = this.svg.getBoundingClientRect();

    const translateX = (svgRect.width - activeRect.width)/2;
    const translateY = -(svgRect.height - activeRect.height)/2;

    // Doesn't translate properly in chrome android
    // this.svg.style.transform = `translate3d(
    //   ${translateX}px,
    //   ${translateY}px,
    //   0
    // )`;

    this.svg.style.right = -translateX;
    this.svg.style.top = translateY;

    // this.itemActive.style.backgroundColor = 'rgba(255, 0, 0, 0.7)';
    // this.svg.style.backgroundColor = 'rgba(0, 255, 0, 0.4)';
  }

  animateSvg() {
    
  }

  init() {
    this.bindAll();

    this.appendSvg();
    this.getPathLength();
    this.setSvgInitialStyles();
    this.setSvgPosition();
    this.setSvgPosition();
    this.animateSvg();

    this.addEvents();
  }
}



export default Doodle;