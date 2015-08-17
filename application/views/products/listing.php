<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Products Listing</title>
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
				<h2>Products</h2>
				<?php if($this->session->flashdata('added_to_cart')) { echo "<h3>" . $this->session->flashdata('added_to_cart') . "</h3>";} ?>
			</div>
			<div class="col-lg-4 col-lg-offset-4 cart">
				<form action="products/cart" method="post">
					<button type="submit" href="#" class="btn btn-link">
						<?php if($this->session->userdata('cart')) 
						{ 
							$cart_items = $this->session->userdata('cart');
							$total_cart_items = 0;
							foreach ($cart_items as $value) {
								$total_cart_items = $total_cart_items + $value['qty'];
							}
							if($total_cart_items > 1)
							{
								echo "Your Cart ( " . $total_cart_items . " items )";
							}
							else 
							{ 
								echo "Your Cart ( " . $total_cart_items . " item )";
							}
						} 
						else 
						{ 
							echo "Your cart ( 0 items )";
						} 
						?></button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover table-bordered">
					<tr>
						<th>Description</th>
						<th>Price</th>
						<th>Qty</th>
						<th></th>
					</tr>
					<tbody>
						<?php 
							foreach($products as $row) 
							{
						?>
						<tr>
							<form action="products/add_to_cart/<?= $row['id'] ?>" method="post">
							<td><input type='hidden' name="description" value="<?= $row['description'] ?>"><?= $row['description'] ?></td>
							<td><input type='hidden' name="price" value="<?= $row['price'] ?>"><?= $row['price'] ?></td>
							<td>
								<select  name="qty" class="form-control">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
								</select>
							</td>
							<td>
								<button type="submit" class="btn btn-success">Buy</button>
							</td>
							</form>
						</tr>
						<?php 
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<form action="products/destroy" method="post">
					<button type="submit" class="btn btn-danger">Destroy Session</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>