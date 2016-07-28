<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
	$name = '';
	$stadium = '';
	$checkedA = '';
	$checkedN = '';
	if (Input::isPost()) {
		$name = Input::get('name');
		$league = Input::get('league');
		$stadium = Input::get('stadium');
		// Write the INSERT statement to insert a team
		// Either interpolate or concatenate the PHP variables
		$insert = "INSERT INTO teams (name, league, stadium) VALUES('$name', '$league', '$stadium');";
		// Copy the resulting query and verify that it runs using the terminal
		$league == 'american' ? $checkedA = 'checked' : $checkedN = 'checked';
		var_dump($insert);
	}
	return [
		'title' => 'New Team',
		'name' => $name,
		'stadium' => $stadium,
		'checkedA' => $checkedA,
		'checkedN' => $checkedN
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
	<div class="Row">
		<div class="page-header"><h1>New Team</h1></div>
		<form method="post" class="form-horizontal">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">
					Name
				</label>
				<div class="col-sm-10">
					<input
						type="text"
						class="form-control"
						name="name"
						value="<?= $name; ?>"
						id="name"
						placeholder="Texas Rangers"
					>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">
					League
				</label>
				<div class="col-sm-10">
					<div class="radio">
						<label>
							<input type="radio" name="league" value="american" <?= $checkedA; ?>>
							American
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="league" value="national" <?= $checkedN; ?>>
							National
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="stadium" class="col-sm-2 control-label">
					Stadium
				</label>
				<div class="col-sm-10">
					<input
						type="text"
						class="form-control"
						name="stadium"
						value="<?= $stadium; ?>"
						id="stadium"
						placeholder="Globe Life Park"
					>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
						</span>
						Save
					</button>
				</div>
			</div>
<!-- 			<?php include '../partials/team-form.phtml' ?>
 -->		</form>
	</div>
</div>
<?php include '../partials/scripts.phtml' ?>
</body>
</html>