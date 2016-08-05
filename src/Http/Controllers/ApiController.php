<?php

namespace TypiCMS\Modules\Categories\Http\Controllers;

use Illuminate\Support\Facades\Request;
use TypiCMS\Modules\Categories\Custom\Models\Category;
use TypiCMS\Modules\Categories\Custom\Repositories\CategoryInterface as Repository;
use TypiCMS\Modules\Core\Custom\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function __construct(Repository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $model = $this->repository->create(Request::all());
        $error = $model ? false : true;

        return response()->json([
            'error' => $error,
            'model' => $model,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $updated = $this->repository->update(Request::all());

        return response()->json([
            'error' => !$updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \TypiCMS\Modules\Categories\Custom\Models\Category $category
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $deleted = $this->repository->delete($category);

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
