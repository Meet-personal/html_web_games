<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    protected $model = "States";
    protected $icon = 'fa-solid fa-landmark';

    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";
        return view('admin.states.index', compact('model', 'icon', 'label'));
    }

    // public function getStates()
    // {

    //     $states = State::with(['country' => function($query){
    //         $query->select('id','country');
    //     }]);
    //     return DataTables::of($states)
    //     ->addColumn('country_id', function ($states) {
    //         $title = $states->country ? $states->country->country : "";
    //         return $title;
    //     })
    //         ->addColumn('state', function ($states) {
    //             return $states->state;
    //         })
    //         ->addColumn('code', function ($states) {
    //             return $states->code;
    //         })
    //         ->addColumn('status', function ($cities) {
    //             return $cities->status ? "Active" : "Inactive";
    //         })

    //         ->addColumn('action', function ($states) {
    //             return '    <a class="btn-icon text-info" href="#" onclick="editItem(' . $states->id . ')"><i class="bi bi-pencil"></i></a>
    //                     <a class="btn-icon text-danger" onclick="deleteItem(' . $states->id . ')"><i class="bi bi-trash"></i></a>';
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }


    public function getStates()
    {
        // Initialize the query with the country relationship
        $states = State::with(['country' => function ($query) {
            $query->select('id', 'country');
        }])->get();

        // Process DataTables
        return DataTables::of($states)
            ->addColumn('country_id', function ($state) {
                // Retrieve the country name
                return $state->country ? $state->country->country : "";
            })
            ->addColumn('state', function ($state) {
                // Retrieve the state name
                return $state->state;
            })
            ->addColumn('code', function ($state) {
                // Retrieve the state code
                return $state->code;
            })
            ->addColumn('status', function ($state) {
                // Retrieve the status
                return $state->status ? "Active" : "Inactive";
            })
            ->addColumn('action', function ($state) {
                // Generate action buttons
                return '<a class="btn-icon text-info" data-toggle="tooltip" data-placement="top" title="Edit" href="#" onclick="editItem(' . $state->id . ')"><i class="bi bi-pencil"></i></a>
                        <a class="btn-icon text-danger mb-1" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $state->id . ')"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['action']) // Only include rawColumns for HTML content
            ->make(true);
    }


    public function create()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Create";
        $countries = $this->getCountrySchema()->get();
        return view('admin.states.create', compact('countries', 'model', 'icon', 'label'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|string|max:100',
            'state' => 'required|string|max:100|unique:states|regex:/^[\pL\s\-]+$/u',
            'code' => 'required|integer|digits_between:1,4|unique:states', // Assuming code is not too long
        ]);

        $code = $request->input('code');
        $formattedStateCode = $code[0] === '+' ? $code : '+' . $code;
        $adminId = auth()->guard('admin')->id();
        $status  = request('status') == null ? 1 : request('status');
        State::create([
            'admin_id' => $adminId,
            'country_id' => $request->input('country_id'),
            'state' => $request->input('state'),
            'code' => $formattedStateCode,
            'status' =>   $status,
        ]);

        return redirect()->route('admin.states.index');
    }
    public function destroy($id)
    {
        $item = State::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'State deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'State not found.']);
    }
    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";
        $countries  = $this->getCountrySchema()->get();
        $states = State::find($id);
        // dd($states);
        return view('admin.states.edit', compact('states', 'countries', 'model', 'icon', 'label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id' => 'required|string|max:100',
            'state' => 'required|string|max:100|unique:states|regex:/^[\pL\s\-]+$/u',
            'code' => 'required|integer|digits_between:1,4|unique:states', // Assuming code is not too long
        ]);

        $states = State::find($id);
        $states->country_id = $request->input('country_id');
        $states->state = $request->input('state');
        $code = $request->input('code');
        $formattedStateCode = $code[0] === '+' ? $code : '+' . $code;
        $states->code = $formattedStateCode;
        $states->status = $request->input('status');
        $states->update();
        return redirect()->route('admin.states.index');
    }

    protected function getCountrySchema()
    {
        return Country::where('status', 1);
    }
}
