<?
session_start();
include("./includes/functions.php");
get_slug();
redirect_if();
db_connect();

if ($slug == "/") {
	$include_path = "home.php";
} elseif ($slug == "/admin") {
	$include_path = "admin.php";
} elseif ($slug == "/admin-redirect") {
	$include_path = "admin-redirect.php";
} else {
	$find_all_tracks = db_query("SELECT * FROM tracks");
	while ($track = mysqli_fetch_assoc($find_all_tracks)) {
		$artist_slug = encode_for_slug($track["artist"]);
		$title_slug = encode_for_slug($track["title"]);
		$catalog_id_slug = encode_for_slug($track["catalog_id"]);
		redirect_from_to("/$artist_slug-$title_slug", "/$artist_slug/$title_slug");
		redirect_from_to("/$catalog_id_slug", "/$artist_slug/$title_slug");
		if ($slug == "/$artist_slug/$title_slug") {
			// Yes, this is a track page
			$is_track_page = true;
			$include_path = "track.php";

			$artist = $track["artist"];
			$title = $track["title"];
			$cover_art_filename = $track["cover_art_filename"];
			$catalog_id = $track["catalog_id"];
			$soundcloud_link = $track["soundcloud_link"];
			$youtube_link = $track["youtube_link"];
			$spotify_link = $track["spotify_link"];
		}
	}
	if (!isset($is_track_page)) {
		$include_path = "404.php";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="/css/global.css">
	</head>
	<body>
		<? include("$include_path"); ?>
	</body>
</html>

<? db_disconnect(); ?>
