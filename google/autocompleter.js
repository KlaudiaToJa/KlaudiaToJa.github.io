Vue.component("v-autocompleter", {
  data: function () {
    return {
      count: 0,
      isActive: 0,
      kontrol: 0,
      autocompleterIsActive: false,
      activeResult: 0,
      filteredCities: []
    };
  },
  methods:
  {
    findResultsDebounced: Cowboy.debounce(100, function findResultsDebounced() {
      fetch('http://localhost:8080/KlaudiaToJa.github.io/google/searchGoogle.php/?name=' + this.value)
          .then(data => {
              this.filteredCities = data;
          });
    }),
    /**
   * podczas kliknięcia przycisku enter na input lub elemencie wyszukiwania, wpisuje tekst w input oraz wywołuje "enter"
   */
    zmiana: function(a)
    {
      if(this.isActive == 0)
      {
        this.isActive = 1;
        this.kontrol = 0;
        this.$emit('enter', this.isActive, a);
        document.activeElement.blur();
      }
    },

    /**
   * kontroluje konieczność wyświetlenia autocompletera
   */
    ustaw: function()
    {
      this.kontrol = 1;
      this.autocompleterIsActive = false;
    },

   /**
   * funkcje strzałek – góra, dół
   */
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
    }
  },
  /**
   * props pozwalają przekazać do autocompletera dane
   */
   props: {
    value: {
      type: String,
      default: ""
    }
  },
  template: `
  <div>
      <input 
          class="inp"
          type="search" 
          maxlength="2048" 
          title="Szukaj" 
          v-on:click="ustaw()" 
          @keyup.up="strzalka(activeResult - 1)" 
          @keyup.down="strzalka(activeResult + 1)" 
          @keyup.enter="zmiana(value)"
          :value="value"
          @input="findResultsDebounced">

          {{ value }}

          <div class="auto">         
              <div id="autocom" :class="[ value.length != 0 && filteredCities.length != 0 && kontrol == 1 ? 'autocompleter' : 'bez']">
                  <ul class="resultsBox">
                      <li class="pojedynczy" v-for="(city, index) in filteredCities" :key="city" @click="zmiana(city)" :class="{active : autocompleterIsActive && activeResult === index}">
                          <img class="lupaAuto" src="lupa.png">
                          <div class="pojWyn" v-html="city">
                          </div>  
                      </li>
                  </ul>
              </div>
          </div>


  </div>    
  `
});


