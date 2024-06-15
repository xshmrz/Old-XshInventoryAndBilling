<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class RefundTransaction extends Controller {
        public function index() {
            $model          = RefundTransaction();
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
            if (method_exists(\Validation::class, "refundTransactionStore")) {
                $validator = \Validator::make($data, \Validation::refundTransactionStore()["rule"], \Validation::refundTransactionStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $refundTransaction = RefundTransaction();
                $refundTransaction->fill($data);
                $refundTransaction->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $refundTransaction->toArray()]);
            }
        }
        public function show($id) {
            $refundTransaction = RefundTransaction()->find($id);
            if (empty($refundTransaction)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $refundTransaction]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "refundTransactionUpdate")) {
                $validator = \Validator::make($data, \Validation::refundTransactionUpdate($id)["rule"], \Validation::refundTransactionUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $refundTransaction = RefundTransaction()->find($id);
                if (empty($refundTransaction)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $refundTransaction->fill($data);
                $refundTransaction->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $refundTransaction->toArray()]);
            }
        }
        public function destroy($id) {
            $refundTransaction = RefundTransaction()->find($id);
            if (empty($refundTransaction)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $refundTransaction->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $refundTransaction->toArray()]);
        }
    }
