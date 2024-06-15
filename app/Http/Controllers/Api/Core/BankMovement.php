<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class BankMovement extends Controller {
        public function index() {
            $model          = BankMovement();
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
            if (method_exists(\Validation::class, "bankMovementStore")) {
                $validator = \Validator::make($data, \Validation::bankMovementStore()["rule"], \Validation::bankMovementStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $bankMovement = BankMovement();
                $bankMovement->fill($data);
                $bankMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $bankMovement->toArray()]);
            }
        }
        public function show($id) {
            $bankMovement = BankMovement()->find($id);
            if (empty($bankMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $bankMovement]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "bankMovementUpdate")) {
                $validator = \Validator::make($data, \Validation::bankMovementUpdate($id)["rule"], \Validation::bankMovementUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $bankMovement = BankMovement()->find($id);
                if (empty($bankMovement)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $bankMovement->fill($data);
                $bankMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $bankMovement->toArray()]);
            }
        }
        public function destroy($id) {
            $bankMovement = BankMovement()->find($id);
            if (empty($bankMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $bankMovement->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $bankMovement->toArray()]);
        }
    }
