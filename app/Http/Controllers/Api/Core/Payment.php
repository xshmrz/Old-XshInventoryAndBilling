<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Payment extends Controller {
        public function index() {
            $model          = Payment();
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
            if (method_exists(\Validation::class, "paymentStore")) {
                $validator = \Validator::make($data, \Validation::paymentStore()["rule"], \Validation::paymentStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $payment = Payment();
                $payment->fill($data);
                $payment->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $payment->toArray()]);
            }
        }
        public function show($id) {
            $payment = Payment()->find($id);
            if (empty($payment)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $payment]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentUpdate")) {
                $validator = \Validator::make($data, \Validation::paymentUpdate($id)["rule"], \Validation::paymentUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $payment = Payment()->find($id);
                if (empty($payment)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $payment->fill($data);
                $payment->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $payment->toArray()]);
            }
        }
        public function destroy($id) {
            $payment = Payment()->find($id);
            if (empty($payment)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $payment->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $payment->toArray()]);
        }
    }
