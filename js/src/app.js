import '../../css/src/main.scss';
import Doodle from './doodle';
import SweetScroll from './sweetScroll';
import SweetScrollBar from './sweetScrollBar';

const startApp = () => {
  new SweetScrollBar();

  new SweetScroll({content: document.querySelector('[data-scroll-content]')});

  new Doodle();
}


window.addEventListener('load', startApp, false);