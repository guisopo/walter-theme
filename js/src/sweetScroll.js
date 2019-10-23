// 1. Move Bars styles to constructor.
// 2. Add Dragg Icon.
// 5. Manage better listeners.

class SweetScroll {
  constructor(options = {}) {
    this.options = {
      content: options.content,
      scrollBar: options.scrollBar || false,
      lerpFactor: options.lerpFactor || 0.1,
      scaleFactor: options.scaleFactor || 0.3,
      skewFactor: options.skewFactor || 0.75,
      dragSpeed: options.dragSpeed || 4
    }

    this.scrollBarBottom = this.options.scrollBar[0];
    this.scrollBarTop = this.options.scrollBar[1];
    this.scrollBarLeft = this.options.scrollBar[2];
    this.scrollBarRight = this.options.scrollBar[3];

    this.start = {x:0,y:0};
    this.offset = {x:0,y:0};

    this.data = {
      current: 0,
      last: 0,
      mouseDown: 0,
      mouseUp: 0,
      scrollingSpeed: 0
    }

    this.isDragging = false;

    this.animatedStyles = {
      translateX: {
        animate: true,
        previous: 0,
        current: 0,
        setStyle: () => `translate3d(-${this.animatedStyles.translateX.current}px, 0, 0)`,
        setValue: () => {
          return this.data.last;
        }
      },
      translateY: {
        animate: false,
        previous: 0,
        current: 0,
        setStyle: () => `translate3d(0, -${this.animatedStyles.translateX.current}px, 0)`,
        setValue: () => {
          return this.data.last;
        }
      },
      skewX: {
        animate: true,
        previous: 0,
        current: 0,
        setStyle: () => `skewX(${this.animatedStyles.skewX.current}deg)`,
        setValue: () => {
          return this.clamp(this.data.scrollingSpeed, - this.options.skewFactor, this.options.skewFactor);
        }
      },
      skewY: {
        animate: false,
        previous: 0,
        current: 0,
        setStyle: () => `skewY(${this.animatedStyles.skewX.current}deg)`,
        setValue: () => {
          const fromValue = this.options.skewFactor * -1;
          const toValue = this.options.skewFactor;
          return Math.floor(this.map(this.data.scrollingSpeed, -1500, 1500, fromValue, toValue));
        }
      },
      scale: {
        animate: true,
        previous: 1,
        current: 1,
        setStyle: () => `scale(${this.animatedStyles.scale.current})`,
        setValue: () => {
          const fromValue = 0;
          const toValue = this.options.scaleFactor;
          return 1 - (this.clamp(Math.abs(this.data.scrollingSpeed), fromValue, toValue * 10)/100);
        }
      }
    };

    this.windowSize = {};
    this.contentWidth = 0;
    
    this.styles = '';
    this.init();
  }

  bindAll() {
    ['wheel', 'drag', 'getTouchX', 'getTouchMoveOffsetX', 'run', 'setBounds']
      .forEach( fn => this[fn] = this[fn].bind(this));
  }

  clamp(x, min, max) {
    return Math.min(Math.max(x, min), max);
  }

  map (x, a, b, c, d) {
    return (x - a) * (d - c) / (b - a) + c;
  } 

  lerp (a, b, n) {
    return (1 - n) * a + n * b;
  }

  wheel(e) {
    const wheelDelta  = e.deltaY || e.deltaX;

    this.data.current += wheelDelta;
  }

  setBounds() {
    this.windowSize = {
      width: window.innerWidth,
      height: window.innherHeight
    };

    this.contentWidth = this.options.content.offsetWidth - this.windowSize.width;
  }

  run() {
    this.data.current = this.clamp(this.data.current, 0, this.contentWidth);

    this.data.last = this.lerp(this.data.last, this.data.current, this.options.lerpFactor);
    this.data.last = Math.floor(this.data.last * 10000) / 10000;

    this.data.scrollingSpeed = Math.floor(this.data.current - this.data.last) / 100;

    this.options.content.style.transform = this.styles;
    // this.options.scrollBar.style.transform = `scaleX(${this.data.current/this.contentWidth})`;
    this.scrollBarBottom.style.transform = `scaleX(${this.data.last/this.contentWidth})`;
    this.scrollBarTop.style.transform = `translateX(100vw) scale(-1, 1) scaleX(${this.data.last/this.contentWidth})`;
    this.scrollBarLeft.style.transform = `scaleY(${this.data.last/this.contentWidth})`;
    this.scrollBarRight.style.transform = `scaleY(${this.data.last/this.contentWidth})`;

    this.styles = '';
    
    for (const key in this.animatedStyles) {
      if(this.animatedStyles[key].animate) {
        this.styles += this.animatedStyles[key].setStyle();
        this.animatedStyles[key].current = this.animatedStyles[key].setValue();
      }
    }
    
    requestAnimationFrame(() => this.run());
  }

  getTouchX(e) {
    this.start.x = e.targetTouches[0].pageX;

    this.options.content.addEventListener('touchmove', this.getTouchMoveOffsetX, { passive: true });
    // this.option.content.addEventListener('touchend', this.getTouchMoveOffsetX, { passive: true });
    // this.option.content.addEventListener('touchcancel', this.getTouchMoveOffsetX, { passive: true });
  }

  getTouchMoveOffsetX(e) {

    this.offset.x = Math.round(this.start.x - e.targetTouches[0].pageX);

    this.data.current = -this.offset.x;
  }

  drag(e) {
    e.preventDefault();

    this.data.current = this.data.mouseUp - ((e.clientX - this.data.mouseDown) * this.options.dragSpeed);
  }

  addEvents() {
    this.options.content.addEventListener('wheel', this.wheel, { passive: true });

    this.options.content.addEventListener('mousedown', (e) => {
      this.isDragging = true;
      this.options.content.removeEventListener( 'wheel', this.wheel, { passive: true });
      this.data.mouseDown = e.clientX ;
      this.data.mouseUp = this.data.current;
    });

    this.options.content.addEventListener('mousemove', (e) => {
      if(!this.isDragging) return;
      this.options.content.classList.add("dragged");
      this.drag(e);
    }, { pasive: true });
    
    this.options.content.addEventListener('mouseup', (e) => {
      this.isDragging = false;
      this.options.content.classList.remove("dragged");
      this.data.mouseUp = this.data.current;
      this.options.content.addEventListener('wheel', this.wheel, { passive: true });
    });
    
    this.options.content.addEventListener('mouseleave', () => {
      this.isDragging = false;
      this.options.content.classList.remove("dragged");
    }, { pasive: true });

    // this.options.content.addEventListener('touchstart', this.getTouchX, { passive: true });
    window.addEventListener('resize', this.setBounds);
  }

  init() {
    this.bindAll();
    this.setBounds();
    this.addEvents();
    this.run();
  }
}

export default SweetScroll;