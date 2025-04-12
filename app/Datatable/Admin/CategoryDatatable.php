<?php

namespace App\Datatable\Admin;

use App\Models\Category;

use Yajra\DataTables\Facades\DataTables;

class CategoryDatatable
{
    /**
     * Create a new class instance.
     */

    public function getCategories()
    {
        $categories = Category::query();
        return DataTables::of($categories)
            ->addColumn('image', function (Category $category) {
                $image = get_category_image($category->image);
                return '<img src="' . $image . '" width="100" height="100">';
            })
            ->addColumn('action', function ($category) {
                return '<a class="btn-icon text-info" href="#" onclick="editItem(' . $category->id . ')"><i class="bi bi-pencil"></i>
															</a>
                        <a class="btn-icon text-danger mb-1" onclick="deleteItem(' . $category->id . ')"><i class="bi bi-trash"></i>
															</a>

                        <a class="btn-icon text-danger mb-1" onclick="viewItem(' . $category->id . ')"><i class="bi bi-eye"></i>


															</a>';
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }


}
