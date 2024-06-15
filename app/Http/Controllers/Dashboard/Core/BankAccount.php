<?php
    namespace App\Http\Controllers\Dashboard\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class BankAccount extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "bankAccountStore")) {
                $validator = \Validator::make($data, \Validation::bankAccountStore()["rule"], \Validation::bankAccountStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $bankAccount = BankAccount();
                $bankAccount->fill($data);
                $bankAccount->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.bank-account.edit", $bankAccount->id);
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
            if (method_exists(\Validation::class, "bankAccountUpdate")) {
                $validator = \Validator::make($data, \Validation::bankAccountUpdate($id)["rule"], \Validation::bankAccountUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $bankAccount = BankAccount()->find($id);
                $bankAccount->fill($data);
                $bankAccount->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.bank-account.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $bankAccount = BankAccount()->find($id);
            $bankAccount->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("dashboard.bank-account.index")->withInput();
            }
        }
    }
