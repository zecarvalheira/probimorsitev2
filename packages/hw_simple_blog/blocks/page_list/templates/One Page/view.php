<?php     
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>

<?php      if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php      echo t('Empty Page List Block.')?></div>
<?php      } else { ?>

<div class="ccm-block-page-list-wrapper">

    <?php      if ($pageListTitle): ?>
        <div class="ccm-block-page-list-header">
            <h5><?php      echo h($pageListTitle)?></h5>
        </div>
    <?php      endif; ?>

    <?php      if ($rssUrl): ?>
        <a href="<?php      echo $rssUrl ?>" target="_blank" class="ccm-block-page-list-rss-feed"><i class="fa fa-rss"></i></a>
    <?php      endif; ?>

    <div class="ccm-block-page-list-pages">

    <?php      foreach ($pages as $page):

		// Prepare data for each page being listed...
        $buttonClasses = 'ccm-block-page-list-read-more';
        $entryClasses = 'ccm-block-page-list-page-entry';
		$title = $th->entities($page->getCollectionName());
		$url = $nh->getLinkToCollection($page);
		$target = ($page->getCollectionPointerExternalLink() != '' && $page->openCollectionPointerExternalLinkInNewWindow()) ? '_blank' : $page->getAttribute('nav_target');
		$target = empty($target) ? '_self' : $target;
        $thumbnail = false;
        if ($displayThumbnail) {
            $thumbnail = $page->getAttribute('thumbnail');
        }
        $includeEntryText = false;
        if ($includeName || $includeDescription || $useButtonForLink) {
            $includeEntryText = true;
        }
        if (is_object($thumbnail) && $includeEntryText) {
            $entryClasses = 'ccm-block-page-list-page-entry-horizontal';
        }

        $date = $dh->formatDateTime($page->getCollectionDatePublic(), true);

?>
		
        <div class="<?php      echo $entryClasses?>">

        <?php      if (is_object($thumbnail)): ?>
            <div class="ccm-block-page-list-page-entry-thumbnail">
                <?php     
                $img = Core::make('html/image', array($thumbnail));
                $tag = $img->getTag();
                $tag->addClass('img-responsive');
                print $tag;
                ?>
            </div>
        <?php      endif; ?>

        <?php      if ($includeEntryText): ?>
            <div class="ccm-block-page-list-page-entry-text">

                <?php      if ($includeName): ?>
                <div class="ccm-block-page-list-title">
                    <?php      if ($useButtonForLink) { ?>
                        <?php      echo $title; ?>
                    <?php      } else { ?>
                        <a href="<?php      echo $url ?>" target="<?php      echo $target ?>"><?php      echo $title ?></a>
                    <?php      } ?>
                </div>
                <?php      endif; ?>


                 <div class="ccm-block-page-list-date"><?php      echo $date?></div>

				<div class="ccm-block-page-list-description">
				<?php     

					$block = $page->getBlocks('Main');
					foreach ($block as $bi) {
						if ($bi->getBlockTypeHandle()=='content') {
							$content = $bi->getInstance()->getContent();
						}
					}
					echo $content;
				?>
				</div>

                <?php      if ($useButtonForLink): ?>
                <div class="ccm-block-page-list-page-entry-read-more">
                    <a href="<?php      echo $url?>" class="<?php      echo $buttonClasses?>"><?php      echo $buttonLinkText?></a>
                </div>
                <?php      endif; ?>

                </div>
        <?php      endif; ?>
        </div>

	<?php      endforeach; ?>
    </div>

    <?php      if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php      echo h($noResultsMessage)?></div>
    <?php      endif;?>

</div><!-- end .ccm-block-page-list -->


<?php      if ($showPagination): ?>
    <?php      echo $pagination;?>
<?php      endif; ?>

<?php      } ?>