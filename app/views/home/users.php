<table>
	<thead>
		<th>UUID</th>
		<th>E-mail</th>
		<th>Name</th>
	</thead>

	<tbody>
		<?php

		if( is_array( $data['users'] ) ) {
			foreach ($data['users'] as $userKey => $user) {
				echo "<tr><td>{$user['UUID']}</td><td>{$user['email']}</td><td>{$user['name']}</td></tr>";
			}
		}

		?>
	</tbody>
</table>