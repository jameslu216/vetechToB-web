<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Http\Services\DiagnosisRecordService;
use App\Http\Services\ReservationService;

class DiagnosisRecordController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(
        DiagnosisRecordService $DiagnosisRecordService, ReservationService $ReservationService
    ) {
        $this->DiagnosisRecordService = $DiagnosisRecordService;
        $this->ReservationService = $ReservationService;
    }

    /**
     * 將指定的預約資料移進看診紀錄
     * @param  Request $request     [description]
     * @return Json  $diagnosis_record_data    [轉移預約資料]
     */
    public function moveAndCreateDiagnosisRecord(Request $request)
    {
        $move_diagnosis_record_data = $request->all();
        if (
            empty($move_diagnosis_record_data['clinic_id']) ||
            empty($move_diagnosis_record_data['reservation_id'])
        ) {
            return response('error', 400);
        }
        $reservation = $this->ReservationService->getReservationById($move_diagnosis_record_data['clinic_id'], $move_diagnosis_record_data['reservation_id']);
        if (!is_null($reservation)) {
            $diagnosis_record = $this->DiagnosisRecordService->createDiagnosisRecord($move_diagnosis_record_data['diagnosis_note'], $reservation);
            $this->ReservationService->removeReservation($move_diagnosis_record_data);
            $diagnosis_record_data = [];
            $diagnosis_record_data['clinic_id'] = $move_diagnosis_record_data['clinic_id'];
            $diagnosis_record_data['diagnosis_record_id'] = $diagnosis_record->id;
            $diagnosis_record_data['diagnosis_note'] = $move_diagnosis_record_data['diagnosis_note'];
            return response()->json($diagnosis_record_data, 200);            
        } else {            
            return response('error', 400);            
        }
    }

    /**
     * 查詢看診紀錄
     * @param  Request $request     [description]
     * @return Json  $diagnosis_record_data    [看診紀錄資料]
     */
    public function getDiagnosisRecord(Request $request)
    {
        $clinic_id = $request->clinic_id;
        $customer_id = $request->customer_id;
        if (
            empty($clinic_id) ||
            empty($customer_id)
        ) {
            return response('error', 400);
        }
        $diagnosis_record_data = $this->DiagnosisRecordService->getDiagnosisRecordById($clinic_id, $customer_id);
        return response()->json($diagnosis_record_data, 200);            
    }

}
