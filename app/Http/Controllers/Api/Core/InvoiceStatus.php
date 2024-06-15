<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class InvoiceStatus extends Controller {
        public function index() {
            $model          = InvoiceStatus();
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
            if (method_exists(\Validation::class, "invoiceStatusStore")) {
                $validator = \Validator::make($data, \Validation::invoiceStatusStore()["rule"], \Validation::invoiceStatusStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceStatus = InvoiceStatus();
                $invoiceStatus->fill($data);
                $invoiceStatus->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceStatus->toArray()]);
            }
        }
        public function show($id) {
            $invoiceStatus = InvoiceStatus()->find($id);
            if (empty($invoiceStatus)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceStatus]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceStatusUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceStatusUpdate($id)["rule"], \Validation::invoiceStatusUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceStatus = InvoiceStatus()->find($id);
                if (empty($invoiceStatus)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $invoiceStatus->fill($data);
                $invoiceStatus->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceStatus->toArray()]);
            }
        }
        public function destroy($id) {
            $invoiceStatus = InvoiceStatus()->find($id);
            if (empty($invoiceStatus)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $invoiceStatus->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceStatus->toArray()]);
        }
    }
