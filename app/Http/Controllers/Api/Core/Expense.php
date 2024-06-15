<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Expense extends Controller {
        public function index() {
            $model          = Expense();
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
            if (method_exists(\Validation::class, "expenseStore")) {
                $validator = \Validator::make($data, \Validation::expenseStore()["rule"], \Validation::expenseStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $expense = Expense();
                $expense->fill($data);
                $expense->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $expense->toArray()]);
            }
        }
        public function show($id) {
            $expense = Expense()->find($id);
            if (empty($expense)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $expense]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "expenseUpdate")) {
                $validator = \Validator::make($data, \Validation::expenseUpdate($id)["rule"], \Validation::expenseUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $expense = Expense()->find($id);
                if (empty($expense)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $expense->fill($data);
                $expense->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $expense->toArray()]);
            }
        }
        public function destroy($id) {
            $expense = Expense()->find($id);
            if (empty($expense)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $expense->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $expense->toArray()]);
        }
    }
