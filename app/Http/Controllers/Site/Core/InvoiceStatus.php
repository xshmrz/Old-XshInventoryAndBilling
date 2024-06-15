<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class InvoiceStatus extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceStatusStore")) {
                $validator = \Validator::make($data, \Validation::invoiceStatusStore()["rule"], \Validation::invoiceStatusStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $invoiceStatus = InvoiceStatus();
                $invoiceStatus->fill($data);
                $invoiceStatus->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.invoice-status.edit", $invoiceStatus->id);
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
            if (method_exists(\Validation::class, "invoiceStatusUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceStatusUpdate($id)["rule"], \Validation::invoiceStatusUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $invoiceStatus = InvoiceStatus()->find($id);
                $invoiceStatus->fill($data);
                $invoiceStatus->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.invoice-status.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $invoiceStatus = InvoiceStatus()->find($id);
            $invoiceStatus->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.invoice-status.index")->withInput();
            }
        }
    }
