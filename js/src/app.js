import '../../css/src/main.scss';
import Doodle from './scribble';

const startApp = () => {
  
  new Doodle();
}


window.addEventListener('load', startApp, false);