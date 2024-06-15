<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class StockMovement extends Controller {
        public function index() {
            $model          = StockMovement();
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
            if (method_exists(\Validation::class, "stockMovementStore")) {
                $validator = \Validator::make($data, \Validation::stockMovementStore()["rule"], \Validation::stockMovementStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $stockMovement = StockMovement();
                $stockMovement->fill($data);
                $stockMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $stockMovement->toArray()]);
            }
        }
        public function show($id) {
            $stockMovement = StockMovement()->find($id);
            if (empty($stockMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $stockMovement]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "stockMovementUpdate")) {
                $validator = \Validator::make($data, \Validation::stockMovementUpdate($id)["rule"], \Validation::stockMovementUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $stockMovement = StockMovement()->find($id);
                if (empty($stockMovement)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $stockMovement->fill($data);
                $stockMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $stockMovement->toArray()]);
            }
        }
        public function destroy($id) {
            $stockMovement = StockMovement()->find($id);
            if (empty($stockMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $stockMovement->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $stockMovement->toArray()]);
        }
    }
