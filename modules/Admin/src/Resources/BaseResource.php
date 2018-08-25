<?php

declare(strict_types=1);

namespace Modules\Admin\Resources;

/**
 * @author amanda
 */
abstract class BaseResource
{
    protected $model;

    public function __destruct()
    {
        $this->model = null;
    }

    /**
     * @return Model
     */
    abstract protected function getUserModel();
}
