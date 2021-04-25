var app = new Vue({
    el: '#app', 
    data: 
    {
      googleSearch: '',
      cities: window.cities,
      isActive: 0
    },
    computed: 
    {
      filteredCities: function() 
      {
          let m = this.cities.filter(city => city.name.includes(this.googleSearch))
          if(m.length > 10)
          {
            m = m.slice(0,10);
          }
          return m
      }
    },
    methods:
    {
      zmiana: function(a)
      {
        if(this.isActive == 0)
        {
          this.isActive = 1;
          this.googleSearch = a;
          el2 = document.getElementById("autocom");
          el2.blur();
        }
      },
      pogrub: function(a)
      {
        /*a = a.bold();*/
        fraza = this.googleSearch;
        var pom = a.split(fraza);
        for(i = 0; i < pom.length; i++)
        {
          a = a.replace(pom[i], pom[i].bold());
        }
        return a;
      }
    }
  });
