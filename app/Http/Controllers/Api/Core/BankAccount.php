<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class BankAccount extends Controller {
        public function index() {
            $model          = BankAccount();
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
            if (method_exists(\Validation::class, "bankAccountStore")) {
                $validator = \Validator::make($data, \Validation::bankAccountStore()["rule"], \Validation::bankAccountStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $bankAccount = BankAccount();
                $bankAccount->fill($data);
                $bankAccount->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $bankAccount->toArray()]);
            }
        }
        public function show($id) {
            $bankAccount = BankAccount()->find($id);
            if (empty($bankAccount)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $bankAccount]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "bankAccountUpdate")) {
                $validator = \Validator::make($data, \Validation::bankAccountUpdate($id)["rule"], \Validation::bankAccountUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $bankAccount = BankAccount()->find($id);
                if (empty($bankAccount)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $bankAccount->fill($data);
                $bankAccount->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $bankAccount->toArray()]);
            }
        }
        public function destroy($id) {
            $bankAccount = BankAccount()->find($id);
            if (empty($bankAccount)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $bankAccount->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $bankAccount->toArray()]);
        }
    }
