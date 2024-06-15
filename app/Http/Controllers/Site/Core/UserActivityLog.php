<?php
    namespace App\Http\Controllers\Site\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class UserActivityLog extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "userActivityLogStore")) {
                $validator = \Validator::make($data, \Validation::userActivityLogStore()["rule"], \Validation::userActivityLogStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $userActivityLog = UserActivityLog();
                $userActivityLog->fill($data);
                $userActivityLog->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.user-activity-log.edit", $userActivityLog->id);
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
            if (method_exists(\Validation::class, "userActivityLogUpdate")) {
                $validator = \Validator::make($data, \Validation::userActivityLogUpdate($id)["rule"], \Validation::userActivityLogUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $userActivityLog = UserActivityLog()->find($id);
                $userActivityLog->fill($data);
                $userActivityLog->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("site.user-activity-log.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $userActivityLog = UserActivityLog()->find($id);
            $userActivityLog->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("site.user-activity-log.index")->withInput();
            }
        }
    }
