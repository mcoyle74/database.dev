<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
	$sql = '';
	// Write the SELECT to retrieve the following statistics
	// - Number of Games won
	$sql = "SELECT COUNT(*)
	         FROM games
	         WHERE (local_team_id = 28 AND local_team_runs > visitor_team_runs) OR (visitor_team_id = 28 AND visitor_team_runs > local_team_runs)";
	// - Number of Games lost
	$sql = "SELECT COUNT(*)
	         FROM games
	         WHERE (local_team_id = 28 AND local_team_runs < visitor_team_runs) OR (visitor_team_id = 28 AND visitor_team_runs < local_team_runs)";
	// - Number of Games won as local
	$sql = "SELECT COUNT(*)
            FROM games g
              JOIN teams t ON t.id = g.local_team_id
            WHERE t.id = 28 AND g.local_team_runs > g.visitor_team_runs";
	// - Number of Games won as visitor
	$sql = "SELECT COUNT(*)
            FROM games g
              JOIN teams t ON t.id = g.visitor_team_id
            WHERE t.id = 28 AND g.visitor_team_runs > g.local_team_runs";
	// Use joins or sub-queries as needed...

	// Copy the generated query and verify that it retrieves the correct values
	// in SQL Pro
	var_dump($sql);

	return [
		'title' => 'Statistics Texas Rangers',
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
		<header class="page-header">
			<h1>Statistics</h1>
		</header>
	</div>
	<div class="row">
		<canvas id="stats-chart" width="400" height="400"></canvas>
	</div>
</div>
<?php include '../partials/scripts.phtml' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.0/Chart.bundle.min.js">
</script>
<script>
	var ctx = $('#stats-chart');
	new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Won", "Lost", "Won as local", "Won as visitor"],
			datasets: [{
				label: 'Games',
				// These should be the values from our PHP query
				data: [12, 19, 3, 5],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
</script>
</body>
</html>