<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Report extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reports';
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
        'category_name',
        'description',
        'report_id',
        'category_id',
        'number_of_pages',
        'table_of_contents',
        'description',
        'photo',
        'type',
        'publish_date',
        'meta_title',
        'meta_key',
        'meta_description',
        'slug',
        'url',
        'signle_user_license',
        'multi_user_license',
        'corporate_user_license',
        'currency',
        'status', ];  // All field of user table here

    protected $casts = [
        'created_at' => 'datetime:m-d-Y',
    ];
}
