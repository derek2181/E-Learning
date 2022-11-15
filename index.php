<?php

abstract class Constants{
    public const WEB_SITE = "https://localhost";
    public const ROOT_PATH = "/bdm/";

    public const PROJECT_PATH = "/bdm/Backend/E-Learning/";
    public const VIEWS_PATH = self::PROJECT_PATH . "Vista/";
    public const PROJECT_PATH_IMAGES_TEMP = self::PROJECT_PATH . "Files/Imagenes_Temp/";
    public const PROJECT_PATH_VIDEOS = self::PROJECT_PATH . "Files/Videos/";
    public const PROJECT_PATH_FILES = self::PROJECT_PATH . "Files/PDF/";

    public const PROJECT_PATH_INCLUDE = "Backend/E-Learning/";
}

require_once Constants::PROJECT_PATH_INCLUDE . "Controlador/template.controller.php";
$template = new Template();
$template->ShowTemplate();
