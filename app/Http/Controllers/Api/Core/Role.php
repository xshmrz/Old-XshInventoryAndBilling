<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Role extends Controller {
        public function index() {
            $model          = Role();
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
            if (method_exists(\Validation::class, "roleStore")) {
                $validator = \Validator::make($data, \Validation::roleStore()["rule"], \Validation::roleStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $role = Role();
                $role->fill($data);
                $role->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $role->toArray()]);
            }
        }
        public function show($id) {
            $role = Role()->find($id);
            if (empty($role)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $role]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "roleUpdate")) {
                $validator = \Validator::make($data, \Validation::roleUpdate($id)["rule"], \Validation::roleUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $role = Role()->find($id);
                if (empty($role)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $role->fill($data);
                $role->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $role->toArray()]);
            }
        }
        public function destroy($id) {
            $role = Role()->find($id);
            if (empty($role)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $role->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $role->toArray()]);
        }
    }
