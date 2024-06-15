<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class InvoiceType extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceTypeStore")) {
                $validator = \Validator::make($data, \Validation::invoiceTypeStore()["rule"], \Validation::invoiceTypeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $invoiceType = InvoiceType();
                $invoiceType->fill($data);
                $invoiceType->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.invoice-type.edit", $invoiceType->id);
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
            if (method_exists(\Validation::class, "invoiceTypeUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceTypeUpdate($id)["rule"], \Validation::invoiceTypeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $invoiceType = InvoiceType()->find($id);
                $invoiceType->fill($data);
                $invoiceType->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.invoice-type.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $invoiceType = InvoiceType()->find($id);
            $invoiceType->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.invoice-type.index")->withInput();
            }
        }
    }
