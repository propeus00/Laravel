<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ["name"]; //Declare this property when insirting data directly inside the database by callid inside the controller the static method create.

    public function posts()
    {
        return $this->HasMany(Post::class);
    }
}
