<?php
    namespace App\Http\Controllers\Dashboard\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class StockWarehouse extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "stockWarehouseStore")) {
                $validator = \Validator::make($data, \Validation::stockWarehouseStore()["rule"], \Validation::stockWarehouseStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $stockWarehouse = StockWarehouse();
                $stockWarehouse->fill($data);
                $stockWarehouse->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.stock-warehouse.edit", $stockWarehouse->id);
                }
            }
        }
        public function show($id) {
            $this->data["id"] = $id;
            return getView()->with($this->data);
        }
        public function edit($id) {
            $this->data["id"] = $id;
            return getView()->with($this->data);
        }
        public function update(Request $request, $id) {
            $data = $request->all();
            if (method_exists(\Validation::class, "stockWarehouseUpdate")) {
                $validator = \Validator::make($data, \Validation::stockWarehouseUpdate($id)["rule"], \Validation::stockWarehouseUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $stockWarehouse = StockWarehouse()->find($id);
                $stockWarehouse->fill($data);
                $stockWarehouse->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.stock-warehouse.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $stockWarehouse = StockWarehouse()->find($id);
            $stockWarehouse->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("dashboard.stock-warehouse.index")->withInput();
            }
        }
    }
