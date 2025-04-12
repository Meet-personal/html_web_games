<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Faqs;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeedBackController extends Controller
{
    protected $model = "Feedbacks";
    protected $icon = 'fa fa-question-circle';


    public function index(Request $request)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";

        // Check if the request is an AJAX call (which is usually from DataTables)
        if ($request->ajax()) {
            // Initialize the query with the country relationship
            $feedbacks = Feedback::orderBy('created_at', 'desc')->get();

            // Process DataTables
            return DataTables::of($feedbacks)
                ->addColumn('created_at', function ($feedbacks) {
                    return $feedbacks->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($feedbacks) {
                    return '
                        <a class="btn-icon text-danger mb-1" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $feedbacks->id . ')"><i class="bi bi-trash"></i></a>
                    ';
                })
                ->rawColumns(['action']) // Specify columns containing HTML
                ->addIndexColumn()
                ->make(true);
        }

        // For non-AJAX requests (like when loading the page)
        return view('admin.feedbacks.index', compact('model', 'icon', 'label'));
    }


    public function destroy($id)
    {
        $item = Feedback::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Feedback deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Feedback not found.']);
    }


}
