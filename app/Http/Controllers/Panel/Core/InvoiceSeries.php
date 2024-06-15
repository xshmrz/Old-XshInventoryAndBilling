<?php
    namespace App\Http\Controllers\Panel\Core;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    class InvoiceSeries extends Controller {
        public function index() {
            return getView()->with($this->data);
        }
        public function create() {
            return getView()->with($this->data);
        }
        public function store(Request $request) {
            $data = $request->all();
            if (method_exists(\Validation::class, "invoiceSeriesStore")) {
                $validator = \Validator::make($data, \Validation::invoiceSeriesStore()["rule"], \Validation::invoiceSeriesStore()["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
                session()->flash('validation', \Str::title($validator->errors()->first()));
                return redirect()->back()->withInput();
            }
            else {
                $invoiceSeries = InvoiceSeries();
                $invoiceSeries->fill($data);
                $invoiceSeries->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.invoice-series.edit", $invoiceSeries->id);
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
            if (method_exists(\Validation::class, "invoiceSeriesUpdate")) {
                $validator = \Validator::make($data, \Validation::invoiceSeriesUpdate($id)["rule"], \Validation::invoiceSeriesUpdate($id)["message"]);
            }
            else {
                $validator = \Validator::make($data, []);
            }
            if ($validator->fails()) {
               session()->flash('validation', \Str::title($validator->errors()->first()));
               return redirect()->back()->withInput();
            }
            else {
                $invoiceSeries = InvoiceSeries()->find($id);
                $invoiceSeries->fill($data);
                $invoiceSeries->save();
                session()->flash('success', trans("app.Successful"));
                if ($request->has("redirect")) {
                    return redirect()->to($request->get("redirect"));
                }
                else {
                    return redirect()->route("panel.invoice-series.edit", $id);
                }
            }
        }
        public function destroy($id) {
            $invoiceSeries = InvoiceSeries()->find($id);
            $invoiceSeries->delete();
            session()->flash('success', trans("app.Successful"));
            if (\request()->has("redirect")) {
                return redirect()->to(\request()->get("redirect"))->withInput();
            }
            else {
                return redirect()->route("panel.invoice-series.index")->withInput();
            }
        }
    }
