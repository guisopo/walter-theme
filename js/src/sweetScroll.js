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

    this.initialTouchPos;
    this.lastTouchPos;
    this.rafPending;

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
    ['wheel', 'drag', 'run', 'setBounds', 'handleGestureStart', 'handleGestureMove', 'handleGestureEnd']
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

  drag(e) {
    e.preventDefault();

    // this.data.current = this.data.mouseUp - ((e.clientX - this.data.mouseDown) * this.options.dragSpeed);
    this.data.current = this.lastTouchPos - ((e.clientX - this.initialTouchPos.x) * this.options.dragSpeed);
    console.log('current', this.data.current);
  }

  getGesturePointFromEvent(e) {
    // this.isDragging = true;
    // this.data.mouseDown = e.clientX ;
    // this.data.mouseUp = this.data.current;
  
    const point = {};

    if(e.targetTouches) {
      // Prefer Touch Events
      point.x = e.targetTouches[0].clientX;
      point.y = e.targetTouches[0].clientY;
    } else {
      // Either Mouse event or Pointer Event
      point.x = e.clientX;
      point.y = e.clientY;
    }

    return point;
  }


  handleGestureStart(e) {
    e.preventDefault();

    this.options.content.removeEventListener( 'wheel', this.wheel, { passive: true });

    if(e.touches && e.touches.length > 1) {
      return;
    }

    // Add the move and end listeners
    if (window.PointerEvent) {
      e.target.setPointerCapture(e.pointerId);
    } else {
      // Add Mouse Listeners
      document.addEventListener('mousemove', this.handleGestureMove, true);
      document.addEventListener('mouseup', this.handleGestureEnd, true);
    }

    this.initialTouchPos = this.getGesturePointFromEvent(e);
    this.lastTouchPos = this.data.current;
    console.log('init', this.initialTouchPos.x);
    this.options.content.style.transition = 'initial';
  }

  handleGestureMove(e) {
    e.preventDefault();

    // if(!this.isDragging) return;
    // this.options.content.classList.add("dragged");
    // this.drag(e);
  
    if(!this.initialTouchPos) {
      return;
    }
  
    this.drag(e);
  }

  handleGestureEnd(e) {
    e.preventDefault();

    // this.isDragging = false;
    // this.options.content.classList.remove("dragged");
    // this.data.mouseUp = this.data.current;
    this.options.content.addEventListener('wheel', this.wheel, { passive: true });
    this.lastTouchPos = this.data.current;
    console.log('last', this.lastTouchPos);

    if(e.touches && e.touches.length > 0) {
      return;
    }
  
    this.rafPending = false;
  
    // Remove Event Listeners
    if (window.PointerEvent) {
      e.target.releasePointerCapture(e.pointerId);
    } else {
      // Remove Mouse Listeners
      document.removeEventListener('mousemove', this.handleGestureMove, true);
      document.removeEventListener('mouseup', this.handleGestureEnd, true);
    }
  
    // updateSwipeRestPosition();
  
    this.initialTouchPos = null;
  }

  addEvents() {
    if( window.PointerEvent) {
      // Add Pointer Event Listener
      this.options.content.addEventListener('pointerdown', this.handleGestureStart, { passive: true });
      this.options.content.addEventListener('pointermove', this.handleGestureMove, { passive: true });
      this.options.content.addEventListener('pointerup', this.handleGestureEnd, { passive: true });
      this.options.content.addEventListener('pointercancel', this.handleGestureEnd, { passive: true });
    } else {
      // Add Touch Listener
      this.options.content.addEventListener('touchstart', this.handleGestureStart, { passive: true });
      this.options.content.addEventListener('touchmove', this.handleGestureMove, { passive: true });
      this.options.content.addEventListener('touchend', this.handleGestureEnd, { passive: true });
      this.options.content.addEventListener('touchcancel', this.handleGestureEnd, { passive: true });

      // Add Mouse Listener
      this.options.content.addEventListener('mousedown', this.handleGestureStart, { passive: true });
    }

    this.options.content.addEventListener('wheel', this.wheel, { passive: true });
    
    
    // this.options.content.addEventListener('mouseleave', () => {
    //   this.isDragging = false;
    //   this.options.content.classList.remove("dragged");
    // }, { pasive: true });

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