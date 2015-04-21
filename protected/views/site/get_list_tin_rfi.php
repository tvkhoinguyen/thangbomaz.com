<div id="leftcol">
<div class="main-cat-hotnews">
		<h3 class="main-daotao"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/family.png" /> 
			<?php echo $breadcrum; ?>
		</h3>

		<div style="float: left;">
		<?php
		    
		    $file='http://vi.rfi.fr/trang-chu/rss/';

		    $dom=new DOMDocument('1.0','utf-8');
		    $dom->load($file);
		    $items = $dom->getElementsByTagName("item");

		    foreach($items as $item)
		    {
                $titles=$item->getElementsByTagName('title');
                $title=$titles->item(0);

                $links=$item->getElementsByTagName('link');
                $link=$links->item(0);

                $pubDates=$item->getElementsByTagName('pubDate');
                $pubDate=$pubDates->item(0);

                $descriptions=$item->getElementsByTagName('description');
                $des=$descriptions->item(0);

                $aaa=$item->getElementsByTagName('thumbnail');
    			$img_href = $aaa->item(0);
            ?>
		            <table bgcolor="#e5eef2" style="border-bottom: #777777 1px solid; padding: 10px; ">
                      <tr>
	                        <td colspan="2" style="font-size:16px; color:#FF0000; font-weight:bold; text-decoration:none; padding: 5px;">
	                        	<a target="_blank" href="<?php  echo $link->nodeValue; ?>" ><?php echo $title->nodeValue ?></a>
	                        </td>
                      </tr>
                      <tr>
                      		  <td align="left" valign="top">
                      		  		<?php 
		                			if(!empty($img_href))
		                			{
		                				$src_link = $img_href->getAttribute('url');
		                				if(!empty($src_link))
		                				{
		                					?>
		                					<a href="<?php echo $link->nodeValue; ?>" target="_blank" >
		                						<img src="<?php echo $src_link; ?>" width="130px" height="97px" />
		                					</a>
		                					<?php
		                				}
		                			}
                      		  		?>
                      		  </td>
		                      <td align="left" valign="top" style="padding-left: 5px; padding-right: 10px; padding-bottom: 10px;">
		                        <?php
		                        echo 'Ngày đăng: <font color="blue" ><i>'.$pubDate->nodeValue. '</i></font><br/>';
		                        echo '<br/>';
		                        echo $des->nodeValue;
		                        ?>
		                       </td>
                      </tr>
                      
                    </table>
                    <br/>
                    <br/>
                     <?php
             }
            ?>
            </div>
</div>
</div>

<div id="rightcol" style="margin-top: 7px">
	<?php $this->widget('AdsRightWidget'); ?>
</div>