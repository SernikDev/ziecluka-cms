<div id="deletepage" class="col l3 offset-l1 modal topmodal white">
    <div class="modal-content">
        <form method="post" action="page_admin/delete">
            <div class="row">
                <div class="card-title center-align">Czy na pewno chcesz usunąć tą stronę?<a href="#!" class="modal-action modal-close right"><i class="material-icons red-text">close</i></a></div>
            </div>
            <div class="row">
                <input id="page" type="hidden" name="page-id" value="">
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
            <div class="row"><div class="col s2 card-title">Lista stron</div><a class="btn right" href="<?php echo URL; ?>page_admin/create">Dodaj stronę</a></div>
            <div class="row">
                <div class="col s6 bold">Nazwa strony</div>
                <div class="col s2 bold">Autor</div>
                <div class="col s2 bold">Data utworzenia</div>
            </div>
            <?php foreach ($this->pageList as $page) : ?>
                <div class="row">
                    <div class="col s6"><?php echo $page["page_name"]; ?></div>
                    <div class="col s2"><?php echo $page["fname"] . " " . $page["lname"]; ?></div>
                    <div class="col s2"><?php echo $page["page_create_date"]; ?></div>
                    <div class="col s2">
                        <div class="col s4>"><a title="Wyświetl stronę" href="<?php echo URL . $page["page_url"]; ?>" target="_blank"><i class="material-icons green-text">cloud</i></a></div>
                        <div class="col s4>"><a title="Edytuj stronę" href="page_admin/edit/<?php echo $page["page_id"]; ?>"><i class="material-icons orange-text">edit</i></a></div>
                        <div class="col s4>"><a data-value="<?php echo $page["page_id"]; ?>" title="Usuń stronę" href="#deletepage" class="delete-page modal-trigger"><i class="material-icons red-text">cancel</i></a></div>
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
    $('.delete-page').click(function () {
        $("#page").val(($(this).data('value')));
    });
</script>