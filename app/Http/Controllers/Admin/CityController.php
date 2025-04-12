<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    protected $model="Cities";
    protected $icon ="fa-solid fa-city";

    public function index()
    {
        $model =$this->model;
        $icon=$this->icon;
        $label = "Index";
        return view('admin.cities.index',compact('model','icon','label'));
    }

    // public function getCities()
    // {

    //     $cities = City::with(['country' => function($query){
    //         $query->select('id','country');
    //     }, 'state' => function($query){
    //         $query->select('id','state');
    //     }]);
    //     return DataTables::of($cities)
    //         ->addColumn('country_id', function ($cities) {
    //             $country = $cities->country ? $cities->country->country : "";
    //             return $country;
    //         })
    //         ->addColumn('state_id', function ($cities) {
    //             $state = $cities->state ? $cities->state->state : "";
    //             return $state;
    //         })

    //         ->addColumn('city', function ($cities) {
    //             return $cities->city;
    //         })
    //         ->addColumn('status', function ($cities) {
    //             return $cities->status ? "Active" : "Inactive";
    //         })
    //         ->addColumn('action', function ($cities) {
    //             return '<a class="btn-icon text-info" href="#" onclick="editItem(' . $cities->id . ')"><i class="bi bi-pencil"></i>
	// 														</a>
    //                     <a class="btn-icon text-danger mb-1" onclick="deleteItem(' . $cities->id . ')"><i class="bi bi-trash"></i>
	// 														</a>
    //                                   </a>';
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }
    public function getCities()
    {
        $cities = City::with(['country:id,country', 'state:id,state'])->get();

        return DataTables::of($cities)
            ->addColumn('country_id', function ($city) {
                return $city->country ? $city->country->country : "";
            })
            ->addColumn('state_id', function ($city) {
                return $city->state ? $city->state->state : "";
            })
            ->addColumn('city', function ($city) {
                return $city->city;
            })
            ->addColumn('status', function ($city) {
                return $city->status ? "Active" : "Inactive";
            })
            ->addColumn('action', function ($city) {
                return '<a class="btn-icon text-info"data-toggle="tooltip" data-placement="top" title="Edit" href="#" onclick="editItem(' . $city->id . ')"><i class="bi bi-pencil"></i></a>
                        <a class="btn-icon text-danger mb-1"data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $city->id . ')"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $model =$this->model;
        $icon = $this->icon;
        $label = "Create";
        $countries = $this->getCountrySchema()->get();
        $states = $this->getStateSchema()->get();
        return view('admin.cities.create', compact('countries', 'states', 'model', 'icon', 'label'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'country_id'=>'required|string',
            'state_id'=>'required|string',
        ]);
        $status=request('status')== null ? 1:request('status');
        $adminId = auth()->guard('admin')->id();
        $data = [
            'admin_id' => $adminId,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city' => $request->city,

            'status' =>$status,
        ];

        City::create($data);





        return redirect()->route('admin.cities.index');
    }



    public function destroy($id)
    {
        $item = City::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'City deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'City not found.']);
    }
    public function edit($id)
    {
        $model =$this->model;
        $icon=$this->icon;
        $label = "Edit";
        $countries = $this->getCountrySchema()->get();
        $states = $this->getStateSchema()->get();
        $cities = City::find($id);
        return view('admin.cities.edit', compact('cities','countries','states','model','icon','label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'city' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'country_id'=>'required|string',
            'state_id'=>'required|string',
        ]);



        $cities = City::find($id);
        $cities->country_id = $request->input('country_id');
    $cities->state_id = $request->input('state_id');
        $cities->city = $request->input('city');
        $cities->status = $request->input('status');
        $cities->update();
        return redirect()->route('admin.cities.index');
    }

    protected function getCountrySchema()
    {
        return Country::where('status', 1);
    }

    protected function getStateSchema()
    {
        return State::where('status', 1);
    }
}
