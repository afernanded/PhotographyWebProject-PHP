<?php //include __DIR__ . '/partials/inicio-doc.part.php'; ?>

<?php //include __DIR__ . '/partials/nav.part.php';?>

<!-- Principal Content Start -->
<div id="registro">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>REGISTRO</h1>
            <hr>
            <? if (!empty($message) || !empty($errores)) : ?>
                <?php if (empty($errores)) : ?>
                    <div class="alert alert- bg-success text-success" id="errores">
                        <span><?= $message ?></span>
                    </div>
                <?php else: ?>
                    <div class="alert alert- bg-danger text-danger" id="errores">
                        <ul>
                            <? foreach ($errores as $error) : ?>
                                <li><?= $error ?></li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                <? endif; ?>
            <?php endif; ?>

            <form action="/check-registro" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Username</label>
                        <input class="form-control" type="text" name="username" value="<?= $username ?? '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Password</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Re-Password</label>
                        <input class="form-control" type="password" name="re-password">
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Principal Content Start -->
<?php //include __DIR__ . '/partials/fin-doc.part.php'; ?>
