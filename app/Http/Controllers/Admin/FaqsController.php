<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Faqs;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqsController extends Controller
{
    protected $model = "Faqs";
    protected $icon = 'fa fa-question-circle';
    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;

        $label = "Index";
        return view('admin.faqs.index',compact('model','icon','label'));
    }

    // public function getFaqs()
    // {
    //     $faqs = Faqs::with(['country' => function($query){
    //         $query->select('id','country');
    //     }]);
    //     return DataTables::of($faqs)

    //     ->addColumn('country_id', function ($faqs) {
    //         $country = $faqs->country ? $faqs->country->country : "";
    //         return $country;
    //     })
    //     ->addColumn('question', function ($faqs) {
    //         return $faqs->question;
    //     })
    //     ->addColumn('answer', function ($faqs) {
    //         return $faqs->answer;
    //     })
    //     ->addColumn('status', function ($faqs) {
    //         return $faqs->status ? "Active" : "Inactive";
    //     })

    //         ->addColumn('action', function ($faqs) {
    //             return '<a class="btn-icon text-info" href="#" onclick="editItem(' . $faqs->id . ')"><i class="bi bi-pencil"></i></a>
    //                     <a class="btn-icon text-danger mb-1" onclick="deleteItem(' . $faqs->id . ')"><i class="bi bi-trash"></i></a>';
    //         })
    //         ->rawColumns([ 'action'])
    //         ->make(true);
    // }

    public function getFaqs()
    {
        // Initialize the query with the country relationship
        $faqs = Faqs::with(['country' => function ($query) {
            $query->select('id', 'country');
        }])->orderBy('created_at','desc')->get();

        // Process DataTables
        return DataTables::of($faqs)
            ->addColumn('country_id', function ($faq) {
                // Retrieve the country name
                return $faq->country ? $faq->country->country : "";
            })
            ->addColumn('question', function ($faq) {
                // Return the question
                return $faq->question;
            })
            ->addColumn('answer', function ($faq) {
                // Return the answer
                return $faq->answer;
            })
            ->addColumn('status', function ($faq) {
                // Return the status
                return $faq->status ? "Active" : "Inactive";
            })
            ->addColumn('action', function ($faq) {
                // Generate action buttons
                return '
                    <a class="btn-icon text-info" href="#"data-toggle="tooltip" data-placement="top" title="Edit" onclick="editItem(' . $faq->id . ')"><i class="bi bi-pencil"></i></a>
                    <a class="btn-icon text-danger mb-1"data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $faq->id . ')"><i class="bi bi-trash"></i></a>
                ';
            })
            ->rawColumns(['action']) // Specify columns containing HTML
            ->addIndexColumn()
            ->make(true);
    }


    public function create()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Create";
        $countries = $this->getCountrySchema()->get();
        return view('admin.faqs.create', compact('countries','model','icon','label'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|integer|exists:countries,id',
            'question' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
            'answer' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u', // Assuming code is not too long
        ]);
        // dd($request->all());
        $adminId = auth()->guard('admin')->id();
        $status  = request('status') == null ? 1 : request('status');
        Faqs::create([
            'admin_id' => $adminId,
            'country_id' => $request->input('country_id'),
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'status' =>  $status,
        ]);

        return redirect()->route('admin.faqs.index');
    }
    public function destroy($id)
    {
        $item = Faqs::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'FAQ not found.']);
    }
    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";

        $countries=$this->getCountrySchema()->get();
        $faqs = Faqs::find($id);
        return view('admin.faqs.edit', compact('faqs','countries','model','icon','label'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'country_id' => 'nullable|integer|exists:countries,id',
            'question' => 'required|string|max:100',
            'answer' => 'required|string|max:10', // Assuming code is not too long
        ]);


        $faqs = Faqs::find($id);
        $faqs->country_id = $request->input('country_id');
        $faqs->question = $request->input('question');

        $faqs->answer = $request->input('answer');

        $faqs->status = $request->input('status');

        $faqs->update();
        return redirect()->route('admin.faqs.index');
    }

    protected function getCountrySchema()
    {
        return Country::where('status', 1);
    }
}
