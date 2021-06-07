var app = new Vue({
    el: '#app', 
    data: 
    {
      googleSearch: '',
      isActive: 0,
      kontrol: 0,
      activeResult: 0,
      filteredCities: [],
      autocompleterIsActive: false
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
      strzalka: function(index)
      {
        if (!this.autocompleterIsActive) {
          index = 0;
        } 

        if (index > this.filteredCities.length - 1) {
            index = 0;
        } else if (index < 0) {
            index = this.filteredCities.length - 1;
        }
        
        this.autocompleterIsActive = true;
        this.activeResult = index;
        this.value = this.filteredCities[index].name;
      },
      findResultsDebounced : Cowboy.debounce(100, function findResultsDebounced() {
        fetch('http://localhost:8080/KlaudiaToJa.github.io/google/searchGoogle.php/?name=' + this.googleSearch)
            .then(response => response.json())
            .then(data => {
                this.filteredCities = data;
            });
      })
    }
  });
