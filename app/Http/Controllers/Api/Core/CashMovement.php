<?php
    namespace App\Http\Controllers\Api\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Bjerke\ApiQueryBuilder\QueryBuilder as QueryBuilder;
    class CashMovement extends Controller {
        public function index() {
            $model          = CashMovement();
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
            if (method_exists(\Validation::class, "cashMovementStore")) {
                $validator = \Validator::make($data, \Validation::cashMovementStore()["rule"], \Validation::cashMovementStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $cashMovement = CashMovement();
                $cashMovement->fill($data);
                $cashMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $cashMovement->toArray()]);
            }
        }
        public function show($id) {
            $cashMovement = CashMovement()->find($id);
            if (empty($cashMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            return responseOk(["message" => trans("app.Successful"), "data" => $cashMovement]);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "cashMovementUpdate")) {
                $validator = \Validator::make($data, \Validation::cashMovementUpdate($id)["rule"], \Validation::cashMovementUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                return responseUnprocessableEntity(["message" => $validator->errors()->first()]);
            }
            else {
                $cashMovement = CashMovement()->find($id);
                if (empty($cashMovement)) {
                    return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
                }
                $cashMovement->fill($data);
                $cashMovement->save();
                return responseOk(["message" => trans("app.Successful"), "data" => $cashMovement->toArray()]);
            }
        }
        public function destroy($id) {
            $cashMovement = CashMovement()->find($id);
            if (empty($cashMovement)) {
                return responseNotFound(["message" => trans("app.Not Found"), "data" => []]);
            }
            $cashMovement->delete();
            return responseOk(["message" => trans("app.Successful"), "data" => $cashMovement->toArray()]);
        }
    }
