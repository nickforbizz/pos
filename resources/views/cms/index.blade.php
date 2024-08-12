@extends('layouts.cms')

@section('content')


<div class="panel-header bg-primary-gradient">
	<div class="page-inner py-5">
		<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
			<div>
				<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
				<h5 class="text-white op-7 mb-2">System view at a glance</h5>
			</div>
			<div class="ml-md-auto py-2 py-md-0">
				@can('create roles')
				<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage Roles</a>
				@endcan
				@can('create customers')
				<a href="{{ route('customers.create') }}" class="btn btn-secondary btn-round">Add Customer</a>
				@endcan
			</div>
		</div>
	</div>
</div>
<div class="page-inner mt--5">
	<div class="row mt--2">
		<div class="col-md-6">
			<div class="card full-height">
				<div class="card-body">
					<div class="card-title">Overall statistics</div>
					<div class="card-category">Daily information about statistics in system</div>
					<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
						<div class="px-2 pb-2 pb-md-0 text-center">
							<div id="circles-1"></div>
							<h6 class="fw-bold mt-3 mb-0">New Users</h6>
						</div>
						<div class="px-2 pb-2 pb-md-0 text-center">
							<div id="circles-2"></div>
							<h6 class="fw-bold mt-3 mb-0">Sales</h6>
						</div>
						<div class="px-2 pb-2 pb-md-0 text-center">
							<div id="circles-3"></div>
							<h6 class="fw-bold mt-3 mb-0">Subscribers</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card full-height">
				<div class="card-body">
					<div class="card-title">Total income & spend statistics</div>
					<div class="row py-3">
						<div class="col-md-4 d-flex flex-column justify-content-around">
							<div>
								<h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
								<h3 class="fw-bold">KSH 900782</h3>
							</div>
							<div>
								<h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
								<h3 class="fw-bold">KSH 198,248</h3>
							</div>
						</div>
						<div class="col-md-8">
							<div id="chart-container">
								<canvas id="totalIncomeChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-head-row">
						<div class="card-title">User Statistics</div>
						<div class="card-tools">
							<a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
								<span class="btn-label">
									<i class="fa fa-pencil"></i>
								</span>
								Export
							</a>
							<a href="#" class="btn btn-info btn-border btn-round btn-sm">
								<span class="btn-label">
									<i class="fa fa-print"></i>
								</span>
								Print
							</a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="chart-container" style="min-height: 375px">
						<canvas id="statisticsChart"></canvas>
					</div>
					<div id="myChartLegend"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-primary">
				<div class="card-header">
					<div class="card-title">Daily Sales</div>
					<div class="card-category">March 25 - April 02</div>
				</div>
				<div class="card-body pb-0">
					<div class="mb-4 mt-2">
						<h1>KSH 42,578.58</h1>
					</div>
					<div class="pull-in">
						<canvas id="dailySalesChart"></canvas>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body pb-0">
					<div class="h1 fw-bold float-right text-warning">+7%</div>
					<h2 class="mb-2">213</h2>
					<p class="text-muted">Transactions</p>
					<div class="pull-in sparkline-fix">
						<div id="lineChart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Top Products</div>
				</div>
				<div class="card-body pb-0">
					<div class="d-flex">
						<div class="avatar">
							<img src="../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="flex-1 pt-1 ml-2">
							<h6 class="fw-bold mb-1">Wheel</h6>
							<small class="text-muted">Alloy Rims</small>
						</div>
						<div class="d-flex ml-auto align-items-center">
							<h3 class="text-info fw-bold">+KSH 1700</h3>
						</div>
					</div>
					<div class="separator-dashed"></div>
					<div class="d-flex">
						<div class="avatar">
							<img src="../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="flex-1 pt-1 ml-2">
							<h6 class="fw-bold mb-1">Engines</h6>
							<small class="text-muted">Honda Civic </small>
						</div>
						<div class="d-flex ml-auto align-items-center">
							<h3 class="text-info fw-bold">+KSH 3000</h3>
						</div>
					</div>
					<div class="separator-dashed"></div>
					<div class="d-flex">
						<div class="avatar">
							<img src="../assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="flex-1 pt-1 ml-2">
							<h6 class="fw-bold mb-1">Lights</h6>
							<small class="text-muted"> Fog lights</small>
						</div>
						<div class="d-flex ml-auto align-items-center">
							<h3 class="text-info fw-bold">+KSH 3250</h3>
						</div>
					</div>
					<div class="separator-dashed"></div>
					<div class="pull-in">
						<canvas id="topProductsChart"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="card-title fw-mediumbold">Suggested People</div>
					<div class="card-list">
						<div class="item-list">
							<div class="avatar">
								<img src="../assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="info-user ml-3">
								<div class="username">Jimmy Denis</div>
								<div class="status">Graphic Designer</div>
							</div>
							<button class="btn btn-icon btn-primary btn-round btn-xs">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="item-list">
							<div class="avatar">
								<img src="../assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="info-user ml-3">
								<div class="username">Chad</div>
								<div class="status">CEO Zeleaf</div>
							</div>
							<button class="btn btn-icon btn-primary btn-round btn-xs">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="item-list">
							<div class="avatar">
								<img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="info-user ml-3">
								<div class="username">Talha</div>
								<div class="status">Front End Designer</div>
							</div>
							<button class="btn btn-icon btn-primary btn-round btn-xs">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="item-list">
							<div class="avatar">
								<img src="../assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="info-user ml-3">
								<div class="username">John Doe</div>
								<div class="status">Back End Developer</div>
							</div>
							<button class="btn btn-icon btn-primary btn-round btn-xs">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="item-list">
							<div class="avatar">
								<img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="info-user ml-3">
								<div class="username">Talha</div>
								<div class="status">Front End Designer</div>
							</div>
							<button class="btn btn-icon btn-primary btn-round btn-xs">
								<i class="fa fa-plus"></i>
							</button>
						</div>
						<div class="item-list">
							<div class="avatar">
								<img src="../assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
							</div>
							<div class="info-user ml-3">
								<div class="username">Jimmy Denis</div>
								<div class="status">Graphic Designer</div>
							</div>
							<button class="btn btn-icon btn-primary btn-round btn-xs">
								<i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card card-primary bg-primary-gradient">
				<div class="card-body">
					<h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
					<h1 class="mb-4 fw-bold">17</h1>
					<h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
					<div id="activeUsersChart"></div>
					<h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
					<ul class="list-unstyled">
						<li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small> <span>7</span></li>
						<li class="d-flex justify-content-between pb-1 pt-1"><small>/product/atlantis/demo.html</small> <span>10</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card full-height">
				<div class="card-header">
					<div class="card-title">Feedback Activity</div>
				</div>
				<div class="card-body">
					<ol class="activity-feed">
						<li class="feed-item feed-item-secondary">
							<time class="date" datetime="9-25">Sep 25</time>
							<span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
						</li>
						<li class="feed-item feed-item-success">
							<time class="date" datetime="9-24">Sep 24</time>
							<span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
						</li>
						<li class="feed-item feed-item-info">
							<time class="date" datetime="9-23">Sep 23</time>
							<span class="text">Joined the group <a href="single-group.php">"Boardsmanship Forum"</a></span>
						</li>
						<li class="feed-item feed-item-warning">
							<time class="date" datetime="9-21">Sep 21</time>
							<span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
						</li>
						<li class="feed-item feed-item-danger">
							<time class="date" datetime="9-18">Sep 18</time>
							<span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
						</li>
						<li class="feed-item">
							<time class="date" datetime="9-17">Sep 17</time>
							<span class="text">Attending the event <a href="single-event.php">"Some New Event"</a></span>
						</li>
					</ol>
				</div>
			</div>
		</div>
	
	</div>
