<?php

namespace TypiCMS\Modules\Categories\Http\Controllers;

use TypiCMS\Modules\Categories\Shells\Http\Requests\FormRequest;
use TypiCMS\Modules\Categories\Shells\Models\Category;
use TypiCMS\Modules\Categories\Shells\Repositories\CategoryInterface;
use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseAdminController;

class AdminController extends BaseAdminController
{
    public function __construct(CategoryInterface $category)
    {
        parent::__construct($category);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('categories::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('categories::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Categories\Shells\Models\Category $category
     *
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories::admin.edit')
            ->with(['model' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Categories\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $category = $this->repository->create($request->all());

        return $this->redirect($request, $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Categories\Shells\Models\Category           $category
     * @param \TypiCMS\Modules\Categories\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $category);
    }
}
