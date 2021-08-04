<?php

namespace proyecto\app\utils;

class Utils
{

    public static function esOpcionMenuActiva(string $opcionMenu):bool{
        if (strpos(($_SERVER['REQUEST_URI']),$opcionMenu)) {
            return true;
        }
        return false;
    }

    public static function existeOpcionMenuActivaEnArray (array $opcionesArray) {
        foreach ($opcionesArray as $valor) {
            if (Utils::esOpcionMenuActiva($valor)) {
                return true;
            }
        }
        return false;
    }

    public static function sacarAsociados($arrayAsociados) {
        ?>
        <?if (count($arrayAsociados) <= 3) :?>
            <? foreach ($arrayAsociados as $asociado) : ?>
                <ul class="list-inline">
                    <li><img width="75px" src="<?=$asociado->getUrlAsociado()?>" alt="<?=$asociado->getDescripcion()?>"></li>
                    <li><?=$asociado->getNombre()?></li>
                </ul>
            <?endforeach;?>
        <?else:?>
            <?shuffle($arrayAsociados);?>
            <? foreach (array_slice($arrayAsociados, 0,3) as $asociado) : ?>
                <ul class="list-inline">
                    <li><img width="75px" src="<?=$asociado->getUrlAsociado()?>" alt="<?=$asociado->getDescripcion()?>"></li>
                    <li><?=$asociado->getNombre()?></li>
                </ul>
            <?endforeach;?>
        <?endif;?>
        <?php
    }


}