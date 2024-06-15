<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class InvoicePaymentMethod extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoicePaymentMethodStore")) {
                $validator = \Validator::make($data, \Validation::invoicePaymentMethodStore()["rule"], \Validation::invoicePaymentMethodStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $invoicePaymentMethod = InvoicePaymentMethod();
                $invoicePaymentMethod->fill($data);
                $invoicePaymentMethod->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.invoice-payment-method.edit", $invoicePaymentMethod->id);
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
            if (method_exists(\Validation::class, "invoicePaymentMethodUpdate")) {
                $validator = \Validator::make($data, \Validation::invoicePaymentMethodUpdate($id)["rule"], \Validation::invoicePaymentMethodUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $invoicePaymentMethod = InvoicePaymentMethod()->find($id);
                $invoicePaymentMethod->fill($data);
                $invoicePaymentMethod->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.invoice-payment-method.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $invoicePaymentMethod = InvoicePaymentMethod()->find($id);
            $invoicePaymentMethod->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.invoice-payment-method.index")->withInput();
            }
        }
    }
