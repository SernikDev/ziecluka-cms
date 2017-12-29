<div id="warning_message" class="modal orange">
    <div class="row"><div class="col s12 center-align white-text">
        <div class="success-title">Ostrzeżenie!</div>
        <div class="left-align"><?php if (isset($this->warning)) {echo $this->warning;} ?></div>
        </div>
    </div>
</div>
<script>
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
        endingTop: '10%',
    }
    );
</script>