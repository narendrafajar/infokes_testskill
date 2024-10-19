<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainFolder extends Model
{
    use HasFactory;
    protected $table = 'main_folder';
    protected $primaryKey = 'id';
    protected $fillable = [
        'folder_name'
    ];

    public function getSub()
    {
        return $this->hasMany(SubFolder::class,'main_folder_id','id');
    }
}
