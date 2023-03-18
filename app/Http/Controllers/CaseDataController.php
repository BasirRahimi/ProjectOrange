<?php

namespace App\Http\Controllers;

use App\Models\CaseData;
use App\Models\POCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Spatie\FlareClient\Http\Exceptions\BadResponse;

class CaseDataController extends Controller
{
    /**
     * Get CaseData
     */
    public function get(Request $request, $case_id): JsonResponse
    {
        $case = POCase::findOrFail($case_id);
        $case_data = $case->caseData($request['section']);

        return response()->json($case_data);
    }

    /**
     * Save CaseData
     */
    public function store(Request $request, $case_id): JsonResponse
    {
        $case = POCase::findOrFail($case_id);
        $section = $request['section'];
        $data = $request['data'];
        if (!isset($section)) {
            return new BadRequestException('Missing form section name', 400);
        }

        $case_data = $case->caseData($section);
        if ($case_data) {
            $case_data->the_data = $data;
        } else {
            $case_data = new CaseData();
            $case_data->case_id = $case->id;
            $case_data->the_data = $data;
            $case_data->section = $section;
        }

        if ($case_data->save()) {
            return response()->json($case_data);
        } else {
            return new Exception('Failed to save section data', 500);
        }
    }
}
