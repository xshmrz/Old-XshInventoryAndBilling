<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class PaymentProvider extends Controller {
        public function index() {
            $model          = PaymentProvider();
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
            if (method_exists(\Validation::class, "paymentProviderStore")) {
                $validator = \Validator::make($data, \Validation::paymentProviderStore()["rule"], \Validation::paymentProviderStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $paymentProvider = PaymentProvider();
                $paymentProvider->fill($data);
                $paymentProvider->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $paymentProvider->toArray()]);
            }
        }
        public function show($id) {
            $paymentProvider = PaymentProvider()->find($id);
            if (empty($paymentProvider)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $paymentProvider]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentProviderUpdate")) {
                $validator = \Validator::make($data, \Validation::paymentProviderUpdate($id)["rule"], \Validation::paymentProviderUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $paymentProvider = PaymentProvider()->find($id);
                if (empty($paymentProvider)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $paymentProvider->fill($data);
                $paymentProvider->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $paymentProvider->toArray()]);
            }
        }
        public function destroy($id) {
            $paymentProvider = PaymentProvider()->find($id);
            if (empty($paymentProvider)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $paymentProvider->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $paymentProvider->toArray()]);
        }
    }
