<div id="success_message" class="modal green">
    <div class="row"><div class="col s12 center-align white-text">
        <div class="success-title">Sukces!</div>
        <div class="left-align"><?php if (isset($this->success)) {echo $this->success;} ?></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#success_message').modal('open');
        setTimeout(function () {
            $('#success_message').modal('close');
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