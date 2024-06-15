<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class StockWarehouse extends Controller {
        public function index() {
            $model          = StockWarehouse();
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
            if (method_exists(\Validation::class, "stockWarehouseStore")) {
                $validator = \Validator::make($data, \Validation::stockWarehouseStore()["rule"], \Validation::stockWarehouseStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $stockWarehouse = StockWarehouse();
                $stockWarehouse->fill($data);
                $stockWarehouse->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $stockWarehouse->toArray()]);
            }
        }
        public function show($id) {
            $stockWarehouse = StockWarehouse()->find($id);
            if (empty($stockWarehouse)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $stockWarehouse]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "stockWarehouseUpdate")) {
                $validator = \Validator::make($data, \Validation::stockWarehouseUpdate($id)["rule"], \Validation::stockWarehouseUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $stockWarehouse = StockWarehouse()->find($id);
                if (empty($stockWarehouse)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $stockWarehouse->fill($data);
                $stockWarehouse->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $stockWarehouse->toArray()]);
            }
        }
        public function destroy($id) {
            $stockWarehouse = StockWarehouse()->find($id);
            if (empty($stockWarehouse)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $stockWarehouse->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $stockWarehouse->toArray()]);
        }
    }
