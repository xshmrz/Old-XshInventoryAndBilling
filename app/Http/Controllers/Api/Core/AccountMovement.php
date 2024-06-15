<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class AccountMovement extends Controller {
        public function index() {
            $model          = AccountMovement();
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
            if (method_exists(\Validation::class, "accountMovementStore")) {
                $validator = \Validator::make($data, \Validation::accountMovementStore()["rule"], \Validation::accountMovementStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountMovement = AccountMovement();
                $accountMovement->fill($data);
                $accountMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountMovement->toArray()]);
            }
        }
        public function show($id) {
            $accountMovement = AccountMovement()->find($id);
            if (empty($accountMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $accountMovement]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountMovementUpdate")) {
                $validator = \Validator::make($data, \Validation::accountMovementUpdate($id)["rule"], \Validation::accountMovementUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $accountMovement = AccountMovement()->find($id);
                if (empty($accountMovement)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $accountMovement->fill($data);
                $accountMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $accountMovement->toArray()]);
            }
        }
        public function destroy($id) {
            $accountMovement = AccountMovement()->find($id);
            if (empty($accountMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $accountMovement->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $accountMovement->toArray()]);
        }
    }
