import axios from 'axios';

const ajaxLoadMore = (scroll) => {

  const button = document.querySelector('.load-more');
  const content = document.querySelector('.content-list');

  if( typeof(button) === 'undefined' || button === null ) {
    return;
  }

  button.addEventListener('click', (e) => {
    let current_page = content.dataset.page;
    let params = new URLSearchParams();

    params.append( 'action', 'load_more_posts' );
    params.append( 'current_page', current_page );

    axios.post('/wp-admin/admin-ajax.php', params)
      .then( res => {

        content.insertAdjacentHTML("beforeend", res.data.data);
        content.dataset.page++;
        
        let baseUrl = '';
        let getUrl = window.location;
        baseUrl = `${getUrl.protocol}//${getUrl.host}/page/${content.dataset.page}`;
        window.history.pushState('', '', baseUrl);

        if (content.dataset.page === content.dataset.max) {
          button.parentNode.removeChild(button);
        }

        scroll.setBounds();

      });
  });
}

export default ajaxLoadMore;