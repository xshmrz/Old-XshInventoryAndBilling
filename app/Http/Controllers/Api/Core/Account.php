<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Account extends Controller {
        public function index() {
            $model          = Account();
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
            if (method_exists(\Validation::class, "accountStore")) {
                $validator = \Validator::make($data, \Validation::accountStore()["rule"], \Validation::accountStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $account = Account();
                $account->fill($data);
                $account->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $account->toArray()]);
            }
        }
        public function show($id) {
            $account = Account()->find($id);
            if (empty($account)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $account]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountUpdate")) {
                $validator = \Validator::make($data, \Validation::accountUpdate($id)["rule"], \Validation::accountUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $account = Account()->find($id);
                if (empty($account)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $account->fill($data);
                $account->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $account->toArray()]);
            }
        }
        public function destroy($id) {
            $account = Account()->find($id);
            if (empty($account)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $account->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $account->toArray()]);
        }
    }
