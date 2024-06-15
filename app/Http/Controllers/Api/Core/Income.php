<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Income extends Controller {
        public function index() {
            $model          = Income();
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
            if (method_exists(\Validation::class, "incomeStore")) {
                $validator = \Validator::make($data, \Validation::incomeStore()["rule"], \Validation::incomeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $income = Income();
                $income->fill($data);
                $income->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $income->toArray()]);
            }
        }
        public function show($id) {
            $income = Income()->find($id);
            if (empty($income)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $income]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "incomeUpdate")) {
                $validator = \Validator::make($data, \Validation::incomeUpdate($id)["rule"], \Validation::incomeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $income = Income()->find($id);
                if (empty($income)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $income->fill($data);
                $income->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $income->toArray()]);
            }
        }
        public function destroy($id) {
            $income = Income()->find($id);
            if (empty($income)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $income->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $income->toArray()]);
        }
    }
