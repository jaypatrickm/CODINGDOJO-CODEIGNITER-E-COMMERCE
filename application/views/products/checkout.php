<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart</title>
	<script type="text/javascript" src="/assets/js/jquery-2.1.3.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h2>Check Out</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover table-bordered">
					<tr>
						<th>Qty</th>
						<th>Description</th>
						<th>Price</th>
						<th></th>
					</tr>
					<tbody>
						<?php foreach ($cart as $row){ ?>
						<tr>
							<form action="/products/delete/<?= $row['id'] ?>" method="post">
							<td><?= $row['qty'] ?></td>
							<td><?= $row['description'] ?></td>
							<td><?= $row['price_qty'] ?></td>
							<td>
								<button class="btn btn-danger">Delete</button>
							</td>
							</form>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-lg-offset-6">
				<table class="table">
					<tr>
						<th style="text-align: right;">Total</th>
						<?php
					
						//calculate_total
						$total = 0;
						foreach ($cart as $value) {
							$total = $total + floatval($value['price_qty']);
						}
						$final_total = number_format($total,2);

						?>
						<th style="text-align: right;">$<?php echo $final_total; ?></th>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<h2>Billing Info</h2>
				<?php echo "<h3>" . validation_errors() . "</h3>"; ?>
				<form class="form" action="/products/checkout" method="post">
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Address">
					</div>
					<div class="form-group">
						<label for="card">Card #</label>
						<input type="text" class="form-control" id="card" name="card" placeholder="Enter Card">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
		<div class="row" style="margin:10px 0 0 0">
			<div class="col-lg-12">
				<a href="/products"class="btn btn-link">Back to products</a>
			</div>
		</div>
	</div>
</body>
</html>