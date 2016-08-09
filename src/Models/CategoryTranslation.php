<?php

namespace TypiCMS\Modules\Categories\Models;

use TypiCMS\Modules\Core\Shells\Models\BaseTranslation;

class CategoryTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Categories\Shells\Models\Category', 'category_id')->withoutGlobalScopes();
    }
}
