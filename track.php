<title><?="$artist - $title"?></title>
<main class="track-page">

	<div class="wrapper">
		<section class="info">
			<div class="cover-wrapper">
				<img class="cover" src="<?="/img/covers/$cover_art_filename"?>"/>
				<div class="cover darken"></div>
				<div class="cover play-button"></div>
				<div class="idkbro"></div>
			</div>
			<div class="info-card">
				<div class="title">
					<p class="title"><?="$artist - $title"?></p>
					<p class="catalog-id"><?=$catalog_id?></p>
				</div>
				<div class="tempbg"></div>
			</div>
		</section>
		<section class="cards">

			<a>
				<div class="freedownload card">
					<div class="icon"></div>
				</div>
			</a>

			<? if ($soundcloud_link != NULL) { ?>
			<a href="<?=$soundcloud_link?>" target="_blank">
				<div class="soundcloud card">
					<div class="icon"></div>
				</div>
			</a>
			<? } ?>

			<? if ($youtube_link != NULL) { ?>
			<a href="<?=$youtube_link?>" target="_blank">
				<div class="youtube card">
					<div class="icon"></div>
				</div>
			</a>
			<? } ?>

			<? if ($spotify_link != NULL) { ?>
			<a href="<?=$spotify_link?>" target="_blank">
				<div class="spotify card">
					<div class="icon"></div>
				</div>
			</a>
			<? } ?>

			<a>
				<div class="share card">
					<div class="icon"></div>
				</div>
			</a>

			<div class="share-box">
				<input type="text" value="<?="$site_address/$catalog_id"?>"/>
			</div>

		</section>
	</div>

	<div class="bg"></div>
	<img class="bg" src="<?="/img/covers/$cover_art_filename"?>"/>
</main>
<script src="/js/track.js"></script>
