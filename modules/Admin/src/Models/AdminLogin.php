<?php

declare(strict_types=1);

namespace Modules\Admin\Models;

class AdminLogin extends BaseModel
{
    /**
     * The metrics table.
     *
     * @var string
     */
    protected $table    = 'admin';
    protected $guarded  = ['created_at', 'updated_at', 'id'];
    protected $fillable = ['email','password'];
}
