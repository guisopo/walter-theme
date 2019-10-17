import '../../css/src/main.scss';
import ajaxLoadMore from './ajaxLoadMore';
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
  new SweetScroll(sweetScrollArgs);
  // 3. 
  ajaxLoadMore();
}


window.addEventListener('load', startApp, false);