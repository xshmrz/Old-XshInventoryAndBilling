<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class OnlinePaymentTransaction extends Controller {
        public function index() {
            $model          = OnlinePaymentTransaction();
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
            if (method_exists(\Validation::class, "onlinePaymentTransactionStore")) {
                $validator = \Validator::make($data, \Validation::onlinePaymentTransactionStore()["rule"], \Validation::onlinePaymentTransactionStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $onlinePaymentTransaction = OnlinePaymentTransaction();
                $onlinePaymentTransaction->fill($data);
                $onlinePaymentTransaction->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $onlinePaymentTransaction->toArray()]);
            }
        }
        public function show($id) {
            $onlinePaymentTransaction = OnlinePaymentTransaction()->find($id);
            if (empty($onlinePaymentTransaction)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $onlinePaymentTransaction]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "onlinePaymentTransactionUpdate")) {
                $validator = \Validator::make($data, \Validation::onlinePaymentTransactionUpdate($id)["rule"], \Validation::onlinePaymentTransactionUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $onlinePaymentTransaction = OnlinePaymentTransaction()->find($id);
                if (empty($onlinePaymentTransaction)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $onlinePaymentTransaction->fill($data);
                $onlinePaymentTransaction->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $onlinePaymentTransaction->toArray()]);
            }
        }
        public function destroy($id) {
            $onlinePaymentTransaction = OnlinePaymentTransaction()->find($id);
            if (empty($onlinePaymentTransaction)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $onlinePaymentTransaction->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $onlinePaymentTransaction->toArray()]);
        }
    }
