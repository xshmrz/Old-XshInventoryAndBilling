<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class IncomeExpenseCategory extends Controller {
        public function index() {
            $model          = IncomeExpenseCategory();
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
            if (method_exists(\Validation::class, "incomeExpenseCategoryStore")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseCategoryStore()["rule"], \Validation::incomeExpenseCategoryStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $incomeExpenseCategory = IncomeExpenseCategory();
                $incomeExpenseCategory->fill($data);
                $incomeExpenseCategory->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseCategory->toArray()]);
            }
        }
        public function show($id) {
            $incomeExpenseCategory = IncomeExpenseCategory()->find($id);
            if (empty($incomeExpenseCategory)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseCategory]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "incomeExpenseCategoryUpdate")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseCategoryUpdate($id)["rule"], \Validation::incomeExpenseCategoryUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $incomeExpenseCategory = IncomeExpenseCategory()->find($id);
                if (empty($incomeExpenseCategory)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $incomeExpenseCategory->fill($data);
                $incomeExpenseCategory->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseCategory->toArray()]);
            }
        }
        public function destroy($id) {
            $incomeExpenseCategory = IncomeExpenseCategory()->find($id);
            if (empty($incomeExpenseCategory)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $incomeExpenseCategory->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $incomeExpenseCategory->toArray()]);
        }
    }
