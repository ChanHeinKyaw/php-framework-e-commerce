<?php

namespace App\Classes;

class UploadFile
{
    protected $filename;
    protected $maxSize = 2097152;
    protected $path;

    public function setName($file , $name = null){
        if($name === null){
            $name = pathinfo($file->file->tmp_name, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace(["_",""], "-", $name));
        $hash = md5(microtime());
        $ext = pathinfo($file->file->name, PATHINFO_EXTENSION);
        $this->filename = "{$name}-{$hash}.{$ext}";
    }

    public function getName(){
        return $this->filename;
    }

    public function checkSize($file){
        return $file->file->size > $this->maxSize ? true : false;
    }

    public function isImage($file){
        $ext = pathinfo($file->file->name, PATHINFO_EXTENSION);
        $validExt = ["jpg","jpeg","png","bmp","gif"];

        return in_array($ext, $validExt);
    }

    public function getPath(){
        return $this->path;
    }
    
    public function move($file, $file_name = ""){
        $this->setName($file);
        if($this->isImage($file)){
            if(!$this->checkSize($file)){
                $path = APP_ROOT . "/public/assets/uploads/";
                if(!is_dir($path)){
                    mkdir($path);
                }
                $this->path = URL_ROOT . "assets/uploads/" . $this->getName();
                $file_path = $path . $this->getName();
                return move_uploaded_file($file->file->tmp_name, $file_path);
            }else{
                return "File size exceeded!";
            }
        }else{
            return "Only Image File are accepted!";
        }
    }
}