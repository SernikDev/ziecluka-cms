<!-- START -->
<div class="row p1">
    <div class="row center white-text">
        <div class="container">
            <div class="col s12">
                <h1 class="go">Programowanie webowe</h1>
            </div>
            <div class="row">
                <div class="col xl12 l8 m10 s12 offset-l2 offset-m1">
                    <img class="circle col xl2 m4 s6 offset-xl5 offset-m4 offset-s3 goimg" src="<?php echo URL ?>upload/images/avatar/lz-1.jpg" />
                </div>
            </div>
            <div class="row">
                <div class="col m6 s8 offset-m3 offset-s2">
                    <div class="col xl6 l8 m10 s12 offset-xl3 offset-l2 offset-m1 goimg no-padding">
                        <div class="col s3"><a href="https://www.facebook.com/ziecluka"><i class="fa fa-facebook"></i></a></div>
                        <div class="col s3"><a href="https://github.com/SernikDev"><i class="fa fa-github"></i></a></div>
                        <div class="col s3"><a href="https://www.linkedin.com/in/lukasz-ziec/"><i class="fa fa-linkedin"></i></a></div>
                        <div class="col s3"><a href="https://stackoverflow.com/users/6270466/l-z"><i class="fa fa-stack-overflow"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="row col s12">
                <div id="h1"><span>{ </span>Techniczny blog<span> }</span></div>
            </div>
            <div class="row col s12">
                <div id="h2"><span>{ </span>Ciekawe projekty<span> }</span></div>
            </div>
            <div class="row col s12">
                <div id="h3"><span>{ </span>Pełny source code do wglądu i wykorzystania<span> }</span></div>
            </div>
            <div class="row col s12">
                <div id="h4"><span>{ </span>Zapraszam do kontaktu!<span> }</span></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        if ($(window).width() < 700 && $(window).width() > 400) {
            $(".go").animate({
                fontSize: "40px"
            }, 2000);
        } else if ($(window).width() <= 400) {
            $(".go").animate({
                fontSize: "28px"
            }, 2000);
        } else {
            $(".go").animate({
                fontSize: "50px"
            }, 2000);
        }
        $(".goimg").delay(2000).animate({
            opacity: "1"
        }, 2000);
        $("#h1").delay(3000).animate({
            marginRight: "0",
            marginLeft: "0"
        }, 200);
        $("#h2").delay(3200).animate({
            marginRight: "0",
            marginLeft: "0"
        }, 200);
        $("#h3").delay(3400).animate({
            marginRight: "0",
            marginLeft: "0"
        }, 200);
        $("#h4").delay(3600).animate({
            marginRight: "0",
            marginLeft: "0"
        }, 200);
    });
</script>
<div class="section scrollspy">
    <div class="container">
        <div class="row">
            <div class="col l8 m10 s12 offset-l2 offset-m1">
                <div class="card hoverable">
                    <div class="card-content">
                        <div class="row">
                            <div class="card-title center">
                                <h2 class="blue-text">Bądź na bieżąco!</h2>        
                            </div>
                            <p class="flow-text justify-algin">Już teraz zapisz się do newslettera, aby otrzymywać powiadomienia o nowych wpisach oraz projektach.</p>
                        </div>
                        <form id="newsletter" action="xhr/SignToNewsletter" method="POST">
                            <div class="row">
                                <div class="input-field col l8 m10 s12 offset-l2 offset-m1">
                                    <input id="name" name="name" type="text" data-required="required" data-type="text">
                                    <label for="name">Wprowadź swoje imię</label>
                                </div>
                                <div class="input-field col l8 m10 s12 offset-l2 offset-m1">
                                    <input id="email" name="email" type="text" data-required="required" data-type="email">
                                    <label for="email">Wprowadź swój adres e-mail</label>
                                </div>
                                <div class="input-field col l8 m10 s12 offset-l2 offset-m1 center">
                                    <input id="submit" class="btn green darken-4 tooltipped" type="submit" value="Zapisz się!" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END -->

