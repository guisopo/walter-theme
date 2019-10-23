import '../../css/src/main.scss';
import Doodle from './doodle';
import SweetScroll from './sweetScroll';
import animate from './loadAnimation';

const sweetScrollArgs = {
  content: document.querySelector('[data-scroll-content]'),
  // scrollBar: document.querySelector('.scroll-bar')
  scrollBar: document.querySelectorAll('.scroll-bar')
};

const startApp = () => {
  animate();
  // 1. Create Doodle
  new Doodle(); 
  // 2. Add scroll animations
  new SweetScroll(sweetScrollArgs);
  // 3. Animate
}

window.addEventListener('load', startApp, false);
