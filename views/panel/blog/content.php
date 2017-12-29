<div id="deletearticle" class="col l3 offset-l1 modal topmodal white">
    <div class="modal-content">
        <form method="post" action="blog_admin/delete">
            <div class="row">
                <div class="card-title center-align">Czy na pewno chcesz usunąć ten artykuł?<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div>
            </div>
            <div class="row">
                <input id="article" type="hidden" name="article-id" value="">
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
            <div class="row"><div class="col s2 card-title">Lista wpisów</div><a class="btn right" href="<?php echo URL; ?>blog_admin/create">Dodaj wpis</a></div>
            <div class="row">
                <div class="col s6 bold">Nazwa wpisu</div>
                <div class="col s2 bold">Autor</div>
                <div class="col s2 bold">Data utworzenia</div>
            </div>
            <?php foreach ($this->blogList as $blog) : ?>
                <div class="row">
                    <div class="col s6"><?php echo $blog["blog_name"]; ?></div>
                    <div class="col s2"><?php echo $blog["fname"] . " " . $blog["lname"]; ?></div>
                    <div class="col s2"><?php echo $blog["blog_create_date"]; ?></div>
                    <div class="col s2">
                        <div class="col s4>"><a title="Wyświetl artykuł" href="<?php echo URL . $blog["blog_url"]; ?>" target="_blank"><i class="material-icons green-text">cloud</i></a></div>
                        <div class="col s4>"><a title="Edytuj artykuł" href="blog_admin/edit/<?php echo $blog["blog_id"]; ?>"><i class="material-icons orange-text">edit</i></a></div>
                        <div class="col s4>"><a data-value="<?php echo $blog["blog_id"]; ?>" title="Usuń artykuł" href="#deletearticle" class="delete-article modal-trigger"><i class="material-icons red-text">cancel</i></a></div>
                    </div>
                </div>
            <?php endforeach; ?>
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
    $('.delete-article').click(function () {
        $("#article").val(($(this).data('value')));
    });
</script>