<body class="brown lighten-5">
    <!-- Dropdown Account Start -->    
    <ul id="account-dropdown" class="dropdown-content">
        <li><a href="<?php echo URL; ?>account/profile">Profil<i class="material-icons left">account_circle</i></a></li>
        <li><a href="<?php echo URL; ?>account/settings">Ustawienia konta<i class="material-icons left">settings</i></a></li>
        <li><a href="<?php echo URL; ?>panel/logout">Wyloguj<i class="material-icons left">power_settings_new</i></a></li>
    </ul>
    <!-- Dropdown Account End -->
    <nav>
        <div class="nav-wrapper grey darken-3">
            <!-- Dropdown Account Start -->
            <ul class="left nav-left">
                <li><a data-constrainWidth="false" data-belowOrigin="true" data-inDuration="100" class="dropdown-button valign-wrapper" href="#" data-activates="account-dropdown"><img id="panel-avatar" class="left circle" src="<?php echo (empty($_SESSION["avatar"]) ? URL . "public/img/anonymous_logo.jpg" : URL . $_SESSION["avatar"]) ?>"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
            <!-- Dropdown Account End -->
            <ul class="right nav-right">
                <li><a href="<?php echo URL; ?>panel/messages">Wiadomości<i class="material-icons left">chat</i></a></li>
                <li><a href="<?php echo URL; ?>panel/notifications">Powiadomienia<i class="material-icons left">notifications</i></a></li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="row" style="height:65px;">
        
    </div>