<?php //include __DIR__ . '/partials/inicio-doc.part.php'; ?>

<?php //include __DIR__ . '/partials/nav.part.php';?>

<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>GALERÍA</h1>
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
            <form action="imagenes-galeria/nueva" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="imagen" class="">Imagen</label>
                        <input class="" type="file" name="imagen">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Categoría</label>
                        <select class="form-control" name="categoria">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?= $categoria->getId() ?>"
                                    <?= ($categoriaSeleccionada == $categoria->getId()) ? 'selected' : '' ?>
                                >
                                </><?= $categoria->getNombre() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="message" class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?? '' ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
            <hr class="divider">
            <div class="imagenes_galeria">
                <!-- Codigo de la tabla -->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Visualizaciones</th>
                        <th scope="col">Likes</th>
                        <th scope="col">Descargas</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($imagenes as $imagen) : ?>
                        <tr>
                            <th scope="row"><?= $imagen->getId() ?></th>
                            <td><img width="100px" src="<?= $imagen->getUrlGallery() ?>"
                                     alt="<?= $imagen->getDescripcion() ?>" title="<?= $imagen->getDescripcion() ?>">
                            </td>
                            <td><?= $imagenRepository->getCategoria($imagen)->getNombre() ?></td>
                            <td><?= $imagen->getNumVisualizaciones() ?></td>
                            <td><?= $imagen->getNumLikes() ?></td>
                            <td><?= $imagen->getNumDownloads() ?></td>
                        </tr>
                    <? endforeach; ?>
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
<?php //include __DIR__ . '/partials/fin-doc.part.php'; ?>
