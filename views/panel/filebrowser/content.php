<?php header("Content-Type: text/html;charset=UTF-8"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ziecluka - file browser for CKeditor</title>
        <meta charset="UTF-8">
        <meta name="author" content="Łukasz Zięć" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/materialize.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/custom.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo URL ?>public/js/materialize.min.js"></script>
        <script>
            // Helper function to get parameters from the query string.
            function getUrlParam(paramName) {
                var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
                var match = window.location.search.match(reParam);

                return (match && match.length > 1) ? match[1] : null;
            }
            // Simulate user action of selecting a file to be returned to CKEditor.
            function returnFileUrl($data) {

                var funcNum = getUrlParam('CKEditorFuncNum');
                var fileUrl = $data;
                window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
                window.close();
            }
        </script>
    </head>
    <body>
        <div class="row">

            <?php foreach ($this->images as $image) : ?>
                <div class="col s3 m3 l3">
                    <div class="card small">
                        <div class="card-image card-image-custom-gallery">
                            <img class="materialboxed" src="<?php echo URL . $image["path"]; ?>">
                        </div>
                        <div class="card-content card-content-custom-gallery center-align">
                            <button class="btn waves-effect waves-light" onclick="returnFileUrl('<?php echo URL . $image["path"]; ?>')">Wybierz</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </body>
</html>