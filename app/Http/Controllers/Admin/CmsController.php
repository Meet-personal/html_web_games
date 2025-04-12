<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CmsController extends Controller
{
    protected $model = "CMS";
    protected $icon = '	fa fa-file';

    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";
        return view('admin.cms.index',compact('model','icon','label'));
    }

    // public function getCms()
    // {
    //     $cms = Cms::with(['country' => function ($query) {
    //         $query->select('id', 'country');
    //     }]);
    //     return DataTables::of($cms)
    //         ->addColumn('country_id', function ($cms) {
    //             $country = $cms->country ? $cms->country->country : "";
    //             return $country;
    //         })
    //         ->addColumn('title', function ($cms) {
    //             return $cms->title;
    //         })
    //         ->addColumn('content', function ($cms) {
    //             return $cms->content;
    //         })
    //         ->addColumn('status', function ($cms) {
    //             return $cms->status ? "Active" : "Inactive";
    //         })
    //         ->addColumn('action', function ($cms) {
    //             return '<a class="btn-icon text-info" href="#" onclick="editItem(' . $cms->id . ')"><i class="bi bi-pencil"></i> </a>';
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }


    public function getCms()
    {
        // Initialize the query with the country relationship
        $cms = Cms::with(['country' => function ($query) {
            $query->select('id', 'country');
        }])->get();

        // Process DataTables
        return DataTables::of($cms)
            ->addColumn('country_id', function ($cmsItem) {
                // Retrieve the country name
                return $cmsItem->country ? $cmsItem->country->country : "";
            })
            ->addColumn('title', function ($cmsItem) {
                // Retrieve the title
                return $cmsItem->title;
            })
            ->addColumn('content', function ($cmsItem) {
                // Retrieve the content
                return $cmsItem->content;
            })
            ->addColumn('status', function ($cmsItem) {
                // Return the status
                return $cmsItem->status ? "Active" : "Inactive";
            })
            ->addColumn('action', function ($cmsItem) {
                // Generate action button
                return '<a class="btn-icon text-info" href="#" onclick="editItem(' . $cmsItem->id . ')"><i class="bi bi-pencil"></i></a>';
            })
            ->rawColumns(['action']) // Specify columns containing HTML
            ->make(true);
    }



    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";
        $adminId = auth()->guard('admin')->id();
        $countries = $this->getCountrySchema()->get();
        $cms = Cms::find($id);
        return view('admin.cms.edit', compact('countries', 'cms', 'adminId','model','icon','label'));
    }


    public function update(Request $request, $id)
    {
        $cms = Cms::find($id);
        $cms->country_id = $request->input('country_id');
        $cms->slug = Str::slug($request->input('title'));
        $cms->title = $request->input('title');
        $cms->content = $request->input('content');
        $cms->status = $request->input('status', 1);
        $cms->update();
        return redirect()->route('admin.cms.index');
    }



    protected function getCountrySchema()
    {
        return Country::where('status', 1);
    }
}
