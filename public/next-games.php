<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
	// Write the SELECT to retrieve all upcoming games
	$sql = 'SELECT * FROM games g JOIN teams ht ON g.local_team_id = ht.id JOIN teams vt ON g.visitor_team_id = vt.id WHERE (g.game_date > CURDATE())';
	if (Input::has('league')) {
		// Concatenate the WHERE part to retrieve only the games for either the
		// National league or the American league
		$league = Input::get('league');
		$sql .= " AND (league = '$league')";
	}
	if (Input::has('team')) {
		// Concatenate the WHERE part to retrieve only the games for teams with
		// a name similar to the one provided by the user.
		$team = Input::get('team');
		$sql .= " AND (ht.name LIKE '%$team%' OR vt.name LIKE '%$team%')";
	}

	// Copy the generated query and verify that it retrieves the correct values
	// in SQL Pro
	var_dump($sql);

	return [
		'title' => 'Next games'
	];
}
extract(pageController());
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include '../partials/head.phtml' ?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<header class="page-header">
						<h1>Next games</h1>
					</header>
				</div>
				<div class="col-md-4" style="padding-top: 3.5em">
					<form class="form-inline" method="get">
						<div class="form-group">
							<input
								type="text"
								class="form-control"
								id="team"
								name="team"
								placeholder="Rangers">
						</div>
						<button type="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-search" aria-hidden="true">
						</span>
							Search
						</button>
					</form>
				</div>
			</div>
			<div class="row">
				<ul class="nav nav-tabs">
					<li role="presentation" class="active">
						<a href="?league=all">All</a>
					</li>
					<li role="presentation">
						<a href="?league=national">National</a>
					</li>
					<li role="presentation">
						<a href="?league=american">American</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-6" style="padding-top: 1em">
					<div class="col-md-6">
						<p class="lead text-right"><a href="#">Red Sox</a></p>
					</div>
					<div class="col-md-6">
						<p class="lead"><a href="#">Orioles</a></p>
					</div>
					<img
						src="http://placehold.it/150x150"
						class="img-responsive center-block"
					>
					<p class="text-center">
						Fenway Park, July 25, 2016.
					</p>
					<p class="lead text-center">8pm</p>
				</div>
			</div>
		</div>
		<?php include '../partials/scripts.phtml' ?>
	</body>
</html>