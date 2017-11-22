<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broadcasts extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'broadcasts';
    protected $fillable = ['content', 'type', 'username', 'status', 'publish_at', 'created_at', 'updated_at'];


}
