<?php header("Content-Type: text/html;charset=UTF-8"); ?>
<!DOCTYPE html>
<html>
<head>
    <?php echo (!empty($this->metaTitle) ? "<title>" . $this->metaTitle . " - " . SITE_NAME ."</title>" : false) ?>
    <meta charset="UTF-8">
    <meta name="author" content="Łukasz Zięć" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/materialize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/custom.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo URL ?>public/js/materialize.min.js"></script>
    <?php if(isset($this->javascript)){ echo '<script type="text/javascript" src="'.$this->javascript.'"></script>'; } ?>
    <?php if(isset($this->css)){ echo '<link rel="stylesheet" type="text/css" href="'.$this->css.'" />'; } ?>
</head>