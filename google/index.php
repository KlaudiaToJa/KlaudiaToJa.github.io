<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Google</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="styleWyniki.css">
        <script src="vue4.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js" integrity="sha512-JZSo0h5TONFYmyLMqp8k4oPhuo6yNk9mHM+FY50aBjpypfofqtEWsAgRDQm94ImLCzSaHeqNvYuD9382CEn2zw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <!-- http://localhost:8080/KlaudiaToJa.github.io/google/index.php -->

    <body>

        <div id="app" :class="[ googleSearch.length != 0 && isActive == 1 ? 'results' : isActive = 0 ]">

            <div class="up">
                <div class="up_box">
                    <div class="up_items">
                        <a class="other" href="https://mail.google.com">Gmail</a>
                        <a class="other" href="https://www.google.pl/imghp?hl=pl">Grafika</a>
                        <div class="kropeczki">
                            <img class="dots" src="kropeczki.png">
                        </div>
                        <button class="blue" type="button" onclick="location.href='https://accounts.google.com/ServiceLogin/signinchooser?elo=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin'">Zaloguj się</button>
                    </div>
                </div>
            </div>

            <div class="this">
                <div class="logo">
                    <img class="google" src="logo" alt="Google" height="92" width="272">
                </div>

                <div class="search">
                    <div class="write">
                        <div class="visual1">
                            <img class="lupa" src="lupa.png">
                            <input class="inp" 
                                v-model="googleSearch" 
                                type="search" 
                                maxlength="2048" 
                                title="Szukaj" 
                                v-on:click="ustaw()"
                                @keyup.up="strzalka(activeResult - 1)" 
                                @keyup.down="strzalka(activeResult + 1)" 
                                @keyup.enter="zmiana(googleSearch)"
                                @input="findResultsDebounced">
                            <svg class="iks" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></svg>
                            <span class="kreska"></span>
                            <img class="klaw" src="klawiatura.png" title="Narzędzia do wprowadzania tekstu">
                            <svg class="lupa2" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
                            
                            
                            
                            <div class="auto">

                            
                                <div id="autocom" :class="[ googleSearch.length != 0 && filteredCities.length != 0 && kontrol == 1 ? 'autocompleter' : 'bez']">
                                    <ul class="resultsBox">
                                        <li class="pojedynczy" v-for="(city, index) in filteredCities" :key="city.name" @click="zmiana(city.name)" :class="{active : autocompleterIsActive && activeResult === index}">
                                            <img class="lupaAuto" src="lupa.png">
                                            <div class="pojWyn" v-html="pogrub(city.name)">
                                            </div>  
                                        </li>
                                    </ul>
                                </div>
                            
                            
                            
                            </div>



                        </div>
                    </div>
                    <div class="visual2">
                        <div class="buttons">
                            <button class="grey1" type="button" onclick="updateValue()">Szukaj w Google</button>
                            <button class="grey2" type="button" onclick="location.href='https://www.thecoderpedia.com/wp-content/uploads/2020/06/Programming-Memes-Programmer-while-sleeping.jpg'">Szczęśliwy traf</button>
                        </div>
                    </div>
                </div>

                <div class="language">
                    <a class="lan1">Korzystaj z Google w tych językach: </a>
                    <a class="lan2" href="https://memegenerator.net/img/instances/32369257/im-sorry-i-dont-speak-english.jpg">English</a>
                </div>
            </div>


            <div class="aplikacje">
                <div class="apki">
                    <svg class="ikonka" xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='rgba(0,0,0,.54)' d='M20.49 19l-5.73-5.73C15.53 12.2 16 10.91 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.41 0 2.7-.47 3.77-1.24L19 20.49 20.49 19zM5 9.5C5 7.01 7.01 5 9.5 5S14 7.01 14 9.5 11.99 14 9.5 14 5 11.99 5 9.5z'/></svg>
                    <a class="ap" href="https://www.youtube.com/watch?v=EFJ7kDva7JE">Wszystko</a>
                </div>
                <div class="apki">
                    <svg focusable="false" width='24' height='24' viewBox="0 0 24 24"><path d="M12 11h6v2h-6v-2zm-6 6h12v-2H6v2zm0-4h4V7H6v6zm16-7.22v12.44c0 1.54-1.34 2.78-3 2.78H5c-1.64 0-3-1.25-3-2.78V5.78C2 4.26 3.36 3 5 3h14c1.64 0 3 1.25 3 2.78zM19.99 12V5.78c0-.42-.46-.78-1-.78H5c-.54 0-1 .36-1 .78v12.44c0 .42.46.78 1 .78h14c.54 0 1-.36 1-.78V12zM12 9h6V7h-6v2"></path></svg>
                    <a class="ap" href="https://www.youtube.com/watch?v=9E6b3swbnWg">Wiadomości</a>
                </div>
                <div class="apki">
                    <svg focusable="false" width='24' height='24' viewBox="0 0 24 24"><path d="M14 13l4 5H6l4-4 1.79 1.78L14 13zm-6.01-2.99A2 2 0 0 0 8 6a2 2 0 0 0-.01 4.01zM22 5v14a3 3 0 0 1-3 2.99H5c-1.64 0-3-1.36-3-3V5c0-1.64 1.36-3 3-3h14c1.65 0 3 1.36 3 3zm-2.01 0a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h7v-.01h7a1 1 0 0 0 1-1V5"></path></svg>
                    <a class="ap" href="https://mail.google.com">Grafika</a>
                </div>
                <div class="apki">
                    <svg focusable="false" width='24' height='24' viewBox="0 0 16 16"><path d="M7.503 0c3.09 0 5.502 2.487 5.502 5.427 0 2.337-1.13 3.694-2.26 5.05-.454.528-.906 1.13-1.358 1.734-.452.603-.754 1.508-.98 1.96-.226.452-.377.829-.904.829-.528 0-.678-.377-.905-.83-.226-.451-.527-1.356-.98-1.959-.452-.603-.904-1.206-1.356-1.734C3.132 9.121 2 7.764 2 5.427 2 2.487 4.412 0 7.503 0zm0 1.364c-2.283 0-4.14 1.822-4.14 4.063 0 1.843.86 2.873 1.946 4.177.468.547.942 1.178 1.4 1.79.34.452.596.99.794 1.444.198-.455.453-.992.793-1.445.459-.61.931-1.242 1.413-1.803 1.074-1.29 1.933-2.32 1.933-4.163 0-2.24-1.858-4.063-4.139-4.063zm0 2.734a1.33 1.33 0 11-.001 2.658 1.33 1.33 0 010-2.658"></path></svg>
                    <a class="ap" href="https://www.youtube.com/watch?v=kn1gcjuhlhg">Mapy</a>
                </div>
                <div class="apki">
                    <svg focusable="false" width='24' height='24' viewBox="0 0 24 24"><path d="M10 16.5l6-4.5-6-4.5v9zM5 20h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1zm14.5 2H5a3 3 0 0 1-3-3V4.4A2.4 2.4 0 0 1 4.4 2h15.2A2.4 2.4 0 0 1 22 4.4v15.1a2.5 2.5 0 0 1-2.5 2.5"></path></svg>
                    <a class="ap" href="https://www.youtube.com/watch?v=eGbHnJCDMyE">Wideo</a>
                </div>
                <div class="apki">
                    <svg focusable="false" width='24' height='24' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path></svg>
                    <a class="ap" href="https://www.youtube.com/watch?v=z_7MGy6SaMM">Więcej</a>
                </div>
                <div class="apki">
                    <img src=""/>
                    <a class="ap" href="https://www.youtube.com/watch?v=vOXZkm9p_zY">Ustawienia</a>
                </div>
                <div class="apki">
                    <img src=""/>
                    <a class="ap" href="https://www.youtube.com/watch?v=Jpm_BOhWmbw">Narzędzia</a>
                </div>
            </div>

            <span class="kreska_pozioma"></span>

            <div class="ilosc_wynikow">
                <a>Około 199 000 000 wyników (0,29 s)</a>
            </div>

            <div class="zawartosc">

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=SMkLdYK-9IE">Cover stulecia</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            Oryginał: Coldplay, Fix you. Ludzie powiadają, że…
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=mYFaghHyMKc">Herosi? W dzisiejszych czasach?</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            Family of the Year - Hero [Official Music Video] Connect with Family of the Year Website: http://familyoftheyear.net​ Facebook: http://www.facebook.com/familyoftheyear​…
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=2X_2IdybTV0&list=PLnaO23ChFiTsh8WJxYgtsgcr9D94j4PoV">Carry on, my wayward son</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            Official audio for “Carry On Wayward Son” by Kansas Listen to Kansas: https://Kansas.lnk.to/listenYD​ Watch more videos by Kansas: https://Kansas.lnk.to/listenYD/youtube​…
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=Soa3gO7tL-c">Boulevard Of Broken Dreams</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            Watch the official music video for Boulevard Of Broken Dreams by Green Day from the album American Idiot. 🔔 Subscribe to the channel: https://www.youtube.com/c/GreenDay/?s...​
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=2jjcuRckOJc">Tajniki studenckiego umysłu</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            Słyszeliście kiedyś, że studenckie umysły podczas wykładów…
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=1kehqCLudyg">Way back home</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            🎧 Your Home For The Best Electronic Music With Lyrics! SHAUN - Way Back Home (Sam Feldt Edit) feat. Conor Maynard  Lyrics / Lyric Video brought to you by WaveMusic
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=tDukIfFzX18">Maria</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            [MV] Hwa Sa(화사) _ Maria(마리아)
                        </span>
                    </div>
                </div>

                <div class="wynik">
                    <div class="naglowek">
                        <div class="hiperlacze">
                            <div class="adres">
                                <cite class="skrot">
                                    www.youtube.com
                                    <span class="rodzaj"> › watch</span>
                                </cite>
                            </div>
                            <a class="tytul" href="https://www.youtube.com/watch?v=Sv6dMFF_yts">We Are Young</a>
                        </div>
                    </div>

                    <div class="streszczenie">
                        <span class="opis">
                            Fun.'s music video for 'We Are Young' featuring Janelle Monáe from the album, Some Nights - available now on Fueled By Ramen. Download it at http://smarturl.it/somenights​
                        </span>
                    </div>
                </div>

            </div>


            <div class="down">
                <div class="country">Polska</div>
                <div class="links">
                    <div class="el1">
                        <a class="bottom_text" href="https://www.youtube.com/watch?v=Q6zqH6qKaTU">O nas</a>
                        <a class="bottom_text" href="https://www.youtube.com/watch?v=YvszZE1TZaU">Reklamuj się</a>
                        <a class="bottom_text" href="https://plankdesign.com/wp-content/uploads/2017/01/01_2017_looking.jpg">Dla firm</a>
                        <a class="bottom_text" href="http://www.quickmeme.com/img/cb/cb2f994b1fc25f0beb20a0ec3884367e801aa5e9f48da6a3f15d91a3ef468b97.jpg">Jak działa wyszukiwarka</a>
                    </div>
                    <div class="el2">
                        <div class="neutral">
                            <img class="leaf" src="leaf.png">
                            <a class="bottom_text_nat" href="https://sustainability.google/intl/pl/commitments-europe/?utm_source=googlehpfooter&utm_medium=housepromos&utm_campaign=bottom-footer&utm_content=">Neutralność węglowa od 2007 roku</a>                        
                        </div>
                    </div>
                    <div class="el3">
                        <a class="bottom_text" href="https://memegenerator.net/img/instances/22858937/no-there-is-no-privacy.jpg">Prywatność</a>
                        <a class="bottom_text" href="https://www.agh.edu.pl/fileadmin/_migrated/COK/DOS/pliki/akty_prawne/Regulamin_pobierania_oplat_2020_tekst_ujednolicony.pdf">Warunki</a>
                        <a class="bottom_text" href="https://www.youtube.com/watch?v=9DwzBICPhdM">Ustawienia</a>    
                    </div>
                </div>

                <div class="links2">
                    <div class="elementy_dolne">
                        <a class="links2el" href="https://www.youtube.com/watch?v=GZjt_sA2eso">Pomoc</a>
                        <a class="links2el" href="https://www.youtube.com/watch?v=pBuZEGYXA6E">Prześlij opinię</a>
                        <a class="links2el" href="https://www.youtube.com/watch?v=Cz6BUM4F2tY">Prywatność</a>
                        <a class="links2el" href="https://www.youtube.com/watch?v=6tUumjx2BWw">Warunki</a>
                    </div>
                </div>
            </div>

        </div>

    </body>
    
</html>
