<?php
	
	class PlaylistBL
	{
		public function WatchVideos()
		{
			$feed = "https://www.youtube.com/feeds/videos.xml?playlist_id=PLDuBTz2Byh9MaprT9RPIzkGWsUJCYrMKe";
			$xml = simplexml_load_file($feed);
			$entries = $xml->entry;
			
			foreach($entries as $entry)
			{
				$published = $entry->published;
				$shortDate = date("d.m.Y", strtotime($published));
	
				$title = $entry->title;
				$id = $entry->id;
				$id = str_replace("yt:video:", "", $id);
				$author = $entry->author->name;
				$uri = $entry->author->uri;
				
				$content = sprintf(" <article class='iframeContainer'>
										<h1><a class='btnStyle' href='%s'>%s</a></h1>
										<div class='youtube'
										 id='%s'>
										</div>
										<br>
										<small>Published: %s &nbsp; By: %s</small>
									</article>
									<hr>
									",
										$uri,
										$title,
										$id,
										$shortDate,
										$author
									);
				$contentArray[] = $content;
			}
			
			return $contentArray;
		}
		
	}
?>