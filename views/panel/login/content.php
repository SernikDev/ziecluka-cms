<body class="green darken-2">
    <?php if (isset($this->error)) { include PANEL_LAYOUT . "panel/layout/notifications/error.php"; } ?>
<div class="container">
    <div class="row" style="margin-top:15%">
        <div class="col s12 m8 offset-m2 l4 offset-l4">
            <div class="card z-depth-5">
                <div class="card-content">
                    <span class="card-title black-text center-align">Panel Administracyjny</span>
                    <form method="post" action="">
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Wprowadź swój login" id="login" type="text" class="validate" name="login">
                                <label for="login" class="active green-text text-darken-2 bold">Nazwa użytkownika</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Wprowadź swoje hasło" id="password" type="password" class="validate" name="password">
                                <label for="password" class="active green-text text-darken-2 bold">Hasło użytkownika</label>
                            </div>
                        </div>
                </div>
                <div class="card-action center-align">
                    <input type="submit" name="submit" class="btn z-depth-5" value="Zaloguj">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>