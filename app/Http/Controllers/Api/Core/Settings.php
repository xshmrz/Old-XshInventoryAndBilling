<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Settings extends Controller {
        public function index() {
            $model          = Settings();
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
            if (method_exists(\Validation::class, "settingsStore")) {
                $validator = \Validator::make($data, \Validation::settingsStore()["rule"], \Validation::settingsStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $settings = Settings();
                $settings->fill($data);
                $settings->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $settings->toArray()]);
            }
        }
        public function show($id) {
            $settings = Settings()->find($id);
            if (empty($settings)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $settings]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "settingsUpdate")) {
                $validator = \Validator::make($data, \Validation::settingsUpdate($id)["rule"], \Validation::settingsUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $settings = Settings()->find($id);
                if (empty($settings)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $settings->fill($data);
                $settings->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $settings->toArray()]);
            }
        }
        public function destroy($id) {
            $settings = Settings()->find($id);
            if (empty($settings)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $settings->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $settings->toArray()]);
        }
    }
