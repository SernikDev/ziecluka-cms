<div class="col s8 no-padding">
    <div class="card">
        <div class="card-content">
            <form method="post" action="add">
                <div class="row"><div class="col s6 card-title">Podstawowe dane</div></div>
                <div class="row"><div class="input-field col s6"><input required name="page-title" id="page-title" type="text" class="validate"><label for="page-title">Nazwa strony</label></div></div>
                <div class="row"><textarea class="no-padding" name="page-content" id="editor1"></textarea></div>
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
</script>