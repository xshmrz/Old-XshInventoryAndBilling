<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class InvoiceType extends Controller {
        public function index() {
            $model          = InvoiceType();
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
            if (method_exists(\Validation::class, "invoiceTypeStore")) {
                $validator = \Validator::make($data, \Validation::invoiceTypeStore()["rule"], \Validation::invoiceTypeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceType = InvoiceType();
                $invoiceType->fill($data);
                $invoiceType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceType->toArray()]);
            }
        }
        public function show($id) {
            $invoiceType = InvoiceType()->find($id);
            if (empty($invoiceType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceType]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceTypeUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceTypeUpdate($id)["rule"], \Validation::invoiceTypeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceType = InvoiceType()->find($id);
                if (empty($invoiceType)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $invoiceType->fill($data);
                $invoiceType->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceType->toArray()]);
            }
        }
        public function destroy($id) {
            $invoiceType = InvoiceType()->find($id);
            if (empty($invoiceType)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $invoiceType->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceType->toArray()]);
        }
    }
