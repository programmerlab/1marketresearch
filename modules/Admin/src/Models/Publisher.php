<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Publisher extends Eloquent
{
    /*
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publishers';
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['publisher','company'];  // All field of user table here
}
