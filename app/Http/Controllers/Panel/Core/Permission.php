<?php
    namespace App\Http\Controllers\Panel\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class Permission extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "permissionStore")) {
                $validator = \Validator::make($data, \Validation::permissionStore()["rule"], \Validation::permissionStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $permission = Permission();
                $permission->fill($data);
                $permission->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.permission.edit", $permission->id);
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
            if (method_exists(\Validation::class, "permissionUpdate")) {
                $validator = \Validator::make($data, \Validation::permissionUpdate($id)["rule"], \Validation::permissionUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $permission = Permission()->find($id);
                $permission->fill($data);
                $permission->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.permission.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $permission = Permission()->find($id);
            $permission->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("panel.permission.index")->withInput();
            }
        }
    }
