<?php

namespace TypiCMS\Modules\Categories\Repositories;

use Illuminate\Database\Eloquent\Collection;
use TypiCMS\Modules\Core\Shells\Repositories\RepositoryInterface;

interface CategoryInterface extends RepositoryInterface
{
    /**
     * Get all categories for select/option.
     *
     * @return array
     */
    public function allForSelect();

    /**
     * Get all categories and prepare for menu.
     *
     * @param string $uri
     *
     * @return Collection
     */
    public function allForMenu($uri = '');
}
