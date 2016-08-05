<?php

namespace TypiCMS\Modules\Categories\Models;

use TypiCMS\Modules\Core\Custom\Traits\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Custom\Models\Base;
use TypiCMS\Modules\History\Custom\Traits\Historable;

class Category extends Base
{
    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Categories\Custom\Presenters\ModulePresenter';

    protected $fillable = [
        'position',
        'image',
        // Translatable columns
        'title',
        'slug',
        'status',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'slug',
        'status',
    ];

    protected $appends = ['thumb'];

    /**
     * Relations.
     */
    public function projects()
    {
        return $this->hasMany('TypiCMS\Modules\Projects\Custom\Models\Project')->order();
    }

    /**
     * Append thumb attribute.
     *
     * @return string
     */
    public function getThumbAttribute()
    {
        return $this->present()->thumbSrc(null, 22);
    }
}
