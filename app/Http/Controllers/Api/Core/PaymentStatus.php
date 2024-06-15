<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class PaymentStatus extends Controller {
        public function index() {
            $model          = PaymentStatus();
            $queryBuilder   = new QueryBuilder($model, \request());
            $queryBuilder   = $queryBuilder->build();
            if (\request()->has("pagination") && \request()->get("pagination") == "true") {
                if (\request()->has("per_page")) {
                    return responseOk(["message" => trans("app.Successful"), "data" => $queryBuilder->paginate(\request()->get("per_page"))->appends(\request()->except('page'))]);
                }
                else {
                    return responseOk(["message" => trans("app.Successful"), "data" => $queryBuilder->paginate()->appends(\request()->get('page'))]);
                }
            }
            else {
                return responseOk(["message" => trans("app.Successful"), "data" => $queryBuilder->get()]);
            }
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentStatusStore")) {
                $validator = \Validator::make($data, \Validation::paymentStatusStore()["rule"], \Validation::paymentStatusStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $paymentStatus = PaymentStatus();
                $paymentStatus->fill($data);
                $paymentStatus->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $paymentStatus->toArray()]);
            }
        }
        public function show($id) {
            $paymentStatus = PaymentStatus()->find($id);
            if (empty($paymentStatus)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $paymentStatus]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentStatusUpdate")) {
                $validator = \Validator::make($data, \Validation::paymentStatusUpdate($id)["rule"], \Validation::paymentStatusUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $paymentStatus = PaymentStatus()->find($id);
                if (empty($paymentStatus)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $paymentStatus->fill($data);
                $paymentStatus->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $paymentStatus->toArray()]);
            }
        }
        public function destroy($id) {
            $paymentStatus = PaymentStatus()->find($id);
            if (empty($paymentStatus)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $paymentStatus->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $paymentStatus->toArray()]);
        }
    }
