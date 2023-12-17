<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['payments'] = Payment::all()->toArray();
        return view('admin.payment')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $arRequest = $request->all();

        $arAllowedFields = [
            // При необходимости добавить поля для возможности редактирования
            'status'
        ];

        $validator = Validator::make($arRequest, [
            'id' => 'required|numeric',
            'field' => ['required', 'in:' . implode(',', $arAllowedFields)],
            'value' => ['required', 'in:0,1'],
        ]);

        if ($validator->fails()) {
            return response()->json(['text' => $validator->errors()[0]], 422);
        }

        $record = Payment::find($arRequest['id']);

        if (empty($record)) {
            return response()->json(['text' => 'Запись не найдена'], 422);
        }

        // Обновите значение столбца
        $record->update(['status' => $arRequest['value']]);

        return [
            'text' => 'Запись обновлена',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
