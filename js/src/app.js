import '../../css/src/main.scss';
import Doodle from './doodle';

const startApp = () => {

  new Doodle();
}


window.addEventListener('load', startApp, false);