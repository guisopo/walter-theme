import '../../css/src/main.scss';
import Doodle from './doodle';
import SweetScroll from './sweetScroll';

const sweetScrollArgs = {
  content: document.querySelector('[data-scroll-content]'),
  // scrollBar: document.querySelector('.scroll-bar')
  scrollBar: document.querySelectorAll('.scroll-bar')
};

const startApp = () => {
  console.log(document.body);
  document.body.style.transition = 'opacity 0.3s ease-in';
  document.body.style.opacity = '1';
  // 1. Create Doodle
  new Doodle();
  // 2. Add scroll animations
  new SweetScroll(sweetScrollArgs);
}

window.addEventListener('load', startApp, false);
