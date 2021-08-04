<?php include __DIR__ . '/partials/inicio-doc.part.php'; ?>

<?php include __DIR__ . '/partials/nav.part.php';?>

<!-- Principal Content Start -->
<div id="asociados">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>ASOCIADOS</h1>
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

            <form action="asociado/nuevo" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="nombre" class="">Nombre</label>
                        <input class="form-control" type="text" name="nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="logo" class="">Logo</label>
                        <input class="" type="file" name="logo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="message" class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?=$descripcion?></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
            <hr class="divider">
            <div class="asociados">
                <!-- Codigo de la tabla -->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Descripción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($asociados as $asociado) : ?>
                        <tr>
                            <th scope="row"><?= $asociado->getId()?></th>
                            <td><?= $asociado->getNombre()?></td>
                            <td><img width="100px" src="<?= $asociado->getUrlAsociado()?>" alt="<?= $asociado->getDescripcion()?>" title="<?= $asociado->getDescripcion()?>"></td>
                            <td><?= $asociado->getDescripcion()?></td>
                        </tr>
                    <? endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="address">
                <h3>GET IN TOUCH</h3>
                <hr>
                <div class="ending text-center">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-facebook sr-icons"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-twitter sr-icons"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-google-plus sr-icons"></i></a>
                        </li>
                    </ul>
                    <ul class="list-inline contact">
                        <li class="footer-number"><i class="fa fa-phone sr-icons"></i> (00228)92229954</li>
                        <li><i class="fa fa-envelope sr-icons"></i> kouvenceslas93@gmail.com</li>
                    </ul>
                    <p>Photography Fanatic Template &copy; 2017</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Principal Content Start -->
<?php include __DIR__ . '/partials/fin-doc.part.php'; ?>
