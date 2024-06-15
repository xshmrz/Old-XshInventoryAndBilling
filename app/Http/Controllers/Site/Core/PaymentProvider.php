<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class PaymentProvider extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "paymentProviderStore")) {
                $validator = \Validator::make($data, \Validation::paymentProviderStore()["rule"], \Validation::paymentProviderStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $paymentProvider = PaymentProvider();
                $paymentProvider->fill($data);
                $paymentProvider->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.payment-provider.edit", $paymentProvider->id);
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
            if (method_exists(\Validation::class, "paymentProviderUpdate")) {
                $validator = \Validator::make($data, \Validation::paymentProviderUpdate($id)["rule"], \Validation::paymentProviderUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $paymentProvider = PaymentProvider()->find($id);
                $paymentProvider->fill($data);
                $paymentProvider->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.payment-provider.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $paymentProvider = PaymentProvider()->find($id);
            $paymentProvider->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.payment-provider.index")->withInput();
            }
        }
    }
