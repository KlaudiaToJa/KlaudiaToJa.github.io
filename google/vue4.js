var app = new Vue({
  el: '#app', 
  data: 
  {
    googleSearch: '',
    cities: window.cities,
    isActive: 0,
    kontrol: 0,
    indeks: -1,
    zmien_kolor: 1
  },
  computed: 
  {
    filteredCities: function() 
    {
        let m = this.cities.filter(city => city.name.includes(this.googleSearch));
        if(m.length > 10)
        {
          m = m.slice(0,10);
        }
        return m;
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
        this.kontrol = 0;
      }
    },
    pogrub: function(a)
    {
      fraza = this.googleSearch;
      var pom = a.split(fraza);
      for(i = 0; i < pom.length; i++)
      {
        a = a.replace(pom[i], pom[i].bold());
      }
      return a;
    },
    ustaw: function()
    {
      this.kontrol = 1;
    },
    strzalka_gora: function()
    {
      this.googleSearch = "strzalka w gore";
    },
    strzalka_dol: function()
    {
      this.indeks = this.indeks + 1;
      let autocom = document.getElementsByClassName("resultsBox");
      let dl = autocom.length;
      autocom.childNodes[0];
      this.zmien_kolor = this.zmien_kolor + 1;
    }
  }
});