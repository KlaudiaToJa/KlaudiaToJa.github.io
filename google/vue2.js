
var myBody = document.getElementsByTagName('body')[0];

var gg = new Vue({
    el: '.visual1', 
    data: {
      googleSearch: '' //działa, jeśli tutaj wpiszę jakąś liczbę :D
    }
});

var ok = gg.googleSearch;  // nie wiem, czyta tylko '', nie chce w ogóle na bieząco tego widzieć :(

function koko(){
    document.getElementById("k").innerHTML = ok;
}

if(ok > 0)
{
    myBody.classList.toggle('results');
}
