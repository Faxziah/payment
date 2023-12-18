<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();

        if (!$user->is_admin) {
            $data = [
                'status' => 'error',
                'code' => '403',
                'text' => 'Недостаточно прав для выполнения действия'
            ];

            return response()->json($data, 403);
        }

        $arFields = $request->all();

        // TODO добавить языковой файл
        $validator = Validator::make($arFields, [
            'outer_payment_id' => 'required|numeric',
            'type' => 'required|in:deposit,withdrawal',
            'user_login' => 'required|string',
            'requisites' => 'required|string',
            'sum' => 'required|numeric',
            'currency' => 'required|in:RUB, USD',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {

            $data = [
                'status' => 'error',
                'code' => '422',
                'text' => $validator->errors()->toArray()
            ];

            return response()->json($data, 422);
        }

        $login = $request->get('user_login');
        $user = User::where('login', $login)->first();

        if (empty($user)) {
            $data = [
                'status' => 'error',
                'code' => '401',
                'text' => 'Пользователь не найден'
            ];

            return response()->json($data, 401);
        }

        $payment = new Payment();

        foreach ($arFields as $fieldName => $fieldValue) {
            $payment->{$fieldName} = $fieldValue;
        }
        $payment->save();

        $data = [
            'status' => 'success',
            'code' => '201',
            'text' => 'Запись успешно создана'
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // TODO добавить языковой файл
        $validator = Validator::make($request->all(), [
            'user_login' => 'required_without:outer_payment_id|string',
            'outer_payment_id' => 'required_without:user_login|numeric',
        ]);

        if ($validator->fails()) {
            $data = [
                'status' => 'error',
                'code' => '422',
                'text' => $validator->errors()->toArray()
            ];

            return response()->json($data, 422);
        }

        $query = Payment::query();

        $userLogin = $request->get('user_login');
        if (!empty($userLogin)) {
            $query->where('user_login', $userLogin);
        }

        $outerPaymentId = $request->get('outer_payment_id');
        if (!empty($outerPaymentId)) {
            $query->where('outer_payment_id', $outerPaymentId);
        }

        $arResult = $query->get()->toArray();

        $data = [
            'status' => 'success',
            'code' => '200',
            'data' => $arResult
        ];

        return response()->json($data, 400);
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
            'value' => ['required', 'in:1'],
        ]);

        if ($validator->fails()) {
            return response()->json(['text' => $validator->errors()->toArray()], 422);
        }

        $record = Payment::find($arRequest['id']);

        if (empty($record)) {
            return response()->json(['text' => 'Запись не найдена'], 422);
        }

        if ($record->status === 1) {
            return response()->json(['text' => 'Заказ уже оплачен'], 422);
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
