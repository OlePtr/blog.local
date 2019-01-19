<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "category";
    public $timestamps = false;
    protected $primaryKey = 'categoryID';
    protected $fillable = ['categoryID', 'category', 'categoryURL', 'categoryDESCRIPTION'];

    public function getRouteKeyName()
    {
        return 'categoryURL';
    }
}

