<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class AccountGroup extends Controller {
        public function index() {
            $model          = AccountGroup();
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
            if (method_exists(\Validation::class, "accountGroupStore")) {
                $validator = \Validator::make($data, \Validation::accountGroupStore()["rule"], \Validation::accountGroupStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountGroup = AccountGroup();
                $accountGroup->fill($data);
                $accountGroup->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountGroup->toArray()]);
            }
        }
        public function show($id) {
            $accountGroup = AccountGroup()->find($id);
            if (empty($accountGroup)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $accountGroup]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountGroupUpdate")) {
                $validator = \Validator::make($data, \Validation::accountGroupUpdate($id)["rule"], \Validation::accountGroupUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountGroup = AccountGroup()->find($id);
                if (empty($accountGroup)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $accountGroup->fill($data);
                $accountGroup->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountGroup->toArray()]);
            }
        }
        public function destroy($id) {
            $accountGroup = AccountGroup()->find($id);
            if (empty($accountGroup)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $accountGroup->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $accountGroup->toArray()]);
        }
    }
