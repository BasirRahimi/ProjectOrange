<?php

namespace App\Http\Controllers;

use App\Models\CaseType;
use App\Models\POCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CaseController extends Controller
{
    /**
     * Get all cases
     */
    public function index(): View
    {
        $page_title = 'Cases';
        return view('home', ['page_title' => $page_title]);
    }

    public function getCases(Request $request, int $case_id = null): JsonResponse
    {
        $user = Auth::user();
        $case_type_id = null;
        if ($case_id) {
            $case = POCase::findOrFail($case_id);
            return response()->json($case);
        }

        if ($request['case-type']) {
            $case_type_id = CaseType::where('name', $request['case-type'])->firstOrFail()->id;
        }

        $cases = POCase::where('user_id', $user->id);

        if ($case_type_id) {
            $cases = $cases->where('case_type_id', $case_type_id);
        }

        if ($request['search']) {
            $cases = $cases->where('name', 'like', '%' . $request['search'] . '%');
        }

        $cases = $cases->orderBy($request['order-by'], $request['order']);
        $cases = $cases->paginate($request['per-page']);

        return response()->json($cases);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $case_type): JsonResponse
    {
        $case_type_id = CaseType::where('name', $case_type)->firstOrFail()->id;

        $user = Auth::user();

        $case = new POCase();
        $case->user_id = $user->id;
        $case->case_type_id = $case_type_id;

        if (empty($request['case-name'])) {
            return response('case name is required', 400);
        }

        $case->name = $request['case-name'];

        $case->save();

        return response()->json($case);
    }

    /**
     * Status updates
     */
    public function update(Request $request, string $case_id): JsonResponse
    {
    }

    /**
     * soft delete resource
     */
    public function softDelete(string $case_id): Response
    {
        $case = POCase::findOrFail($case_id);

        $case->softDeletes();

        return response('case_deleted', 200);
    }

    /**
     * upload file
     */
    public function uploadFile(Request $request, string $case_id): JsonResponse
    {
        $case = POCase::findOrFail($case_id);

        $path = '/userUploads/' . Auth::id() . '/caseFiles/' . $case_id;
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file_path = $file->storeAs($path, $filename);

        return response()->json([
            'path' => asset(Storage::url($file_path)),
            'filename' => $filename
        ]);
    }
}
