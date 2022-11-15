<?php

abstract class File
{
    public static function MakeFileToBinary($file)
    {
        $binaryFile = null;

        if (!is_null($file)) {
            // $fileToConvert = fopen($file["tmp_name"], "r");
            // $binaryFile = fread($fileToConvert, $file["size"]);


            $binaryFile = file_get_contents(addslashes($file));
        }


        return $binaryFile;
    }

    public static function getImage($file_image)
    {
        if ($file_image["size"] != 0) {
            $name_file = uniqid('imagen_') . "_" . $file_image["name"];

            //$name_file = str_replace(".png", ".jpg", $name_file);

            $carpeta_guardar_archivo = $_SERVER["DOCUMENT_ROOT"] . Constants::PROJECT_PATH_IMAGES_TEMP;
            

            move_uploaded_file($file_image["tmp_name"], $carpeta_guardar_archivo . $name_file);

            return $carpeta_guardar_archivo . $name_file;
        }
        else{
            return null;
        }
    }

    public static function getImageFacebook($imageURI){
        
            $name_file = uniqid('imagen_') . "imagen.png";
            $carpeta_guardar_archivo = $_SERVER["DOCUMENT_ROOT"] . Constants::PROJECT_PATH_IMAGES_TEMP . $name_file;
            file_put_contents($carpeta_guardar_archivo , file_get_contents($imageURI));
           // move_uploaded_file($file_image["tmp_name"], $carpeta_guardar_archivo . $name_file);
            
            return $carpeta_guardar_archivo;
                    
      }
        
  
    public static function unsetImage($path_Image)
    {
        if ($path_Image != null) {
            if ($path_Image != "") {
                unlink($path_Image);
            }
        }
        
    }


    function readFileChunked($filename) {
        $chunksize = 512 ; // bytes per chunk
        $handle = fopen($filename, "rb");
    
        if ($handle === false)
            return false;        
    
        $data = "";
        while (!feof($handle)) {
            $data = $data . fread($handle, $chunksize);            
            ob_flush();
            flush();
        }
    
        fclose($handle);

        return  $data;
    }
}
