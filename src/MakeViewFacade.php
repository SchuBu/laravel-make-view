<?php

namespace SchuBu\MakeView;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SchuBu\MakeView\Skeleton\SkeletonClass
 */
class MakeViewFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'make-view';
    }
}
