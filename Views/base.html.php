<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Espace client | CEGAPE <?= $title ?></title>

        <link rel="icon" type="image/png" href="conf/favicon.png" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="webroot/open-iconic/font/css/open-iconic-bootstrap.min.css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
        <?= $stylesheets ?>
    </head>
    <body>
        <div id="menus">
            <?= $menus ?>
        </div>

        <div id="content">
            <div class="container" style="margin-top:50px">
                <?php
                    $alertMessages = AlertMessage::getInstance();
                    $alertMessages->loadMessages();
                    $alertMessages = $alertMessages->getMessagesList();
                    foreach($alertMessages as $alertMessage): ?>
                        <div class="<?= $alertMessage['class'] ?>" role="alert">
                            <h4 class="alert-heading"><?= $alertMessage['title'] ?></h4>
                            <?= $alertMessage['content'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php endforeach ?>
            </div>
            <?= $content ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <script>
            function marqueelike() {
                $('.messagedefilant').each(function() {
                    var texte = $(this).html();
                    $(this).html('<div><span>' + texte + '</span><span>' + texte + '</span></div>');
                });
            }
            
            $(window).on('load', function() {
                marqueelike();
            });
        </script>
        

        <?= $scripts ?>
    </body>
</html>
    