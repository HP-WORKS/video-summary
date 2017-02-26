<ul class="pagination">

	<?php if ($num > 1){ ?>
		<li>
			<a href="/?page=<?php echo $num-1; ?>">前へ</a>
		</li>
	<?php } ?>

	<?php if ($num > 2){ ?>
		<li>
			<a href="/?page=<?php echo $num-2; ?>"><?php echo $num-2; ?></a>
		</li>
	<?php } ?>

	<?php if ($num > 1){ ?>
		<li>
			<a href="/?page=<?php echo $num-1; ?>"><?php echo $num-1; ?></a>
		</li>
	<?php } ?>

	<li class="active"><a><?php echo $num; ?></a></li>

	<?php if ($hit > $per*$num){ ?>
		<li>
			<a href="/?page=<?php echo $num+1; ?>">
				<?php echo $num+1; ?>
			</a>
		</li>
	<?php } ?>

	<?php if ($hit > $per*$num+$per){ ?>
		<li>
			<a href="/?page=<?php echo $num+2; ?>">
				<?php echo $num+2; ?>
			</a>
		</li>
	<?php } ?>

	<?php if ($hit > $per*$num){ ?>
		<li>
			<a href="/?page=<?php echo $num+1; ?>">次へ</a>
		</li>
	<?php } ?>

</ul>