<?php

namespace App\Http\Controllers;

use App\Models\ManufacturingMaterials;
use App\Models\MaterialQuotation;
use App\Models\MaterialRequest;
use App\Models\RequestedRawMat;
use App\Models\Station;
use App\Models\MaterialUOM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class MatRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mat_requests = MaterialRequest::get();
        return view('modules.buying.materialrequest', [
            'mat_requests' => $mat_requests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = ManufacturingMaterials::get();
        $stations = Station::get();
        $units = MaterialUOM::get();
        return view('modules.buying.newMaterialRequest',[
            'materials' => $materials,
            'stations' => $stations,
            'units' => $units,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'item_code' => 'required|array',
            'item_code.*' => 'required|string|exists:env_raw_materials,item_code',
            // MAY NEED TO CHANGE TO STATION_ID INSTEAD OF JUST ID    -v-
            'station_id.*' => 'required|string|exists:stations,station_id',
            'quantity_requested.*' => 'required|integer|min:0',
            'procurement_method.*' => 'required|string',
            'required_date' => 'required|date',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $matRequest = new MaterialRequest();
            $matRequest->request_date = Carbon::now();
            $matRequest->required_date = request('required_date');
            $matRequest->purpose = request('purpose') ?? 'No description provided.';
            $matRequest->mr_status = request('mr_status');
            $matRequest->request_id = "REQ";
            $matRequest->save();
            $matRequest->request_id = "MAT-MR-".Carbon::now()->year."-".str_pad($matRequest->id, 5, '0', STR_PAD_LEFT);
            $id_copy = "MAT-MR-".Carbon::now()->year."-".str_pad($matRequest->id, 5, '0', STR_PAD_LEFT);
            $matRequest->save();
            for($i=0; $i<sizeof(request('item_code')); $i++){
                $requestItem = new RequestedRawMat();
                $requestItem->request_id = $matRequest->request_id;
                $requestItem->item_code = request('item_code')[$i];
                $requestItem->quantity_requested = request('quantity_requested')[$i];
                $requestItem->procurement_method = request('procurement_method')[$i];
                $requestItem->uom_id = request('uom_id')[$i];
                $requestItem->station_id = request('station_id')[$i];
                $requestItem->save();
            }



            return response()->json([
                'status' => 'success',
                'information' => $request->all(),
                'request' => $matRequest,
                'raw_mats_with_qty' => $matRequest->rawMats,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialRequest $materialrequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialRequest $materialrequest)
    {
        $materials = ManufacturingMaterials::with('uom')->get();
        $stations = Station::get();
        $units = MaterialUOM::get();
        return view('modules.buying.materialReqmodules.edit_matreq_form', [
            'materialRequest' => $materialrequest,
            'materials' => $materials,
            'stations' => $stations,
            'units' => $units,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialRequest $materialrequest)
    {
        $rules = [
            'item_code' => 'required|array',
            'item_code.*' => 'required|string|exists:env_raw_materials,item_code',
            // MAY NEED TO CHANGE TO STATION_ID INSTEAD OF JUST ID    -v-
            'station_id.*' => 'required|string|exists:stations,station_id',
            'quantity_requested.*' => 'required|integer|min:0',
            'procurement_method.*' => 'required|string',
            'required_date' => 'required|date',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ]);
        }
        try{ 
            $materialrequest->update($request->all());
            // Deleting the entries related to this request in the request mats table
            RequestedRawMat::where('request_id', '=', $materialrequest->request_id)->delete();
            // Replacing the deleted entries with the updated entries
            for($i=0; $i<sizeof(request('item_code')); $i++){
                $requestItem = new RequestedRawMat();
                $requestItem->request_id = $materialrequest->request_id;
                $requestItem->item_code = request('item_code')[$i];
                $requestItem->quantity_requested = request('quantity_requested')[$i];
                $requestItem->procurement_method = request('procurement_method')[$i];
                $requestItem->uom_id = request('uom_id')[$i];
                $requestItem->station_id = request('station_id')[$i];
                $requestItem->save();
            }
            return response()->json([
                'status' => 'success',
                'update' => true,
                'materialrequest' => $materialrequest,
                'request' => $request->all(),
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaterialRequest  $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialRequest $materialrequest)
    {
        $id = $materialrequest->id;
        try{
            RequestedRawMat::where('request_id', $materialrequest->request_id)->delete();
            MaterialQuotation::where('request_id', $materialrequest->request_id)->delete();
            $materialrequest->delete();
            return response()->json([
                'status' => 'success',
                'id' => $id,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Set the status of a material request to "submitted"
     * 
     * @param \App\Models\MaterialRequest $materialrequest
     * @return \Illuminate\Http\Response
     */
    public function submit(MaterialRequest $materialrequest){
        try{
            $materialrequest->mr_status = "Submitted";
            $materialrequest->save();

            $quotation = new MaterialQuotation();
            $quotation->request_id = $materialrequest->request_id;
            $quotation->date_created = Carbon::now();
            
            $items = $materialrequest->raw_mats;
            $item_array = array();
            foreach($items as $item) {
                $item_array[] = array(
                    'item_code' => $item->item_code,
                    'qty' => $item->quantity_requested,
                    'uom_id' => $item->uom_id,
                    'station' => $item->station_id,
                    'method' => $item->procurement_method
                );
            }

            $quotation->item_list = json_encode($item_array);
            $quotation->save();
            return response()->json([
                'status' => 'success',
                'materialrequest' => $materialrequest,
                'message' => 'Submitted ' . $materialrequest->request_id,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
