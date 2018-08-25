<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Press extends Eloquent
{
    /*
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'press_master';
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
    protected $fillable = [
        'title',
        'link',
        'description',
        'table_of_content',
        'publish_date',
        'about_us',
        'contact_us',
        'status',
        'forecast_year',
        'tag', ];  // All field from table here
}
