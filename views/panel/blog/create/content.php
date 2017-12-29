<div class="col s8 no-padding">
    <div class="card">
        <div class="card-content">
            <div id="setimage" class="modalgallery modal topmodal white">
                <div class="modal-content">
                    <div class="row">
                        <div class="card-title center-align">Wybierz zdjęcie przewodnie<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div>
                    </div>
                    <div class="row">

                        <?php foreach ($this->images as $image) : ?>
                            <div class="col s3 m3 l3">
                                <div class="card small">
                                    <div class="card-image card-image-custom-gallery">
                                        <img class="materialboxed" src="<?php echo URL . $image["path"]; ?>">
                                    </div>
                                    <div class="card-content card-content-custom-gallery center-align">
                                        <button data-value="<?php echo $image["id"]; ?>" data-src="<?php echo URL . $image["path"]; ?>" class="btn waves-effect waves-light modal-action modal-close">Wybierz zdjęcie</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <form method="post" action="add">
                <input id="image" type="hidden" name="image" value="">
                <div class="row"><div class="col s6 card-title">Podstawowe dane</div></div>
                <div class="row"><div class="input-field col s6"><input required name="blog-title" id="blog-title" type="text" class="validate"><label for="blog-title">Nazwa wpisu</label></div></div>
                <div class="row">
                    <div class="input-field col s9"><textarea data-length="200" name="blog-short-text" id="blog-short-text" type="text" class="materialize-textarea"></textarea><label for="blog-short-text">Krótki opis</label></div>
                </div>
                <div class="row">
                    <div class="col s4"><a href="#setimage" class="btn modal-trigger">Wybierz zdjęcie<i class="material-icons right">image</i></a></div>
                    <div class="col s5">
                        <img id="showMainImage" class="responsive-img" src="" style="display:none;" />
                    </div>
                </div>
                <div class="row"><textarea class="no-padding" name="blog-content" id="editor1"></textarea></div>
        </div>
    </div>
</div>
<div class="col s8 no-padding">
    <div class="card">
        <div class="card-content">
            <div class="row"><div class="col s12 card-title">Dane SEO</div></div>
            <div class="row">
                <div class="input-field col s6"><i class="prefix material-icons tooltipped pointer" data-position="top" data-delay="10" data-tooltip="Powinien zawierać do 70 znaków, poczytaj o META TITLE">help</i><input name="seo-title" data-length="70" id="seo-title" type="text" class="validate"><label for="seo-title">Tytuł Seo</label></div>
                <div class="input-field col s6"><i class="prefix material-icons tooltipped pointer" data-position="top" data-delay="10" data-tooltip="Pozostaw puste jeżeli system ma sam ustawlić adres URL">help</i><input name="seo-url" id="seo-url" type="text" class="validate"><label for="seo-url">Adres URL</label></div>
            </div>
            <div class="row">
                <div class="input-field col s12"><i class="prefix material-icons tooltipped pointer" data-position="top" data-delay="10" data-tooltip="Powinien zawierać do 160 znaków, poczytaj o META DESCRIPTION">help</i><input name="seo-description" data-length="160" id="seo-description" type="text" class="validate"><label for="seo-description">Opis Seo</label></div>
            </div>
            <div class="row">
                <input class="btn right" type="submit" value="Zapisz">
            </div>
        </div>
        </form>

        <script>
            CKEDITOR.replace('editor1', {
                filebrowserBrowseUrl: '<?php echo $this->fileBrowser; ?>',
                filebrowserUploadUrl: ''
            });
        </script>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".modal").modal();
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
    $('button').click(function () {
        $("#image").val(($(this).data('value')));
        var x = ($(this).data('src'));
        $("#showMainImage").attr("src", x);
        $("#showMainImage").show();
    });
</script>