<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    protected $model = "Countries";
    protected $icon = 'bi bi-globe-central-south-asia';
    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";
        return view('admin.countries.index', compact('model', 'icon', 'label'));
    }



    public function getCountries()
    {
        // Initialize the query
        $countries = Country::query();

        // Apply DataTables processing
        return DataTables::of($countries)
            ->addColumn('flag', function (Country $country) {
                $image = common_image($country->flag);
                return '<img src="' . $image . '" width="100" height="100">';
            })
            ->addColumn('status', function (Country $country) {
                return $country->status ? "Active" : "Inactive";
            })
            ->addColumn('action', function (Country $country) {
                return '<a class="btn-icon text-info" data-toggle="tooltip" data-placement="top" title="Edit" href="#" onclick="editItem(' . $country->id . ')"><i class="bi bi-pencil"></i></a>
                        <a class="btn-icon text-danger mb-1" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $country->id . ')"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['flag', 'action'])
            ->make(true);
    }



    public function create()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Create";
        return view('admin.countries.create', compact('model', 'icon', 'label'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u|unique:countries',
            'code' => 'required|integer|unique:countries|digits_between:1,4',

            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('flag')) {
            $image = $request->file('flag');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'countries';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
        }
        $code = $request->input('code');
        $formattedCountryCode = $code[0] === '+' ? $code : '+' . $code;
        // $formattedCountryCode = ltrim($code, '+');
        $adminId = auth()->guard('admin')->id();
        $status  = request('status') == null ? 1 : request('status');
        $data = [
            'admin_id' => $adminId,
            'country' => $request->country,
            'code' => $formattedCountryCode,

            'flag' => $imagePath ?? null,
            'status' =>  $status,
        ];

        Country::create($data);

        return redirect()->route('admin.countries.index');
    }



    public function destroy($id)
    {
        $item = Country::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Country deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Country not found.']);
    }
    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";
        $country = Country::find($id);
        return view('admin.countries.edit', compact('country', 'model', 'icon', 'label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'country' => 'required|regex:/^[\pL\s\-]+$/u|unique:countries',
            'code' => 'required|integer|unique:countries|digits_between:1,4',

            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);

        $country = country::find($id);
        $country->country = $request->input('country');
        $code = $request->input('code');
        $formattedCountryCode = $code[0] === '+' ? $code : '+' . $code;
        $country->code = $formattedCountryCode;

        $country->status = $request->input('status');
        if ($request->hasFile('flag')) {
            $image = $request->file('flag');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'countries';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
            $country->flag = $imagePath;
        }


        $country->update();
        return redirect()->route('admin.countries.index');
    }
}
