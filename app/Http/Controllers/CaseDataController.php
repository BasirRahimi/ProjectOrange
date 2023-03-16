<?php

namespace App\Http\Controllers;

use App\Models\CaseData;
use App\Models\POCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\FlareClient\Http\Exceptions\BadResponse;

class CaseDataController extends Controller
{
    /**
     * Get CaseData
     */
    public function get(Request $request, $case_id): JsonResponse
    {
        $case_data = POCase::findOrFail($case_id)->caseData();

        if (isset($request['form_part'])) {
            $case_data = array_filter($case_data->the_data, function ($the_data) use ($request) {
                return $the_data['form_part'] === $request['form_part'];
            });
        }

        return response()->json($case_data);
    }

    /**
     * Save CaseData
     */
    public function store(Request $request, $case_id): JsonResponse
    {
        $case = POCase::findOrFail($case_id);

        $section = $request['body']['section'];
        if (!isset($section)) {
            return new BadRequestException('Missing form section name', 400);
        }

        $case_data = CaseData::section($case, $section);

        if ($case_data) {
            $case_data->the_data = $request['body'];
        } else {
            $case_data = new CaseData();
            $case_data->case_id = $case->id;
            $case_data->the_data = $request['body'];
        }

        if ($case_data->save()) {
            return response()->json($case_data);
        } else {
            return new Exception('Failed to save section data', 500);
        }
    }
}
