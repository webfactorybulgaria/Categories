<?php

namespace TypiCMS\Modules\Categories\Repositories;

use Illuminate\Database\Eloquent\Collection;
use TypiCMS\Modules\Core\Shells\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Shells\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements CategoryInterface
{
    public function __construct(CategoryInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }

    /**
     * Get all categories for select/option.
     *
     * @return array
     */
    public function allForSelect()
    {
        return $this->repo->allForSelect();
    }

    /**
     * Get all categories and prepare for menu.
     *
     * @param string $uri
     *
     * @return Collection
     */
    public function allForMenu($uri = '')
    {
        $cacheKey = md5(config('app.locale').'allForMenu'.$uri);

        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        // Item not cached, retrieve it
        $models = $this->repo->allForMenu($uri);

        // Store in cache for next request
        $this->cache->put($cacheKey, $models);

        return $models;
    }
}