<!-- BLOG START -->
<div class="section scrollspy" id="blog">
    <div class="parallax-container valign-wrapper hide-on-small-only">
        <div>
            <div class="container">
                <div class="row center">
                    <h2 class="blue-text paralax-title">Blog ze świata Informatyki</h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="<?php echo URL ?>public/img/programowanie-webowe-1.jpg"></div>
    </div>
    <div class="row">
        <div class="container justify-algin">
            <i class="material-icons left green-text text-darken-4 header-icon">forum</i>
            <h3 class="blue-text">Najnowsze wpisy</h3>
            <div class="flow-text">
                <p>Na moim blogu będzie można znaleźć wszelkiego rodzaju poradniki z zakresu programowania webowego, testy i recenzje sprzętu komputerowego oraz nowiniki ze świata Informatyki, a to wszystko napisane w prostym i przystępnym języku.</p>
                <p>Jeżeli masz problem z pewnym zagadnieniem informatycznym, którego rozwiązania nie ma w Internecie to zapraszam do kontaktu, może akurat Twój problem zostanie ciekawym artykułem z gotowym rozwiązaniem na moim blogu!</p>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($this->blog as $blog): ?>
            <!-- Article Start -->
            <div class="col xl3 l6 s12">
                <div class="card large h600 hoverable">
                    <div class="card-image h50">
                        <a href="<?php echo $blog["blog_url"] ?>"><img src="<?php echo URL . $blog["path"] ?>"></a>
                    </div>
                    <div class="card-content">
                        <span class="card-title"><a href="<?php echo $blog["blog_url"] ?>"><?php echo $blog["blog_name"] ?></a></span>
                        <p class="justify-algin"><?php echo $blog["blog_short_text"] ?>...</p>
                    </div>
                    <div class="card-action valign-wrapper">
                        <img id="panel-avatar" class="left circle" src="<?php echo (empty($blog["avatar"]) ? URL . "public/img/anonymous_logo.jpg" : URL . $blog["avatar"]) ?>">
                        <span class="blue-text"><?php echo $blog["fname"] . " " . $blog["lname"]; ?></span>
                        <span class="grey-text right-flex"><?php echo $blog["blog_create_date"] ?></span>
                    </div>
                </div>
            </div>
            <!-- Article End -->
        <?php endforeach; ?>
    </div>
    <div class="row center">
        <h4 class="blue-text lighter">To nie wszystko... Więcej artykułów można znaleźć na moim blogu!</h4>
    </div>
    <div class="row center">
        <a href="" class="waves-effect waves-light btn-large green darken-4 tooltipped">PRZEJDŹ DO BLOGA</a>
    </div>
</div>
<!-- BLOG END -->

<!-- PROJEKTY START -->
<div class="section scrollspy" id="project">
    <div class="parallax-container valign-wrapper hide-on-small-only">
        <div>
            <div class="container">
                <div class="row center">
                    <h2 class="blue-text paralax-title">Moje skromne portfolio</h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="<?php echo URL ?>public/img/projects-library.jpeg"></div>
    </div>
    <div class="row">
        <div class="container">
            <i class="material-icons left green-text text-darken-4 header-icon">code</i>
            <h3 class="blue-text">Projekty</h3>
            <div class="flow-text justify-algin">
                <p>Moim pierwszym poważnym projektem związanym z programowaniem webowym było utworzenie własnego systemu CMS (System zarządzenia treścią), który jest przez mnie cały czas rozbudowywany o nowe funkcje.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col xl10 s12 offset-xl1">
            <div class="row">
                <h4 class="blue-text lighter center">Języki, które głównie wykorzystuje w swoich projektach</h4>
            </div>
            <div class="row">
                <div class="col l4 m6 s12">
                    <div class="card h200 indigo white-text">
                        <div class="card-title center">
                            <div class="lang">{ PHP }</div>
                        </div>
                        <div class="card-content btw justify-algin">
                            <p>PHP w wersji 5.6+ z wykorzystaniem obietkowego oraz strukturalnego stylu programowania. Wzorce projektowe: MVC (Model View Controller)</p>
                        </div>
                    </div>
                </div>
                <div class="col l4 m6 s12">
                    <div class="card h200 yellow accent-4 white-text">
                        <div class="card-title center">
                            <div class="lang">{ JavaScript }</div>
                        </div>
                        <div class="card-content btw justify-algin">
                            <p>JavaScript w postaci front-end w celu zapewnienia lepszej interakcji z aplikacją. Wykorzystywane biblioteki: JQuery, Ajax</p>
                        </div>
                    </div>
                </div>
                <div class="col l4 m6 s12 offset-m3">
                    <div class="card h200 red white-text">
                        <div class="card-title center">
                            <div class="lang">{ SQL }</div>
                        </div>
                        <div class="card-content btw justify-algin">
                            <p>Tworzenie relacyjnych baz danych z wykorzystaniem silnika baz danych MySQL firmy Oracle oraz MSSQL firmy Microsoft.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col l4 m6 s12 offset-xl2 offset-l2">
                    <div class="card h200 orange white-text">
                        <div class="card-title center">
                            <div class="lang">{ HTML }</div>
                        </div>
                        <div class="card-content btw justify-algin">
                            <p>HTML5 z wykorzystaniem frameworka Materialize, który pozwala na tworzenie responsywnych oraz przejrzystych stron w oparciu o styl Material.</p>
                        </div>
                    </div>
                </div>
                <div class="col l4 m6 s12">
                    <div class="card h200 blue white-text">
                        <div class="card-title center">
                            <div class="lang">{ CSS }</div>
                        </div>
                        <div class="card-content btw justify-algin">
                            <p>Bazuję w oparciu o styl Material Design, który został opracowany przez firmę Google. Wykorzystywane biblioteki: Materialize</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row center">
        <h4 class="blue-text lighter">Wszystkie moje projekty, można obejrzeć właśnie tutaj!</h4>
    </div>
    <div class="row center">
        <a href="#" class="waves-effect waves-light btn-large green darken-4 tooltipped">ZOBACZ PROJEKTY</a>
    </div>
