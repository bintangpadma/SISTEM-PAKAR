<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Kerusakan;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->diagnosa_id;
        $gejala = Gejala::get();
        $diagnosa = Diagnosa::whereDiagnosaId($request->diagnosa_id)->first();
        $dataDiagnosa = json_decode($diagnosa->data_diagnosa, true);
        $max = max($dataDiagnosa);
        $maxKey = array_search($max, $dataDiagnosa);
        
        return view('home', [
            "gejala" => $gejala,
            "diagnosa_id" => $id,
            "diagnosa" => $diagnosa,
            "max" => $max,
            "maxKey" => $maxKey,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filteredArray = $request->post('gejala');

        $diagnosa = [];
        
        try{
            DB::beginTransaction();
            $kerusakan = Kerusakan::get();
            foreach ($kerusakan as $key => $value) {
                $gejalaBerdasarkanKerusakan = Gejala::where('kode_kerusakan', $value->kode_kerusakan)->get();

                foreach ($gejalaBerdasarkanKerusakan as $index => $data) {
                    foreach ($filteredArray as $k => $val) {
                        if ($data->kode_gejala == $k) {
                            if (isset($diagnosa[$data->kode_kerusakan])) {
                                $diagnosa[$data->kode_kerusakan] += $val;
                            } else {
                                $diagnosa[$data->kode_kerusakan] = $val;
                            }
                        }        
                    }
                }
            }

            $diagnosa_id = uniqid();
            $ins =  new Diagnosa();
            $ins->diagnosa_id = strval($diagnosa_id);
            $ins->data_diagnosa = json_encode($diagnosa);
            $ins->kondisi = json_encode($filteredArray);
            $ins->save();
        }catch(Expression $e){
            DB::rollBack();
            return $e;
        }

        DB::commit();
        return redirect()->route('diagnosa.result', ["diagnosa_id" => $diagnosa_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
