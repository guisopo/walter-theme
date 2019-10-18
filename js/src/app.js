import '../../css/src/main.scss';
import newObserver from './newObserver';
import Doodle from './doodle';
import SweetScroll from './sweetScroll';

const sweetScrollArgs = {
  content: document.querySelector('[data-scroll-content]'),
  // scrollBar: document.querySelector('.scroll-bar')
  scrollBar: document.querySelectorAll('.scroll-bar')
};

const startApp = () => {

  // 1. Create Doodle
  new Doodle();
  // 2. Add scroll animations
  const contentScroll = new SweetScroll(sweetScrollArgs);
  // 3. Start to observe
  newObserver(contentScroll);
 
}

window.addEventListener('load', startApp, false);