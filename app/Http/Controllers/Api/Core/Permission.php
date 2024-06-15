<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Permission extends Controller {
        public function index() {
            $model          = Permission();
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
            if (method_exists(\Validation::class, "permissionStore")) {
                $validator = \Validator::make($data, \Validation::permissionStore()["rule"], \Validation::permissionStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $permission = Permission();
                $permission->fill($data);
                $permission->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $permission->toArray()]);
            }
        }
        public function show($id) {
            $permission = Permission()->find($id);
            if (empty($permission)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $permission]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "permissionUpdate")) {
                $validator = \Validator::make($data, \Validation::permissionUpdate($id)["rule"], \Validation::permissionUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $permission = Permission()->find($id);
                if (empty($permission)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $permission->fill($data);
                $permission->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $permission->toArray()]);
            }
        }
        public function destroy($id) {
            $permission = Permission()->find($id);
            if (empty($permission)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $permission->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $permission->toArray()]);
        }
    }
