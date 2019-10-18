import axios from 'axios';

const ajaxLoadMore = (scroll) => {

  const content = document.querySelector('.content-list');

    let current_page = content.dataset.page;
    let max_pages = content.dataset.max;

    if(current_page < max_pages) {

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
  
          scroll.setBounds();
  
        });
    }
}

export default ajaxLoadMore;