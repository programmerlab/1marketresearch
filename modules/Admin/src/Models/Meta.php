<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent; 
use Modules\Admin\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Response;

class Meta extends Eloquent {
 
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'metas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     /**
     * The primary key used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
