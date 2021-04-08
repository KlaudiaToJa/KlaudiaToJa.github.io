var app = new Vue({
    el: '.visual1', 
    data: {
      googleSearch: ''
    }
  });


var app2 = new Vue({
  el: document.body, 
  data: {
    isActive: true,
    activeClass: 'results'
  }
});

// a to mi nie działa wcale prócz wypisania googleSearch które się wyświetla jak odkomentuję w html :D