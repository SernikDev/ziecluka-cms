<?php header("Content-Type: text/html;charset=UTF-8"); ?>
<!DOCTYPE html>
<html class="js">
<head>
    <?php echo (!empty($this->metaTitle) ? "<title>" . $this->metaTitle . " - " . SITE_NAME ."</title>" : false) ?>
    <meta charset="UTF-8">
    <meta name="author" content="Łukasz Zięć" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/materialize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/custom.css?ver-4" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL ?>public/js/materialize.min.js"></script>
    <?php if(isset($this->javascript)){ echo '<script type="text/javascript" src="'. URL . $this->javascript.'"></script>'; } ?>
    <?php if(isset($this->css)){ echo '<link rel="stylesheet" type="text/css" href="'. URL . $this->css.'?ver-4" />'; } ?>
</head>
<script>
$(window).on('load', function() {
    $("#preloader").fadeOut('slow');
});
</script>