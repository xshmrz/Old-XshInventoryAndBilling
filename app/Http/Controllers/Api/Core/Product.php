<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Product extends Controller {
        public function index() {
            $model          = Product();
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
            if (method_exists(\Validation::class, "productStore")) {
                $validator = \Validator::make($data, \Validation::productStore()["rule"], \Validation::productStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $product = Product();
                $product->fill($data);
                $product->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $product->toArray()]);
            }
        }
        public function show($id) {
            $product = Product()->find($id);
            if (empty($product)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $product]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "productUpdate")) {
                $validator = \Validator::make($data, \Validation::productUpdate($id)["rule"], \Validation::productUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $product = Product()->find($id);
                if (empty($product)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $product->fill($data);
                $product->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $product->toArray()]);
            }
        }
        public function destroy($id) {
            $product = Product()->find($id);
            if (empty($product)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $product->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $product->toArray()]);
        }
    }
