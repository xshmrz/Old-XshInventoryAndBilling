<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class AccountType extends Controller {
        public function index() {
            $model          = AccountType();
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
            if (method_exists(\Validation::class, "accountTypeStore")) {
                $validator = \Validator::make($data, \Validation::accountTypeStore()["rule"], \Validation::accountTypeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountType = AccountType();
                $accountType->fill($data);
                $accountType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountType->toArray()]);
            }
        }
        public function show($id) {
            $accountType = AccountType()->find($id);
            if (empty($accountType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $accountType]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountTypeUpdate")) {
                $validator = \Validator::make($data, \Validation::accountTypeUpdate($id)["rule"], \Validation::accountTypeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountType = AccountType()->find($id);
                if (empty($accountType)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $accountType->fill($data);
                $accountType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountType->toArray()]);
            }
        }
        public function destroy($id) {
            $accountType = AccountType()->find($id);
            if (empty($accountType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $accountType->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $accountType->toArray()]);
        }
    }
