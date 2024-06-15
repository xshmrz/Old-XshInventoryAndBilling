<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class UserRole extends Controller {
        public function index() {
            $model          = UserRole();
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
            if (method_exists(\Validation::class, "userRoleStore")) {
                $validator = \Validator::make($data, \Validation::userRoleStore()["rule"], \Validation::userRoleStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $userRole = UserRole();
                $userRole->fill($data);
                $userRole->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $userRole->toArray()]);
            }
        }
        public function show($id) {
            $userRole = UserRole()->find($id);
            if (empty($userRole)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $userRole]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "userRoleUpdate")) {
                $validator = \Validator::make($data, \Validation::userRoleUpdate($id)["rule"], \Validation::userRoleUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $userRole = UserRole()->find($id);
                if (empty($userRole)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $userRole->fill($data);
                $userRole->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $userRole->toArray()]);
            }
        }
        public function destroy($id) {
            $userRole = UserRole()->find($id);
            if (empty($userRole)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $userRole->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $userRole->toArray()]);
        }
    }
