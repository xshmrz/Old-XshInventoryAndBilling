<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class InvoicePaymentMethod extends Controller {
        public function index() {
            $model          = InvoicePaymentMethod();
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
            if (method_exists(\Validation::class, "invoicePaymentMethodStore")) {
                $validator = \Validator::make($data, \Validation::invoicePaymentMethodStore()["rule"], \Validation::invoicePaymentMethodStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoicePaymentMethod = InvoicePaymentMethod();
                $invoicePaymentMethod->fill($data);
                $invoicePaymentMethod->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoicePaymentMethod->toArray()]);
            }
        }
        public function show($id) {
            $invoicePaymentMethod = InvoicePaymentMethod()->find($id);
            if (empty($invoicePaymentMethod)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $invoicePaymentMethod]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoicePaymentMethodUpdate")) {
                $validator = \Validator::make($data, \Validation::invoicePaymentMethodUpdate($id)["rule"], \Validation::invoicePaymentMethodUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoicePaymentMethod = InvoicePaymentMethod()->find($id);
                if (empty($invoicePaymentMethod)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $invoicePaymentMethod->fill($data);
                $invoicePaymentMethod->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoicePaymentMethod->toArray()]);
            }
        }
        public function destroy($id) {
            $invoicePaymentMethod = InvoicePaymentMethod()->find($id);
            if (empty($invoicePaymentMethod)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $invoicePaymentMethod->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $invoicePaymentMethod->toArray()]);
        }
    }
