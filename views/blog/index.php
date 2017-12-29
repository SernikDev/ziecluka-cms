<body class="green">
    <div class="row col s12">
        <div class="card col s6 l6 m6 offset-s3 offset-m3 offset-l3">
            <div class="card-title">
                <h2 class="teal-text center-align">Strona testowa Blog ziecluka</h2>
            </div>
        </div>
    </div>
    <div class="row col s12">
        <div class="card col s6 l6 m6 offset-s3 offset-m3 offset-l3">
            <div class="card-title">
                <h3><?php echo $this->blog[0]["blog_name"]; ?></h3>
                <p style="font-size:14px;">Data utworzenia: <?php echo $this->blog[0]["blog_create_date"] . ", <span class='blue-text'>" . $this->blog[0]["fname"] . " " .  $this->blog[0]["lname"]; ?></span></p>
                <div class="card-image col s8 offset-s2 center-align">
                    <img src="<?php echo URL . $this->blog[0]["path"]; ?>">
                </div>
                <div class="card-content col s12 l12 m12">
                    <p><?php echo $this->blog[0]["blog_content"]; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>