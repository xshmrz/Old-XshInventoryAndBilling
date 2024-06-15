<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class PaymentMethod extends Controller {
        public function index() {
            $model          = PaymentMethod();
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
            if (method_exists(\Validation::class, "paymentMethodStore")) {
                $validator = \Validator::make($data, \Validation::paymentMethodStore()["rule"], \Validation::paymentMethodStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $paymentMethod = PaymentMethod();
                $paymentMethod->fill($data);
                $paymentMethod->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $paymentMethod->toArray()]);
            }
        }
        public function show($id) {
            $paymentMethod = PaymentMethod()->find($id);
            if (empty($paymentMethod)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $paymentMethod]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentMethodUpdate")) {
                $validator = \Validator::make($data, \Validation::paymentMethodUpdate($id)["rule"], \Validation::paymentMethodUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $paymentMethod = PaymentMethod()->find($id);
                if (empty($paymentMethod)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $paymentMethod->fill($data);
                $paymentMethod->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $paymentMethod->toArray()]);
            }
        }
        public function destroy($id) {
            $paymentMethod = PaymentMethod()->find($id);
            if (empty($paymentMethod)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $paymentMethod->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $paymentMethod->toArray()]);
        }
    }
