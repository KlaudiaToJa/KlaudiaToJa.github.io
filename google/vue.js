var app = new Vue({
    el: '.visual1', 
    data: {
      googleSearch: ''
    }
  });

var app2 = new Vue({
    el: 'body', 
    data: {
        czyZmienic: function()
            {
              if (googleSearch === ''){
                return false;
              }
              return true;
            }
      }
  });

