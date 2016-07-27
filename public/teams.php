<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
	// Write the query to retrieve the details of all of the teams
	$sql = 'SELECT * FROM teams;';
	// Copy the query and test it in SQL Pro
	if (Input::has('team_or_stadium')) {
		$teamOrStadium = Input::get('team_or_stadium');
		$sql .= " WHERE name LIKE '%$teamOrStadium%' OR stadium LIKE '%$teamOrStadium%';";
	}
	var_dump($sql);

	return [
		'title' => 'Teams',
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
	<form class="form-inline" method="get">
		<div class="form-group">
			<input
				type="text"
				class="form-control"
				id="team"
				name="team_or_stadium"
				placeholder="Team or Stadium">
		</div>
		<button type="submit" class="btn btn-default">
			<span class="glyphicon glyphicon-search" aria-hidden="true">
			</span>
			Search
		</button>
	</form>
	<div class="row">
		<header class="page-header">
			<h1>Teams</h1>
		</header>
		<form method="post" action="delete-teams.php">
			<table class="table table-striped table-hover table-bordered">
				<thead>
				<tr>
					<th>Delete</th>
					<th>Team</th>
					<th>League</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						<!-- If you use brackets at the end of a name the values are sent as array elements -->
						<input type="checkbox" name="teams[]" value="1">
					</td>
					<td>
						<a href="team-details.php?team_id=1">
							Red Sox
						</a>
					</td>
					<td>American</td>
				</tr>
				<tr>
					<td>
						<!-- You will be able to delete more than one team -->
						<input type="checkbox" name="teams[]" value="2">
					</td>
					<td>
						<a href="team-details.php?team_id=2">
							Texas Rangers
						</a>
					</td>
					<td>American</td>
				</tr>
				</tbody>
			</table>
			<input type="submit" value="Delete" class="btn btn-danger">
		</form>
	</div>
</div>
<?php include '../partials/scripts.phtml' ?>
</body>
</html>