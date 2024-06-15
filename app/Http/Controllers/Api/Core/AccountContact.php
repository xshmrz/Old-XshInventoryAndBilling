<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class AccountContact extends Controller {
        public function index() {
            $model          = AccountContact();
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
            if (method_exists(\Validation::class, "accountContactStore")) {
                $validator = \Validator::make($data, \Validation::accountContactStore()["rule"], \Validation::accountContactStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountContact = AccountContact();
                $accountContact->fill($data);
                $accountContact->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountContact->toArray()]);
            }
        }
        public function show($id) {
            $accountContact = AccountContact()->find($id);
            if (empty($accountContact)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $accountContact]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountContactUpdate")) {
                $validator = \Validator::make($data, \Validation::accountContactUpdate($id)["rule"], \Validation::accountContactUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountContact = AccountContact()->find($id);
                if (empty($accountContact)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $accountContact->fill($data);
                $accountContact->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountContact->toArray()]);
            }
        }
        public function destroy($id) {
            $accountContact = AccountContact()->find($id);
            if (empty($accountContact)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $accountContact->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $accountContact->toArray()]);
        }
    }
