<?php
    namespace App\Http\Controllers\Panel\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class Income extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "incomeStore")) {
                $validator = \Validator::make($data, \Validation::incomeStore()["rule"], \Validation::incomeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $income = Income();
                $income->fill($data);
                $income->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.income.edit", $income->id);
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
            if (method_exists(\Validation::class, "incomeUpdate")) {
                $validator = \Validator::make($data, \Validation::incomeUpdate($id)["rule"], \Validation::incomeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $income = Income()->find($id);
                $income->fill($data);
                $income->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.income.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $income = Income()->find($id);
            $income->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("panel.income.index")->withInput();
            }
        }
    }
