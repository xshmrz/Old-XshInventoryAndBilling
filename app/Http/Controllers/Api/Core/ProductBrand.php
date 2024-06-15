<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class ProductBrand extends Controller {
        public function index() {
            $model          = ProductBrand();
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
            if (method_exists(\Validation::class, "productBrandStore")) {
                $validator = \Validator::make($data, \Validation::productBrandStore()["rule"], \Validation::productBrandStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $productBrand = ProductBrand();
                $productBrand->fill($data);
                $productBrand->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $productBrand->toArray()]);
            }
        }
        public function show($id) {
            $productBrand = ProductBrand()->find($id);
            if (empty($productBrand)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $productBrand]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "productBrandUpdate")) {
                $validator = \Validator::make($data, \Validation::productBrandUpdate($id)["rule"], \Validation::productBrandUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $productBrand = ProductBrand()->find($id);
                if (empty($productBrand)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $productBrand->fill($data);
                $productBrand->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $productBrand->toArray()]);
            }
        }
        public function destroy($id) {
            $productBrand = ProductBrand()->find($id);
            if (empty($productBrand)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $productBrand->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $productBrand->toArray()]);
        }
    }
