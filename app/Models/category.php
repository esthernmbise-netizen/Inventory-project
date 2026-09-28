<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
<<<<<<< HEAD
    <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
=======
>>>>>>> 535a3560ad0e486c80f4f76e7ee6e7c7d7fd4b0f
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
<<<<<<< HEAD
}
=======
>>>>>>> 535a3560ad0e486c80f4f76e7ee6e7c7d7fd4b0f
}

