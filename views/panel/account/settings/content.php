<div class="modal topmodal" id="uploadProgress">
    <div class="modal-content">
        <div class="row">
            <div class="col s2 offset-s5">
                <div id="loader-icon" class="preloader-wrapper active">
                    <div class="spinner-layer spinner-red-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                    </div>
                    </div>

        </div>
        <div class="row">
            <div class="s12">
            <div class="center-align">Trwa wysyłanie, proszę czekać...</div>
        </div>
    </div>
    </div>
</div>

<div class="col s5 no-padding">
    <div class="card">
        <div class="card-content">
            <div class="row"><div class="col s12 card-title">Zmień podstawowe dane konta</div></div>
            <?php foreach ($this->accountProfile as $account): ?>
                <div class="row"><div class="col s6">Login</div><div class="col s5 grey-text"><?php echo $account['login'] ?></div><a class="modal-trigger black-text" title="Zmień swój login" href="#login"><i class="material-icons right pointer greenhover">edit</i></a></div>
                <div class="row"><div class="col s6">Imię</div><div class="col s5 grey-text"><?php echo $account['fname'] ?></div><a class="modal-trigger black-text" title="Zmień swoje imię" href="#first-name"><i class="material-icons right pointer greenhover">edit</i></a></div>
                <div class="row"><div class="col s6">Nazwisko</div><div class="col s5 grey-text"><?php echo $account['lname'] ?></div><a class="modal-trigger black-text" title="Zmień swoje nazwisko" href="#last-name"><i class="material-icons right pointer greenhover">edit</i></a></div>
                <div class="row"><div class="col s6">E-Mail</div><div class="col s5 grey-text"><?php echo $account['email'] ?></div><a class="modal-trigger black-text" title="Zmień swój e-mail" href="#e-mail"><i class="material-icons right pointer greenhover">edit</i></a></div>
                <div class="row"><div class="col s6">Płeć</div><div class="col s5 grey-text"><?php echo ($account['sex'] == 2) ? "mężczyzna" : "kobieta"; ?></div><a class="modal-trigger black-text" title="Zmień swoją płeć" href="#gender"><i class="material-icons right pointer greenhover">edit</i></a></div>
                <div class="row"><div class="col s6">Data urodzenia</div><div class="col s5 grey-text"><?php echo $account['born_date'] ?></div><a class="modal-trigger black-text" title="Zmień swoją datę urodzenia" href="#born-date"><i class="material-icons right pointer greenhover">edit</i></a></div>
            <?php endforeach; ?>
            <div id="login" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changeLogin"><div class="row"><div class="card-title center-align">Zmień swój login<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><input required class="col l8 offset-l2 center" name="login" type="text"></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>
            <div id="first-name" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changeFirstName"><div class="row"><div class="card-title center-align">Zmień swoje imię<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><input required class="col l8 offset-l2 center" name="first-name" type="text"></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>
            <div id="last-name" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changeLastName"><div class="row"><div class="card-title center-align">Zmień swoje nazwisko<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><input required class="col l8 offset-l2 center" name="last-name" type="text"></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>
            <div id="e-mail" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changeEMail"><div class="row"><div class="card-title center-align">Zmień swój e-mail<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><div class="col l8 offset-l2 input-field inline"><input required placeholder="np. example@example.com" class="center validate" name="e-mail" type="email" id="email"><label for="email" data-error="Niepoprawny format email" data-success="Poprawny format email"></label></div></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>
            <div id="gender" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changeGender"><div class="row"><div class="card-title center-align">Zmień swoją płeć<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><input name="gender" type="radio" id="men" value="2" class="with-gap" /><label for="men">Mężczyzna</label></div><div class="row"><input name="gender" type="radio" id="women"  value="1" class="with-gap" /><label for="women">Kobieta</label></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>
            <div id="born-date" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changeBornDate"><div class="row"><div class="card-title center-align">Zmień swoją datę urodzenia<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><input required class="col l8 offset-l2 center validate" name="born-date" type="date"></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>
            <div id="password" class="col l3 offset-l1 modal topmodal white"><div class="modal-content"><form method="post" action="changePassword"><div class="row"><div class="card-title center-align">Zmień swoje hasło<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div><div class="row"><input required placeholder="Stare hasło" class="col l8 offset-l2 center" name="old-password" type="password"></div><div class="row"><input required placeholder="Nowe hasło" class="col l8 offset-l2 center" name="new-password" type="password"></div><div class="row center-align"><button type="submit" class="btn waves-effect waves-light">Zapisz</button></div></form></div></div>

            <div id="add-avatar" class="col l3 offset-l1 modal topmodal white">
                <div class="modal-content">
                    <div class="row"><div class="col s12 card-title center-align">Dodaj zdjęcie<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div></div>
                    <div class="row">
                        <form action="addAvatar" enctype="multipart/form-data" method="post">
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span>Wybierz plik</span>
                                    <input type="file" name="image[]">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Dodaj jedno zdjęcie">
                                </div>
                            </div>
                            <input id="uploadFiles" class="btn blue" type="submit" value="Prześlij na serwer">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="col s3">
    <div class="card">
        <div class="card-content">
            <div class="row"><div class="col s12 card-title">Zmień hasło do konta</div></div>
            <div class="row"><div class="col s12 justify-algin"><p>Aby dokonać zmiany hasła, będzie wymagane wprowadzenie bieżącego hasła.</p><br /><p>Nie używaj haseł z innych witryn ani czegoś zbyt oczywistego (np. imienia Twojego ulubionego zwierzaka).</p><br /></div>
                <div class="row"><a class="modal-trigger" href="#password"><div class="btn input-field right">Zmień hasło</div></a></div>
            </div>
        </div>
    </div>
</div>
<div class="col s3 no-padding">
    <div class="card">
        <div class="card-content">
            <div class="row"><div class="col s12 card-title">Ustaw zdjęcie profilowe</div></div>
            <div class="row">
                <img class="col s5 circle" src="<?php echo (empty($this->accountProfile[0]["path"])) ? URL . "public/img/anonymous_logo.jpg" : URL . $this->accountProfile[0]["path"] ?>">
            </div>
            <div class="row">
                <div class="col s12 justify-algin">Zdjęcie profilowe pojawia się na stronie głównej oraz blogu.</div>
            </div>
            <div class="row">
                <a class="modal-trigger" href="#add-avatar"><div class="btn input-field blue">Dodaj nowe</div></a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".modal").modal();
    });
    $(document).ready(function () {
        $('#success_message').modal('open');
        setTimeout(function () {
            $('#success_message').modal('close');
        }, 5000);
    });
    $(document).ready(function () {
        $('#error_message').modal('open');
        setTimeout(function () {
            $('#error_message').modal('close');
        }, 5000);
    });
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 200,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%',
    }
    );

    $('#uploadFiles').click(function () {
        $('#uploadProgress').modal('open');
        $('#add-avatar').modal('close');
    });
</script>