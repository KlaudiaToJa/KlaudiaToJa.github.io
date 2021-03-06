<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Google</title>
        <link rel="stylesheet" href="autocompleter.css">
        <link rel="stylesheet" href="dokumentacja.css">
        <script src="https://unpkg.com/vue"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="autocompleter.js"></script>
    </head>

    <!-- PRZYKLADOWE ZASTOSOWANIE KOMPONENTU V-AUTOCOMPLETER -->
    <body>
      <h1>Autocompleter z vue.js</h1>

      <div id="app" :class="[ googleSearch.length != 0 && klik == 1 ? 'results' : klik = 0 ]">
          <v-autocompleter
            :value="googleSearch"
            @input="googleSearch = $event"
            @enter="enter"
          ></v-autocompleter>
        </div>

        <div class="opis">
        
          <h3>autocompleter.js</h3>
          <a>value() w "watch" obserwuje zmianę tekstu w input i w czasie rzeczywistym filtruje wyniki:</a>
          <pre>
          value() {
            if (this.autocompleterIsActive) {
                return;
            }
            if (this.value.length === 0) {
                filteredCities = [];
                return;
            }

            let returnedCities = [];
            let searchLowerCase = this.value.toLowerCase();
          </pre>

          <a>Podczas filtrowania wyników fragment tekstu wpisany w input zostaje pogrubiony, pozostała część zapisana jest zwykłą czcionką:</a>

          <pre>
              this.cities.some((cityData) => {
                  if (returnedCities.length === 10) {
                    return true;
                  } else if (!cityData.nameLowerCase.includes(searchLowerCase)) {
                    return false;
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
          </pre>

          <a>Dzięki metodzie "zmiana", podczas kliknięcia przycisku enter na input lub elemencie wyszukiwania, wpisuje tekst w input oraz wywołuje "enter":</a>

          <pre>
          methods:
          {
            zmiana: function(a)
            {
              if(this.isActive == 0)
              {
                this.isActive = 1;
                this.kontrol = 0;
                this.$emit('enter', this.isActive, a);
                document.activeElement.blur();
              }
            }
          </pre>

          <a>Z pomocą "kontol" kontrolowana jest konieczność wyświetlenia autocompletera - jeśli kontrol wynosi 1, argument do wyświetlenia autocompletera jest spełniony, w przeciwnym razie nie jest; wywoływana podczas kliknięcia w input:</a>

          <pre>
            ustaw: function()
            {
              this.kontrol = 1;
              this.autocompleterIsActive = false;
            }
          </pre>

          <a>Funkcjonalność strzałek "góra", "dół" pozwala na przemieszczanie się po wynikach filtrowanych podczas wpisywania danych do input:</a>

          <pre>
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
          </pre>

          <a>"props" pozwalają przekazać do autocompletera dane, w tym przypadku jest to "value", czyli tekst wpisany w input oraz "options", dzięki któremu przekazywane są dane, przez które filtruje autocompleter:</a>

          <pre>
            props: {
              value: {
                type: String,
                default: ""
              },
              options: {
                type: Array,
                default: []
              }
            }
          </pre>


          <a>Kod dla zmiennej korzystającej z komponentu przedstawia się następująco:</a>

          <xmp>
            <script type="text/javascript">
              var app = new Vue({
                el: "#app",
                data: {
                  googleSearch: "",
                  cities: window.cities,
                  klik: 0
                },
                methods: {
                  enter(akt, szuk) {
                    console.log("ENTER!");
                    this.klik = akt;
                    this.googleSearch = szuk;
                  }
                }
              });
            </script>
          </xmp>



        </div>
    </body>

    <script type="text/javascript">
      var app = new Vue({
        el: "#app",
        data: {
          googleSearch: "",
          klik: 0
        },
        methods: {
          enter(akt, szuk) {
            this.klik = akt;
            this.googleSearch = szuk;
          }
        }
      });
    </script>

</html>