<h3><?php echo $this->venue->getName(); ?></h3>

	<img src="/Dynamic-Web-Project/<?php echo Image::getSize($this->image['source'], 'small_banner'); ?>" alt="<?php echo $this->image['title']; ?>" />

<p><?php echo substr($this->venue->getDescription(), 0, 200) . "..."; ?></p>

<a href="venues/<?php echo $this->venue->getId(); ?>" class="btn btn-medium btn-secondary btn-fullWidth">View Venue</a>
