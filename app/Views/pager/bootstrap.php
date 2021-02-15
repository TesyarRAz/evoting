<?php $pager->setSurroundCount(5); ?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pagination justify-content-end">
		<li class="page-item <?= !$pager->hasPrevious() ? 'disabled' : '' ?>">
			<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
				<span aria-hidden="true"><?= lang('Pager.first') ?></span>
			</a>
		</li>
		<li class="page-item <?= !$pager->hasPrevious() ? 'disabled' : '' ?>">
			<a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>

		<?php foreach ($pager->links() as $link) : ?>
			<li class="page-item <?= $link['active'] ? 'active' : '' ?>">
				<a class="page-link" href="<?= $link['uri'] ?>">
					<?= $link['title'] ?>
				</a>
			</li>
		<?php endforeach ?>

		<?php if (empty($pager->links())): ?>
			<li class="page-item">
				<a class="page-link" href="#">
					1
				</a>
			</li>
		<?php endif ?>

		<li class="page-item <?= !$pager->hasNext() ? 'disabled' : '' ?>">
			<a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
		<li class="page-item <?= !$pager->hasNext() ? 'disabled' : '' ?>">
			<a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
				<span aria-hidden="true"><?= lang('Pager.last') ?></span>
			</a>
		</li>
	</ul>
</nav>