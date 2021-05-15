var app = new Vue({
    el: '#app', 
    data: 
    {
      googleSearch: '',
      isActive: 0,
      kontrol: 0,
      autocompleterIsActive: false,
      activeResult: 0,
      filteredCities: [],
      cities: window.cities.map((cityData) => {
        cityData.nameLowerCase = cityData.name.toLowerCase();
        return cityData;
      })
    },
    watch: 
    {
      googleSearch() {
        if (this.autocompleterIsActive) {
            return;
        }
        if (this.googleSearch.length === 0) {
            filteredCities = [];
            return;
        }
        let returnedCities = [];
        let searchLowerCase = this.googleSearch.toLowerCase();

        this.cities.forEach((cityData) => {
            if (returnedCities.length === 10 || !cityData.nameLowerCase.includes(searchLowerCase)) {
                return;
            }
            returnedCities.push({
                name: cityData.name,
                nameHtml: cityData.nameLowerCase.replace(searchLowerCase, (match) => {
                    return '<span class="bold">' + match + '</span>';
                })
            })
        });
        
        this.filteredCities = returnedCities;
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
        this.googleSearch = this.filteredCities[index].name;
      }
    }
  
  });
