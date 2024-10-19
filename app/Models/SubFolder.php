<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFolder extends Model
{
    use HasFactory;
    protected $table = 'sub_folder';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sub_folder_image',
        'main_folder_id',
        'parent_folder',
        'sub_folder_name'
    ];

    public function getMain()
    {
        return $this->belongsTo(MainFolder::class,'main_folder_id');
    }
}
