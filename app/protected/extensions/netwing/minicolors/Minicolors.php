<?php
/**
 * Select2 class file.
 * @author Emanuele Deserti <emanuele.deserti@netwing.it>
 * @copyright Copyright &copy; Emanuele Deserti 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package netwing
 * @version 1.0.0
 */

/**
 * Select2 component.
 */
class Minicolors extends CApplicationComponent
{
    /**
     * @var bool whether we should copy the asset file or directory even if it is already published before.
     */
    public $forceCopyAssets = false;

    private $_assetsUrl;

    /**
     * Registers the Font awesome CSS.
     * @param string $url the URL to the CSS file to register.
     */
    public function registerCss($url = null)
    {
        if ($url === null) {
            $fileName = YII_DEBUG ? 'jquery.minicolors.css' : 'jquery.minicolors.css';
            $url = $this->getAssetsUrl() . "/" . $fileName;
        }
        Yii::app()->clientScript->registerCssFile($url);
    }

    /**
     * Registers the Font awesome JS.
     * @param string $url the URL to the CSS file to register.
     */
    public function registerJs($url = null)
    {
        if ($url === null) {
            $fileName = YII_DEBUG ? 'jquery.minicolors.js' : 'jquery.minicolors.js';
            $url = $this->getAssetsUrl() . "/" . $fileName;
        }
        Yii::app()->clientScript->registerScriptFile($url, CClientScript::POS_HEAD);
    }

    /**
     * Registers all Bootstrap CSS files.
     */
    public function registerAllCss()
    {
        $this->registerCss();
    }

    /**
     * Registers all Bootstrap CSS files.
     */
    public function registerAllJs()
    {
        $this->registerJs();
    }

    /**
     * Registers all assets.
     */
    public function register()
    {
        $this->registerAllCss();
        $this->registerAllJs();
    }

    /**
     * Returns the url to the published assets folder.
     * @return string the url.
     */
    protected function getAssetsUrl()
    {
        if (isset($this->_assetsUrl)) {
            return $this->_assetsUrl;
        } else {
            // Save default exclude files
            $excludeFiles = Yii::app()->assetManager->excludeFiles;
            // Do not publish this files
            Yii::app()->assetManager->excludeFiles = array_merge(
                $excludeFiles, 
                array('.bower.json', 'component.json', '.gitignore', 'index.html', 'readme.md', 'without-bootstrap.html')
            );
            $assetsPath = Yii::getPathOfAlias('bower.jquery-minicolors');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, true, -1, $this->forceCopyAssets);
            return $this->_assetsUrl = $assetsUrl;
        }
    }

}
