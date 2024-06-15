<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class InvoiceDetail extends Controller {
        public function index() {
            $model          = InvoiceDetail();
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
            if (method_exists(\Validation::class, "invoiceDetailStore")) {
                $validator = \Validator::make($data, \Validation::invoiceDetailStore()["rule"], \Validation::invoiceDetailStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceDetail = InvoiceDetail();
                $invoiceDetail->fill($data);
                $invoiceDetail->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceDetail->toArray()]);
            }
        }
        public function show($id) {
            $invoiceDetail = InvoiceDetail()->find($id);
            if (empty($invoiceDetail)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceDetail]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceDetailUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceDetailUpdate($id)["rule"], \Validation::invoiceDetailUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceDetail = InvoiceDetail()->find($id);
                if (empty($invoiceDetail)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $invoiceDetail->fill($data);
                $invoiceDetail->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceDetail->toArray()]);
            }
        }
        public function destroy($id) {
            $invoiceDetail = InvoiceDetail()->find($id);
            if (empty($invoiceDetail)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $invoiceDetail->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceDetail->toArray()]);
        }
    }
