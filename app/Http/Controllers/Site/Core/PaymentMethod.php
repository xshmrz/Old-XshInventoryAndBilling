<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class PaymentMethod extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentMethodStore")) {
                $validator = \Validator::make($data, \Validation::paymentMethodStore()["rule"], \Validation::paymentMethodStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $paymentMethod = PaymentMethod();
                $paymentMethod->fill($data);
                $paymentMethod->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.payment-method.edit", $paymentMethod->id);
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
            if (method_exists(\Validation::class, "paymentMethodUpdate")) {
                $validator = \Validator::make($data, \Validation::paymentMethodUpdate($id)["rule"], \Validation::paymentMethodUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $paymentMethod = PaymentMethod()->find($id);
                $paymentMethod->fill($data);
                $paymentMethod->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.payment-method.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $paymentMethod = PaymentMethod()->find($id);
            $paymentMethod->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.payment-method.index")->withInput();
            }
        }
    }
