<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    //
    protected $table = 'store_photos';

    protected $fillable = ['photo', 'path', 'thumbnail_path','name'];
    protected $file;

    public function spa() {
        return $this->belongsTo('App\Store');
    }
    public static function fromFile(UploadedFile $file, $store_name){
        $photo = new static;

        $photo->file = $file;
        $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath($store_name),
            'thumbnail_path' => $photo->thumbnailPath($store_name)
        ]);
        return $photo;
    }
    public function fileName(){
        $name = $this->file->getClientOriginalName();
        return "{$name}";
    }
    public function filePath($store_name){
        return '/'.$this->baseDir($store_name).'/'.$this->fileName();
    }
    public function thumbnailPath($store_name){
        return '/'.$this->baseDir($store_name).'/tn-'.$this->fileName();
    }
    public function baseDir($store_name){
        return "stores/{$store_name}";
    }
    public function upload($store_name){
        $this->file->move($this->baseDir($store_name), $this->fileName());
        $this->makeThumbnail($store_name);
        return $this;
    }
    protected function makeThumbnail($store_name){
        Image::make($this->baseDir($store_name).'/'.$this->fileName())
            ->fit(200)
            ->save($this->baseDir($store_name).'/tn-'.$this->fileName());
    }
    public function delete(){
        \File::delete([
            $this->path
        ]);
        parent::delete();
    }
}
