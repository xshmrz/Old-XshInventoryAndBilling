<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class ProductFeature extends Controller {
        public function index() {
            $model          = ProductFeature();
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
            if (method_exists(\Validation::class, "productFeatureStore")) {
                $validator = \Validator::make($data, \Validation::productFeatureStore()["rule"], \Validation::productFeatureStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $productFeature = ProductFeature();
                $productFeature->fill($data);
                $productFeature->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $productFeature->toArray()]);
            }
        }
        public function show($id) {
            $productFeature = ProductFeature()->find($id);
            if (empty($productFeature)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $productFeature]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "productFeatureUpdate")) {
                $validator = \Validator::make($data, \Validation::productFeatureUpdate($id)["rule"], \Validation::productFeatureUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $productFeature = ProductFeature()->find($id);
                if (empty($productFeature)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $productFeature->fill($data);
                $productFeature->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $productFeature->toArray()]);
            }
        }
        public function destroy($id) {
            $productFeature = ProductFeature()->find($id);
            if (empty($productFeature)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $productFeature->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $productFeature->toArray()]);
        }
    }
