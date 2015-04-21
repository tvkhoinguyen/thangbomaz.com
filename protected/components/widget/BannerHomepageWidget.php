<?php 
class BannerHomepageWidget extends CWidget
{

    public $position;

    public function run()
    {
        $this->getBanner();
    }
    public function getBanner()
    {
       $data = Banners::getActiveBanner();
       $this->render("banner/banner_slide",array('data'=>$data));
    }
}
?>