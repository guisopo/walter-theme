import axios from 'axios';

const ajaxLoadMore = (scroll) => {

  const content = document.querySelector('.content-list');

    let current_page = content.dataset.page;
    let max_pages = content.dataset.max;
    let cpt = content.dataset.cpt;

    if(current_page < max_pages) {

      let params = new URLSearchParams();
  
      params.append( 'cpt', cpt );
      params.append( 'action', 'load_more_posts' );
      params.append( 'current_page', current_page );
  
      axios.post('/wp-admin/admin-ajax.php', params)
        .then( res => {
  
          content.insertAdjacentHTML("beforeend", res.data.data);
          content.dataset.page++;
          
          let getUrl = window.location;
          let baseUrl = `${getUrl.protocol}//${getUrl.host}${getUrl.pathname}page/${content.dataset.page}`;
          window.history.pushState('', '', baseUrl);
  
          scroll.setBounds();
  
        });
    }
}

export default ajaxLoadMore;