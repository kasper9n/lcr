<?

post_to_sql_string("track_id");
post_to_sql_string("catalog_id");
post_to_sql_string("artist");
post_to_sql_string("title");
post_to_sql_string("cover_art_filename");
post_to_sql_string("soundcloud_link");
post_to_sql_string("youtube_link");
post_to_sql_string("spotify_link");

// Add tracks
if (isset($_POST["submit_tracks_add"])) {

	// UPLOAD COVER
	$target_dir = "img/covers/";
	$target_file = $target_dir . basename($_FILES["cover_upload"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["cover_upload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"];
    } else {
        die("File is not an image.");
    }
	validate_upload_image($target_file);

	if (move_uploaded_file($_FILES["cover_upload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["cover_upload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

	// Add stuff to db
	$query = "	INSERT INTO tracks (catalog_id, artist, title, cover_art_filename, soundcloud_link, youtube_link, spotify_link)
				VALUES ('{$catalog_id}', '{$artist}', '{$title}', '{$cover_art_filename}', '{$soundcloud_link}', '{$youtube_link}', '{$spotify_link}')";
	$result = mysqli_query($db_connection, $query);
	// Test for query error
	if ($result) {
		// Success
		echo "Successful database query!";
	} else {
		// Failure
		die("Datatabse query failed. " . mysqli_error($db_connection));
	}
}

// Edit tracks
if (isset($_POST["submit_tracks_edit"])) {
	$query = " UPDATE tracks SET catalog_id = '{$catalog_id}', artist = '{$artist}', title = '{$title}', cover_art_filename = '{$cover_art_filename}', soundcloud_link = '{$soundcloud_link}', youtube_link = '{$youtube_link}', spotify_link = '{$spotify_link}' WHERE track_id = {$track_id} ";
	$result = mysqli_query($db_connection, $query);
	// Test for query error
	if ($result && mysqli_affected_rows($db_connection) == 1) {
		// Success
		echo "Success!";
	} else {
		// Failure
		die("Datatabse query failed. Possibly you change antyhing before clicking edit" . mysqli_error($db_connection));
	}
}

// Delete tracks
if (isset($_POST["submit_tracks_delete"])) {
	$query = "DELETE FROM tracks WHERE track_id = {$track_id} LIMIT 1";
	$result = mysqli_query($db_connection, $query);
	// Test for query error
	if ($result && mysqli_affected_rows($db_connection) == 1) {
		// Success
		echo "Success!";
	} else {
		// Failure
		die("Datatabse query failed. " . mysqli_error($db_connection));
	}
}

die();

$newURL = "admin";
header('Location: '.$newURL);

?>
