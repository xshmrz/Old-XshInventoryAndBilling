<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class IncomeExpenseType extends Controller {
        public function index() {
            $model          = IncomeExpenseType();
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
            if (method_exists(\Validation::class, "incomeExpenseTypeStore")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseTypeStore()["rule"], \Validation::incomeExpenseTypeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $incomeExpenseType = IncomeExpenseType();
                $incomeExpenseType->fill($data);
                $incomeExpenseType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseType->toArray()]);
            }
        }
        public function show($id) {
            $incomeExpenseType = IncomeExpenseType()->find($id);
            if (empty($incomeExpenseType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseType]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "incomeExpenseTypeUpdate")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseTypeUpdate($id)["rule"], \Validation::incomeExpenseTypeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $incomeExpenseType = IncomeExpenseType()->find($id);
                if (empty($incomeExpenseType)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $incomeExpenseType->fill($data);
                $incomeExpenseType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseType->toArray()]);
            }
        }
        public function destroy($id) {
            $incomeExpenseType = IncomeExpenseType()->find($id);
            if (empty($incomeExpenseType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $incomeExpenseType->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseType->toArray()]);
        }
    }
