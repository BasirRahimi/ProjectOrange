<?php

namespace App\Http\Controllers;

use App\Models\CaseData;
use App\Models\CaseType;
use App\Models\POCase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CaseController2 extends Controller
{
    /**
     * Get all cases
     */
    public function index(Request $request, string $case_id = null): JsonResponse
    {
        $user = Auth::user();

        // TODO: Phase out the use of clients by removing/renaming clients to probate cases
        return response()->json($user->clients);

        if ($case_id) {
            $case = POCase::findOrFail($case_id);
            return response()->json($case);
        }

        // new cases implementation
        $case_type_id = CaseType::where('name', $request['case_type'])->firstOrFail();

        // TODO: Paginate results
        $page = $request['page'];
        $per_page = $request['per-page'];

        return response()->json($user->cases($case_type_id)->paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $case_type): Response
    {
        $case_type_id = CaseType::where('name', $case_type)->firstOrFail();

        $user = Auth::user();

        $case = new POCase();
        $case->user_id = $user->id;
        $case->case_type_id = $case_type_id;

        $case->name = $request['body']['forename'] . $request['body']['surname'];

        return response('case created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $case_id): Response
    {
        POCase::findOrFail($case_id);

        $section = $request['body']['section'];
        if (!isset($section)) {
            return new BadRequestException('Missing form section name', 400);
        }

        $case_datas = CaseData::where('case_id', '=', $case_id);

        $case_data = null;

        for ($i = 0; $i < count($case_datas); $i++) {
            if (json_decode($case_datas[$i]->the_data)['section'] === $section) {
                $case_data = $case_datas[$i];
                break;
            }
        }

        if ($case_data) {
            $case_data->the_data = $request['body'];
        } else {
            $case_data = new CaseData();
            $case_data->case_id = $case_id;
            $case_data->the_data = $request['body'];
        }

        if ($case_data->save()) {
            return response('case updated');
        } else {
            return new Exception('Failed to save section data', 500);
        }
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
}
