<?php

namespace TypiCMS\Modules\Categories\Models;

use TypiCMS\Modules\Core\Shells\Traits\Translatable;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Shells\Models\Base;
use TypiCMS\Modules\History\Shells\Traits\Historable;

class Category extends Base
{
    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Categories\Shells\Presenters\ModulePresenter';

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
        return $this->hasMany('TypiCMS\Modules\Projects\Shells\Models\Project')->order();
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
