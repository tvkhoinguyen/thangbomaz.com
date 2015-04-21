<?php 
class AdsBannerHomepageWidget extends CWidget
{

    public $position;

    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
        $adsTop = IsaAdsBanner::getAdsBannerByPosition('Top');
        $adsLeft = IsaAdsBanner::getAdsBannerByPosition('Left');
        $adsRight = IsaAdsBanner::getAdsBannerByPosition('Right');
        $this->render("banner/banner_ads",array(
            'adsTop'=>$adsTop,
            'adsLeft'=>$adsLeft,
            'adsRight'=>$adsRight,
        ));
    }
}
?>