</div>
<!-- PROJEKTY END -->

<!-- AUTHOR START -->
<div class="section scrollspy" id="author">
    <div class="parallax-container valign-wrapper hide-on-small-only">
        <div>
            <div class="container">
                <div class="row center">
                    <h2 class="blue-text paralax-title">Kilka słów o autorze</h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="<?php echo URL ?>public/img/aboutme.jpeg"></div>
    </div>
    <div class="row">
        <div class="container">
            <i class="material-icons left green-text text-darken-4 header-icon">person</i>
            <h3 class="blue-text">O Autorze</h3>
            <div class="row">
                <div class="col l12 m10 s12 offset-m1">
                    <img class="circle col xl2 m4 s6 offset-xl5 offset-m4 offset-s3" src="<?php echo URL ?>upload/images/avatar/lz-1.jpg" />
                </div>
            </div>
            <div class="flow-text justify-algin">
                <p>Mam na imię Łukasz i jestem założycielem tej strony internetowej. Moim hobby jest programowanie, dlatego postanowoiłem stworzyć małą przestrzeń w Internecie w której będę dzielił się swoimi pracami.</p>
                <p>Pasjonat gier komputerowych, fan Gwiezdnych Wojen (według mnie Snoke nadal żyje!), miłośnik książek o tematyce przygodowej, osoba lubiąca wyzwania - kilka słów wstępem na temat mojej osoby.</p>
            </div>
        </div>
    </div>
    <div class="row center">
        <div class="blue-text">
            <h4 class="lighter">Więcej informacji na mój temat możesz przeczytać tutaj!</h4>
        </div>
    </div>
    <div class="row center">
        <a href="#" class="waves-effect waves-light btn-large green darken-4 tooltipped">ZOBACZ BIOGRAFIĘ</a>
    </div>
</div>
<!-- AUTHOR END -->

<!-- CONTACT START -->
<div class="section scrollspy" id="contact">
    <div class="parallax-container valign-wrapper hide-on-small-only">
        <div>
            <div class="container">
                <div class="row center">
                    <h2 class="blue-text paralax-title">Zostaw wiadomość, skrzynka się ucieszy</h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="<?php echo URL ?>public/img/feedback.jpg"></div>
    </div>
    <div class="row">
        <div class="container">
            <i class="material-icons left green-text text-darken-4 header-icon">email</i>
            <h3 class="blue-text">Kontakt</h3>
            <div class="flow-text justify-algin">
                <p>Jeżeli chcesz mi zostawić wiadomość lub zasugerować ciekawy temat na bloga to poprzez wypełnienie poniższego formularza masz pewność, że ta wiadomość trafi do mnie.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="col xl8 l10 s12 offset-xl2 offset-l1">
                <div class="card hoverable">
                    <div class="card-content">
                        <div class="row">
                            <div class="card-title center">
                                <h4 class="blue-text lighter">Formularz kontaktowy</h4>
                            </div>
                        </div>
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="input-field col xl8 m10 s12 offset-xl2 offset-m1">
                                    <input id="fk-name" name="fk-name" type="text" data-required="required" data-type="text">
                                    <label for="fk-name">Wprowadź swoje imię</label>
                                </div>
                                <div class="input-field col xl8 m10 s12 offset-xl2 offset-m1">
                                    <input id="fk-email" name="fk-email" type="text" data-required="required" data-type="email">
                                    <label for="fk-email">Wprowadź swój adres e-mail</label>
                                </div>
                                <div class="input-field col xl8 m10 s12 offset-xl2 offset-m1">
                                    <input id="fk-topic" name="fk-topic" type="text" data-required="required" data-type="text">
                                    <label for="fk-topic">Temat wiadomości</label>
                                </div>
                                <div class="input-field col xl8 m10 s12 offset-xl2 offset-m1">
                                    <textarea id="fk-message" class="materialize-textarea" data-required="required" data-type="text"></textarea>
                                    <label for="fk-message">Treść wiadomości</label>
                                </div>
                                <div class="input-field col xl8 m10 s12 offset-xl2 offset-m1 center">
                                    <input class="btn green darken-4 tooltipped" type="submit" value="Wyślij" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTACT END -->

<!-- Back to top -->
<a href="#" class="btn-floating btn-large waves-effect waves-light black scrollToTop" style="display: none;"><i class="material-icons">keyboard_arrow_up</i></a>