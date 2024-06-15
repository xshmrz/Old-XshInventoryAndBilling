<?php
    namespace App\Http\Controllers\Panel\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class InvoiceDetail extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceDetailStore")) {
                $validator = \Validator::make($data, \Validation::invoiceDetailStore()["rule"], \Validation::invoiceDetailStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $invoiceDetail = InvoiceDetail();
                $invoiceDetail->fill($data);
                $invoiceDetail->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.invoice-detail.edit", $invoiceDetail->id);
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
            if (method_exists(\Validation::class, "invoiceDetailUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceDetailUpdate($id)["rule"], \Validation::invoiceDetailUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $invoiceDetail = InvoiceDetail()->find($id);
                $invoiceDetail->fill($data);
                $invoiceDetail->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.invoice-detail.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $invoiceDetail = InvoiceDetail()->find($id);
            $invoiceDetail->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("panel.invoice-detail.index")->withInput();
            }
        }
    }
