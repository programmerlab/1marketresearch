<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class ContactGroup extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contact_groups';
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function contact()
    {
        return $this->belongsTo('Modules\Admin\Models\Contact', 'contactId', 'id');
    }

    public function contactGroup()
    {
        return $this->hasMany('Modules\Admin\Models\ContactGroup', 'parent_id', 'id');
    }
}
