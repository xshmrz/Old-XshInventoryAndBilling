<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class UserActivityLog extends Controller {
        public function index() {
            $model          = UserActivityLog();
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
            if (method_exists(\Validation::class, "userActivityLogStore")) {
                $validator = \Validator::make($data, \Validation::userActivityLogStore()["rule"], \Validation::userActivityLogStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $userActivityLog = UserActivityLog();
                $userActivityLog->fill($data);
                $userActivityLog->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $userActivityLog->toArray()]);
            }
        }
        public function show($id) {
            $userActivityLog = UserActivityLog()->find($id);
            if (empty($userActivityLog)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $userActivityLog]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "userActivityLogUpdate")) {
                $validator = \Validator::make($data, \Validation::userActivityLogUpdate($id)["rule"], \Validation::userActivityLogUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $userActivityLog = UserActivityLog()->find($id);
                if (empty($userActivityLog)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $userActivityLog->fill($data);
                $userActivityLog->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $userActivityLog->toArray()]);
            }
        }
        public function destroy($id) {
            $userActivityLog = UserActivityLog()->find($id);
            if (empty($userActivityLog)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $userActivityLog->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $userActivityLog->toArray()]);
        }
    }
