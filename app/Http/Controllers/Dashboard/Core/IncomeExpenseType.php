<?php
    namespace App\Http\Controllers\Dashboard\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class IncomeExpenseType extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "incomeExpenseTypeStore")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseTypeStore()["rule"], \Validation::incomeExpenseTypeStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $incomeExpenseType = IncomeExpenseType();
                $incomeExpenseType->fill($data);
                $incomeExpenseType->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.income-expense-type.edit", $incomeExpenseType->id);
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
            if (method_exists(\Validation::class, "incomeExpenseTypeUpdate")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseTypeUpdate($id)["rule"], \Validation::incomeExpenseTypeUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $incomeExpenseType = IncomeExpenseType()->find($id);
                $incomeExpenseType->fill($data);
                $incomeExpenseType->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("dashboard.income-expense-type.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $incomeExpenseType = IncomeExpenseType()->find($id);
            $incomeExpenseType->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("dashboard.income-expense-type.index")->withInput();
            }
        }
    }
