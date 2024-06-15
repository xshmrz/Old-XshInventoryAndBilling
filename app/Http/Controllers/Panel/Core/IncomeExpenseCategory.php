<?php
    namespace App\Http\Controllers\Panel\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class IncomeExpenseCategory extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "incomeExpenseCategoryStore")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseCategoryStore()["rule"], \Validation::incomeExpenseCategoryStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $incomeExpenseCategory = IncomeExpenseCategory();
                $incomeExpenseCategory->fill($data);
                $incomeExpenseCategory->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.income-expense-category.edit", $incomeExpenseCategory->id);
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
            if (method_exists(\Validation::class, "incomeExpenseCategoryUpdate")) {
                $validator = \Validator::make($data, \Validation::incomeExpenseCategoryUpdate($id)["rule"], \Validation::incomeExpenseCategoryUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $incomeExpenseCategory = IncomeExpenseCategory()->find($id);
                $incomeExpenseCategory->fill($data);
                $incomeExpenseCategory->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.income-expense-category.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $incomeExpenseCategory = IncomeExpenseCategory()->find($id);
            $incomeExpenseCategory->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("panel.income-expense-category.index")->withInput();
            }
        }
    }
