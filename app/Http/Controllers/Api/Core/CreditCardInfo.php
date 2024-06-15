<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class CreditCardInfo extends Controller {
        public function index() {
            $model          = CreditCardInfo();
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
            if (method_exists(\Validation::class, "creditCardInfoStore")) {
                $validator = \Validator::make($data, \Validation::creditCardInfoStore()["rule"], \Validation::creditCardInfoStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $creditCardInfo = CreditCardInfo();
                $creditCardInfo->fill($data);
                $creditCardInfo->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $creditCardInfo->toArray()]);
            }
        }
        public function show($id) {
            $creditCardInfo = CreditCardInfo()->find($id);
            if (empty($creditCardInfo)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $creditCardInfo]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "creditCardInfoUpdate")) {
                $validator = \Validator::make($data, \Validation::creditCardInfoUpdate($id)["rule"], \Validation::creditCardInfoUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $creditCardInfo = CreditCardInfo()->find($id);
                if (empty($creditCardInfo)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $creditCardInfo->fill($data);
                $creditCardInfo->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $creditCardInfo->toArray()]);
            }
        }
        public function destroy($id) {
            $creditCardInfo = CreditCardInfo()->find($id);
            if (empty($creditCardInfo)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $creditCardInfo->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $creditCardInfo->toArray()]);
        }
    }
