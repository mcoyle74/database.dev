<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
	// Write the query to retrieve the details of all of the teams
	$sql = 'SELECT * FROM teams';
	// Copy the query and test it in SQL Pro
	if (Input::has('team_or_stadium')) {
		$teamOrStadium = Input::get('team_or_stadium');
		$sql .= " WHERE name LIKE '%$teamOrStadium%' OR stadium LIKE '%$teamOrStadium%'";
	}
	if (Input::has('sort_by')) {
		$sortBy = Input::get('sort_by');
		$sql .= " ORDER BY $sortBy";
	}
	if (Input::has('page')) {
		$page = Input::get('page') < 1 ? 1 : Input::get('page');
		$offset = ($page - 1) * 5;
		$sql .= " LIMIT 5 OFFSET $offset";
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
					<th>
						<a href="?sort_by=team">Team</a>
					</th>
					<th>
						<a href="?sort_by=stadium">Stadium</a>
					</th>
					<th>
						<a href="?sort_by=league">League</a>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<input type="checkbox" name="teams[]" value="1">
					</td>
					<td>
						<a href="team-details.php?team_id=1">
							Red Sox
						</a>
					</td>
					<td>Fenway Park</td>
					<td>American</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="teams[]" value="2">
					</td>
					<td>
						<a href="team-details.php?team_id=2">
							Texas Rangers
						</a>
					</td>
					<td>Global Life Park</td>
					<td>American</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<!-- The values in this pagination control indicate you're currently viewing page 2 -->
						<nav aria-label="Page navigation" class="text-center">
							<ul class="pagination">
								<li>
									<a href="?page=1" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<li><a href="?page=1">1</a></li>
								<li><a href="?page=2">2</a></li>
								<li><a href="?page=3">3</a></li>
								<li><a href="?page=4">4</a></li>
								<li><a href="?page=5">5</a></li>
								<li>
									<a href="?page=3" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
							</ul>
						</nav>
					</td>
				</tr>
			</tfoot>
			</table>
			<input type="submit" value="Delete" class="btn btn-danger">
		</form>
	</div>
</div>
<?php include '../partials/scripts.phtml' ?>
</body>
</html>