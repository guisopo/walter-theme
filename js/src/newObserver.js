import ajaxLoadMore from './ajaxLoadMore';

function newObserver(contentScroll) {
  let detectVisibility;
  const lastContent = document.querySelector('[data-scroll-content]').lastElementChild;

  let visibilityOptions = {
    threshold : [0]
  };

  detectVisibility = new IntersectionObserver(onIntersection, visibilityOptions);

  detectVisibility.observe(lastContent);

  function onIntersection(entry, detectVisibility) {
    console.log(entry[0].isIntersecting);
    if(entry[0].intersectionRatio > 0) {
      console.log('load');
      ajaxLoadMore(contentScroll);
      detectVisibility.disconnect(entry.target);
    }
  }

}

export default newObserver;