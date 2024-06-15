<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class ProductCategory extends Controller {
        public function index() {
            $model          = ProductCategory();
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
            if (method_exists(\Validation::class, "productCategoryStore")) {
                $validator = \Validator::make($data, \Validation::productCategoryStore()["rule"], \Validation::productCategoryStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $productCategory = ProductCategory();
                $productCategory->fill($data);
                $productCategory->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $productCategory->toArray()]);
            }
        }
        public function show($id) {
            $productCategory = ProductCategory()->find($id);
            if (empty($productCategory)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $productCategory]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "productCategoryUpdate")) {
                $validator = \Validator::make($data, \Validation::productCategoryUpdate($id)["rule"], \Validation::productCategoryUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $productCategory = ProductCategory()->find($id);
                if (empty($productCategory)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $productCategory->fill($data);
                $productCategory->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $productCategory->toArray()]);
            }
        }
        public function destroy($id) {
            $productCategory = ProductCategory()->find($id);
            if (empty($productCategory)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $productCategory->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $productCategory->toArray()]);
        }
    }
