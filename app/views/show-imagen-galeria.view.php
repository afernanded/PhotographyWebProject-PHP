<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>IMAGEN DE LA GALERÍA</h1>
            <hr>

            <div class="imagenes_galeria">
                <img src="/<?= $imagen->getUrlGallery() ?>"
                     alt="<?= $imagen->getDescripcion() ?>"
                     title="<?= $imagen->getDescripcion() ?>">
            </div>
        </div>
    </div>
</div>
<!-- Principal Content Start -->
