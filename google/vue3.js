
var myBody = document.getElementsByTagName('body')[0];

const input = document.querySelector('input');
input.addEventListener('change', updateValue);

function updateValue(e)  // działa przy kliknięciu entera i przycisku Szukaj w Google
{
    if(e.target.value != '')
    {
        myBody.classList.toggle('results');
    }
    else
    {
        myBody.classList.remove('results');
    }
}

// https://forum.vuejs.org/t/how-do-i-add-remove-classes-to-body/1219/15







// z includes googlesearch, a jak się odwołujemy to do costam.name.length, bo musimy się do środka dostać :)