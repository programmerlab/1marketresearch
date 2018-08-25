<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Coupan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupans';
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
     * /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['coupan_code','start_date','end_date','fix_discount','percentage_discount'];  // All field of user table here
}
