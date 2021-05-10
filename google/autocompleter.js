Vue.component("v-autocompleter", {
    
    template: '<div class="auto"><input class="inp" v-model="googleSearch" v-bind:value="googleSearch" type="search" maxlength="2048" title="Szukaj" v-on:click="ustaw()"><div id="autocom" :class="[ googleSearch.length != 0 && filteredCities.length != 0 && kontrol == 1 ? "autocompleter" : "bez"]"> <ul class="resultsBox"> <li class="pojedynczy" v-for="city in filteredCities" v-on:click="zmiana(city.name)"> <img class="lupaAuto" src="lupa.png"> <div class="pojWyn" v-html="pogrub(city.name)"> </div> </li></ul></div></div>',
  


    props: ['options'],
  


    data: function()
    {
      return
      {
        googleSearch: ''
        kontrol: 0
      }
    },



    computed: 
    {
      filteredCities: function() 
      {
          let m = this.options.filter(city => options.name.includes(this.googleSearch));
          if(m.length > 10)
          {
            m = m.slice(0,10);
          }
          return m;
      }
    },



    methods:
    {
      pogrub: function(a)
      {
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















