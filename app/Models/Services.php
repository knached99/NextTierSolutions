<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'serviceID';

    protected $fillable = [ 'serviceID', 'title', 'description', 'icon_class', 'icon_color', 'order', 'is_public'];

        public $incrementing = false; 
        protected $keyType = 'string'; 

            protected $casts = ['serviceID' => 'string', 'is_public' => 'boolean'];

}
