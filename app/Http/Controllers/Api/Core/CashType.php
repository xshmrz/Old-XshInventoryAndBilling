<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class CashType extends Controller {
        public function index() {
            $model          = CashType();
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
            if (method_exists(\Validation::class, "cashTypeStore")) {
                $validator = \Validator::make($data, \Validation::cashTypeStore()["rule"], \Validation::cashTypeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $cashType = CashType();
                $cashType->fill($data);
                $cashType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $cashType->toArray()]);
            }
        }
        public function show($id) {
            $cashType = CashType()->find($id);
            if (empty($cashType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $cashType]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "cashTypeUpdate")) {
                $validator = \Validator::make($data, \Validation::cashTypeUpdate($id)["rule"], \Validation::cashTypeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $cashType = CashType()->find($id);
                if (empty($cashType)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $cashType->fill($data);
                $cashType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $cashType->toArray()]);
            }
        }
        public function destroy($id) {
            $cashType = CashType()->find($id);
            if (empty($cashType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $cashType->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $cashType->toArray()]);
        }
    }
