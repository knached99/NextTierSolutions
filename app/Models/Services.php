<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $primaryKey = 'serviceID';

    protected $fillable = [ 'serviceID', 'title', 'description', 'icon_class', 'icon_color', 'order'];

        public $incrementing = false; 
        protected $keyType = 'string'; 
}
