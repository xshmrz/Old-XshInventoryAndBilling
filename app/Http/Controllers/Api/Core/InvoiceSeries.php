<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class InvoiceSeries extends Controller {
        public function index() {
            $model          = InvoiceSeries();
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
            if (method_exists(\Validation::class, "invoiceSeriesStore")) {
                $validator = \Validator::make($data, \Validation::invoiceSeriesStore()["rule"], \Validation::invoiceSeriesStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceSeries = InvoiceSeries();
                $invoiceSeries->fill($data);
                $invoiceSeries->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceSeries->toArray()]);
            }
        }
        public function show($id) {
            $invoiceSeries = InvoiceSeries()->find($id);
            if (empty($invoiceSeries)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceSeries]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceSeriesUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceSeriesUpdate($id)["rule"], \Validation::invoiceSeriesUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $invoiceSeries = InvoiceSeries()->find($id);
                if (empty($invoiceSeries)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $invoiceSeries->fill($data);
                $invoiceSeries->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $invoiceSeries->toArray()]);
            }
        }
        public function destroy($id) {
            $invoiceSeries = InvoiceSeries()->find($id);
            if (empty($invoiceSeries)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $invoiceSeries->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $invoiceSeries->toArray()]);
        }
    }