</div>

@endsection

@push('scripts')
<script>
	Circles.create({
		id: 'circles-1',
		radius: 45,
		value: 60,
		maxValue: 100,
		width: 7,
		text: 5,
		colors: ['#f1f1f1', '#FF9E27'],
		duration: 400,
		wrpClass: 'circles-wrp',
		textClass: 'circles-text',
		styleWrapper: true,
		styleText: true
	})

	Circles.create({
		id: 'circles-2',
		radius: 45,
		value: 70,
		maxValue: 100,
		width: 7,
		text: 36,
		colors: ['#f1f1f1', '#2BB930'],
		duration: 400,
		wrpClass: 'circles-wrp',
		textClass: 'circles-text',
		styleWrapper: true,
		styleText: true
	})

	Circles.create({
		id: 'circles-3',
		radius: 45,
		value: 40,
		maxValue: 100,
		width: 7,
		text: 12,
		colors: ['#f1f1f1', '#F25961'],
		duration: 400,
		wrpClass: 'circles-wrp',
		textClass: 'circles-text',
		styleWrapper: true,
		styleText: true
	})

	var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

	var mytotalIncomeChart = new Chart(totalIncomeChart, {
		type: 'bar',
		data: {
			labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
			datasets: [{
				label: "Total Income",
				backgroundColor: '#ff9e27',
				borderColor: 'rgb(23, 125, 255)',
				data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
			}],
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			legend: {
				display: false,
			},
			scales: {
				yAxes: [{
					ticks: {
						display: false //this will remove only the label
					},
					gridLines: {
						drawBorder: false,
						display: false
					}
				}],
				xAxes: [{
					gridLines: {
						drawBorder: false,
						display: false
					}
				}]
			},
		}
	});

	$('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
		type: 'line',
		height: '70',
		width: '100%',
		lineWidth: '2',
		lineColor: '#ffa534',
		fillColor: 'rgba(255, 165, 52, .14)'
	});
</script>
@endpush