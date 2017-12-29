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


<div id="deletefile" class="col l3 offset-l1 modal topmodal white">
    <div class="modal-content">
        <form method="post" action="media/delete">
            <div class="row">
                <div class="card-title center-align">Czy na pewno chcesz usunąć ten plik?<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div>
            </div>
            <div class="row">
                <input id="file" type="hidden" name="file" value="">
            </div>
            <div class="row center-align">
                <input type="submit" class="btn waves-effect waves-light" value="Tak">
                <a href="#!" class="modal-action modal-close btn waves-effect waves-light red">Nie</a>
            </div>
        </form>
    </div>
</div>

<div class="col s12 no-padding">
    <div class="card">
        <div class="card-content">
            <div class="row"><div class="col s2 card-title">Dodaj zdjęcia</div></div>
            <div class="row">
                <form action="media/add" enctype="multipart/form-data" method="post">
                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>Wybierz plik</span>
                            <input type="file" name="image[]" multiple="multiple">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Dodaj jedno lub więcej zdjęć - maksymalnie 60MB, rozmiar jednego zdjęcia nie większe niż 6MB">
                        </div>
                    </div>
                    <input id="uploadFiles" class="btn blue" type="submit" value="Prześlij na serwer">
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="row"><div class="col s2 card-title">Galeria zdjęć</div></div>
            <div class="row">
                <div class="row col s12">
                    <?php foreach ($this->media as $media) : ?>
                        <div class="col s6 m6 l6">
                            <div class="card small">
                                <div class="card-image">
                                    <img class="materialboxed" src="<?php echo URL . $media["path"]; ?>">
                                </div>
                                <div class="card-content">
                                    <button data-value="<?php echo $media["id"]; ?>" class="btn-floating right waves-effect waves-light red"><a href="#deletefile" class="modal-trigger"><i class="material-icons">delete_forever</i></a></button>
                                    <p><strong>Nazwa:</strong> <?php echo $media["filename"]; ?></p>
                                    <p><strong>Data utworzenia:</strong> <?php echo $media["upload_date"]; ?></p>
                                    <p><strong>Rozmiar:</strong> <?php echo number_format($media["size"] / 1048576, 2, ',', ''); ?> MB</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function () {
        $(".modal").modal();
        $("#uploadProgress").modal('close');
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
    $(document).ready(function () {
        $('#warning_message').modal('open');
        setTimeout(function () {
            $('#warning_message').modal('close');
        }, 5000);
    });
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 200,
        outDuration: 200,
        startingTop: '4%',
        endingTop: '10%'
    }
    );

    $('button').click(function () {
        $("#file").val(($(this).data('value')));
    });

    $('#uploadFiles').click(function () {
        $('#uploadProgress').modal('open');
    });
</script>