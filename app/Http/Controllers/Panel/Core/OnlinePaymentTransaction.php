<?php
    namespace App\Http\Controllers\Panel\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class OnlinePaymentTransaction extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "onlinePaymentTransactionStore")) {
                $validator = \Validator::make($data, \Validation::onlinePaymentTransactionStore()["rule"], \Validation::onlinePaymentTransactionStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $onlinePaymentTransaction = OnlinePaymentTransaction();
                $onlinePaymentTransaction->fill($data);
                $onlinePaymentTransaction->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.online-payment-transaction.edit", $onlinePaymentTransaction->id);
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
            if (method_exists(\Validation::class, "onlinePaymentTransactionUpdate")) {
                $validator = \Validator::make($data, \Validation::onlinePaymentTransactionUpdate($id)["rule"], \Validation::onlinePaymentTransactionUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $onlinePaymentTransaction = OnlinePaymentTransaction()->find($id);
                $onlinePaymentTransaction->fill($data);
                $onlinePaymentTransaction->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.online-payment-transaction.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $onlinePaymentTransaction = OnlinePaymentTransaction()->find($id);
            $onlinePaymentTransaction->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("panel.online-payment-transaction.index")->withInput();
            }
        }
    }
