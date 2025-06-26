<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSModel extends Model
{
    protected $table = 'cms';

    protected $primaryKey = 'contentID';
    protected $fillable = [ 'contentID', 'key', 'region', 'content', 'image'];

    public $incrementing = false; 
    protected $keyType = 'string'; 
}
