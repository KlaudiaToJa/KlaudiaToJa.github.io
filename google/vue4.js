var app = new Vue({
    el: '#app', 
    data: {
      googleSearch: '',
      cities: window.cities
    },
    computed: {
      filteredCities: function() {
          let m = this.cities.filter(city => city.name.includes(this.googleSearch))
          if(m.length > 10){
            return m.slice(0,11);
          }
          return m
        }
      }
  });