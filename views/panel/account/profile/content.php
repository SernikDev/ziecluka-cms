<div class="col s5 no-padding">
    <div class="card">
    <div class="card-content">
        <div class="row"><div class="col s6 card-title">Dane konta</div></div>
        <?php foreach($this->accountProfile as $account): ?>
        <div class="row"><img class="col s5 circle" src="<?php echo (empty($this->accountProfile[0]["path"])) ? URL . "public/img/anonymous_logo.jpg" : URL . $this->accountProfile[0]["path"] ?>"></div>
        <div class="row"><div class="col s6">Login</div><div class="col s6 grey-text"><?php echo $account['login'] ?></div></div>
        <div class="row"><div class="col s6">Imię</div><div class="col s6 grey-text"><?php echo $account['fname'] ?></div></div>
        <div class="row"><div class="col s6">Nazwisko</div><div class="col s6 grey-text"><?php echo $account['lname'] ?></div></div>
        <div class="row"><div class="col s6">E-Mail</div><div class="col s6 grey-text"><?php echo $account['email'] ?></div></div>
        <div class="row"><div class="col s6">Płeć</div><div class="col s6 grey-text"><?php echo ($account['sex'] == 2) ? "mężczyzna" : "kobieta"; ?></div></div>
        <div class="row"><div class="col s6">Wiek</div><div class="col s6 grey-text"><?php echo $this->age ?></div></div>
        <div class="row"><div class="col s6">Data urodzenia</div><div class="col s6 grey-text"><?php echo $account['born_date'] ?></div></div>
        <div class="row"><div class="col s6">Data rejestracji</div><div class="col s6 grey-text"><?php echo $account['account_creation'] ?></div></div>
        <?php endforeach; ?>
    </div>
    </div>
    </div>
</div>