<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class StockCount extends Controller {
        public function index() {
            $model          = StockCount();
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
            if (method_exists(\Validation::class, "stockCountStore")) {
                $validator = \Validator::make($data, \Validation::stockCountStore()["rule"], \Validation::stockCountStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $stockCount = StockCount();
                $stockCount->fill($data);
                $stockCount->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $stockCount->toArray()]);
            }
        }
        public function show($id) {
            $stockCount = StockCount()->find($id);
            if (empty($stockCount)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $stockCount]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "stockCountUpdate")) {
                $validator = \Validator::make($data, \Validation::stockCountUpdate($id)["rule"], \Validation::stockCountUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $stockCount = StockCount()->find($id);
                if (empty($stockCount)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $stockCount->fill($data);
                $stockCount->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $stockCount->toArray()]);
            }
        }
        public function destroy($id) {
            $stockCount = StockCount()->find($id);
            if (empty($stockCount)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $stockCount->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $stockCount->toArray()]);
        }
    }
