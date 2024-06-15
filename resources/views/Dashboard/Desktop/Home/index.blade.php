@extends("Dashboard.Desktop.layout")
@section("section-main")
	<main id="main-container">
		{{view("Dashboard.Desktop.Component.BaseBreadcrumb")}}
		<div class="content content-full">
			<div class="row">
				<div class="col-md-4">
					<div class="block block-rounded">
						<div class="block-header block-header-default min-height-55px">
							<h3 class="block-title">{{trans("app.Dashboard")}}</h3>
							<div class="block-options"></div>
						</div>
						<div class="block-content border-top p-3">
							{{Aire::open()}}
							<div class="row g-2">
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-6")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-6")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-3")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-3")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-3")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-3")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-6")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-6")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-6")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-6")}}
								{{Aire::input("name")->placeholder(trans("app.Name"))->groupClass("col-md-12")}}
							</div>
							{{Aire::close()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection

