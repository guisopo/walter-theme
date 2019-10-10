import '../../css/src/main.scss';
import Doodle from './doodle';
import SweetScroll from './sweetScroll';

const sweetScrollArgs = {
  content: document.querySelector('[data-scroll-content]'),
  // scrollBar: document.querySelector('.scroll-bar')
  scrollBar: document.querySelectorAll('.scroll-bar')
};

const startApp = () => {

  new SweetScroll(sweetScrollArgs);

  new Doodle();
}


window.addEventListener('load', startApp, false);