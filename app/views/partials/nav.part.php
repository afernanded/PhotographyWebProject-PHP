<?php

use proyecto\app\utils\Utils;

?>
<!-- Navigation Bar -->

<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <span>[PHOTO]</span>
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
                <li class="<?= Utils::esOpcionMenuActiva('/') ? 'active' : '' ?> lien"><a href="/"><i
                                class="fa fa-home sr-icons"></i> Home</a>
                </li>
                <li class="<?= Utils::esOpcionMenuActiva('about') ? 'active' : '' ?> lien"><a href="/about"><i
                                class="fa fa-bookmark sr-icons"></i> About</a>
                </li>
                <li class="<?= Utils::existeOpcionMenuActivaEnArray(['blog', 'post']) ? 'active' : '' ?> lien"><a
                            href="<?= Utils::esOpcionMenuActiva('blog') ? '#' : '/blog' ?>"><i
                                class="fa fa-file-text sr-icons"></i> Blog</a>
                </li>
                <li class="<?= Utils::esOpcionMenuActiva('nuevo-mensaje') ? 'active' : '' ?> lien"><a
                            href="/nuevo-mensaje"><i class="fa fa-phone-square sr-icons"></i> Contact</a>
                </li>
                <?php if (is_null($app['user'])) : ?>
                    <li class="<?= Utils::esOpcionMenuActiva('login') ? 'active' : '' ?> lien"><a href="/login"><i
                                    class="fa fa-sign-in"></i> Login</a>
                    </li>
                    <li class="<?= Utils::esOpcionMenuActiva('registro') ? 'active' : '' ?> lien"><a href="/registro"><i
                                    class="fa fa-sign-in"></i> Registro</a>
                    </li>
                <?php else : ?>
                    <li class="<?= Utils::esOpcionMenuActiva('galeria') ? 'active' : '' ?> lien"><a
                                href="/imagenes-galeria"><i class="fa fa-image"></i> Galería</a>
                    </li>
                    <li class="<?= Utils::esOpcionMenuActiva('asociado') ? 'active' : '' ?> "><a href="/nuevo-asociado"><i
                                    class="fa fa-hand-o-right"></i> Asociados</a>
                    </li>
                    <li class="<?= Utils::esOpcionMenuActiva('logout') ? 'active' : '' ?> lien"><a href="/logout"><i
                                    class="fa fa-sign-out"></i><?= $app['user']->getUsername() ?> Salir</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Navigation Bar -->
