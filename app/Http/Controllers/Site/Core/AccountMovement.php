<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class AccountMovement extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "accountMovementStore")) {
                $validator = \Validator::make($data, \Validation::accountMovementStore()["rule"], \Validation::accountMovementStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $accountMovement = AccountMovement();
                $accountMovement->fill($data);
                $accountMovement->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.account-movement.edit", $accountMovement->id);
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
            if (method_exists(\Validation::class, "accountMovementUpdate")) {
                $validator = \Validator::make($data, \Validation::accountMovementUpdate($id)["rule"], \Validation::accountMovementUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $accountMovement = AccountMovement()->find($id);
                $accountMovement->fill($data);
                $accountMovement->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.account-movement.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $accountMovement = AccountMovement()->find($id);
            $accountMovement->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.account-movement.index")->withInput();
            }
        }
    }
