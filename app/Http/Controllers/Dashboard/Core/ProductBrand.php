<?php
    namespace App\Http\Controllers\Dashboard\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class ProductBrand extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "productBrandStore")) {
                $validator = \Validator::make($data, \Validation::productBrandStore()["rule"], \Validation::productBrandStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $productBrand = ProductBrand();
                $productBrand->fill($data);
                $productBrand->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.product-brand.edit", $productBrand->id);
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
            if (method_exists(\Validation::class, "productBrandUpdate")) {
                $validator = \Validator::make($data, \Validation::productBrandUpdate($id)["rule"], \Validation::productBrandUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $productBrand = ProductBrand()->find($id);
                $productBrand->fill($data);
                $productBrand->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.product-brand.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $productBrand = ProductBrand()->find($id);
            $productBrand->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("dashboard.product-brand.index")->withInput();
            }
        }
    }
