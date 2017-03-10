<?php
namespace Application\Theme\Probimor;

class PageTheme extends \Concrete\Core\Page\Theme\Theme {

  public function registerAssets()
  {
    $this->requireAsset('javascript', 'jquery');
  }
}
