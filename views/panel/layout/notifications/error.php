<div id="error_message" class="modal red">
    <div class="row"><div class="col s12 center-align white-text">
        <div class="error-title">Wystąpił błąd!</div>
        <div class="left-align"><?php if (isset($this->error)) {echo $this->error;} ?></div>
        </div>
    </div>
</div>
<script>
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
</script>