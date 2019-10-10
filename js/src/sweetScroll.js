class SweetScroll {
  constructor(options = {}) {
    this.options = {
      content: options.content,
      scrollBar: options.scrollBar || false,
      lerpFactor: options.lerpFactor || 0.1,
      scaleFactor: options.scaleFactor || 0.15,
      skewFactor: options.skewFactor || 2
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
      mouseDown: 0
    }

    this.isDragging = false;

    this.renderedStyles = ''
    this.scrollingSpeed = 0;

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
          const fromValue = this.options.skewFactor * -1;
          const toValue = this.options.skewFactor;
          return Math.floor(this.map(this.scrollingSpeed, -1500, 1500, fromValue, toValue));
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
          return Math.floor(this.map(this.scrollingSpeed, -1500, 1500, fromValue, toValue));
        }
      },
      scale: {
        animate: true,
        previous: 1,
        current: 1,
        setStyle: () => `scale(${this.animatedStyles.scale.current})`,
        setValue: () => {
          const fromValue = this.options.scaleFactor * -1;
          const toValue = this.options.scaleFactor;
          return 1 - Math.abs(Math.floor((this.map(this.scrollingSpeed, -1500, 1500, fromValue, toValue)) * 1000) / 1000);
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
    this.data.last = Math.floor(this.data.last * 1000) / 1000;

    this.scrollingSpeed = this.data.current - this.data.last;
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
    e.preventDefault();

    this.offset.x = (this.start.x - e.targetTouches[0].pageX) / 2;
    this.offset.x = this.clamp( this.offset.x, -40, 40);
    console.log(this.offset);
    this.data.current += this.offset.x;

    this.offset.x = 0;

  }

  drag(e) {
    e.preventDefault();

    this.data.current -= e.movementX*4;
    
    this.offset.x = 0;
  }

  addEvents() {
    this.options.content.addEventListener('wheel', this.wheel, { passive: true });

    this.options.content.addEventListener('mousedown', (e) => {
      this.isDragging = true;
      this.data.mouseDown = e.clientX;
    });

    this.options.content.addEventListener('mousemove', (e) => {
      
      if(!this.isDragging) return;
      

      this.drag(e);
    }, { pasive: true });

    this.options.content.addEventListener('mouseleave', () => {
      this.isDragging = false;
    }, { pasive: true });

    this.options.content.addEventListener('mouseup', () => {
      this.isDragging = false;
    }, { pasive: true });

    this.options.content.addEventListener('touchstart', this.getTouchX, { passive: true });
    this.options.content.addEventListener('resize', this.setBounds);
  }

  init() {
    this.bindAll();
    this.setBounds();
    this.addEvents();
    this.run();
  }
}

export default SweetScroll;