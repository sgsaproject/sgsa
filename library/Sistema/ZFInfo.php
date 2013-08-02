<?php

class Sistema_ZFInfo {

    protected $ControllerPath;

    function __construct($ApplicationPath) {

        $this->ControllerPath = $ApplicationPath . '/controllers';
    }

    function listarControllers() {

        $files = scandir($this->ControllerPath);

        foreach ($files as $file) {
            //Verifica se o arquivo contem Controller.php
            if (strstr($file, 'Controller.php') != FALSE) {

                $controllers[] = strtolower(str_replace('Controller.php', '', $file));
            }
        }

        return $controllers;
    }

}