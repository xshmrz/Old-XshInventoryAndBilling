<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class Invoice extends Controller {
        public function index() {
            $model          = Invoice();
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
            if (method_exists(\Validation::class, "invoiceStore")) {
                $validator = \Validator::make($data, \Validation::invoiceStore()["rule"], \Validation::invoiceStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoice = Invoice();
                $invoice->fill($data);
                $invoice->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoice->toArray()]);
            }
        }
        public function show($id) {
            $invoice = Invoice()->find($id);
            if (empty($invoice)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $invoice]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceUpdate($id)["rule"], \Validation::invoiceUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoice = Invoice()->find($id);
                if (empty($invoice)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $invoice->fill($data);
                $invoice->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoice->toArray()]);
            }
        }
        public function destroy($id) {
            $invoice = Invoice()->find($id);
            if (empty($invoice)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $invoice->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $invoice->toArray()]);
        }
    }
