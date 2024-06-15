<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class AccountBalance extends Controller {
        public function index() {
            $model          = AccountBalance();
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
            if (method_exists(\Validation::class, "accountBalanceStore")) {
                $validator = \Validator::make($data, \Validation::accountBalanceStore()["rule"], \Validation::accountBalanceStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountBalance = AccountBalance();
                $accountBalance->fill($data);
                $accountBalance->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountBalance->toArray()]);
            }
        }
        public function show($id) {
            $accountBalance = AccountBalance()->find($id);
            if (empty($accountBalance)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $accountBalance]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountBalanceUpdate")) {
                $validator = \Validator::make($data, \Validation::accountBalanceUpdate($id)["rule"], \Validation::accountBalanceUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountBalance = AccountBalance()->find($id);
                if (empty($accountBalance)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $accountBalance->fill($data);
                $accountBalance->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountBalance->toArray()]);
            }
        }
        public function destroy($id) {
            $accountBalance = AccountBalance()->find($id);
            if (empty($accountBalance)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $accountBalance->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $accountBalance->toArray()]);
        }
    }
