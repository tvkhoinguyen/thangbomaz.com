<div id="leftcol">
<div class="main-cat-hotnews">
		<h3 class="main-daotao"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/family.png" /> 
			<?php echo $breadcrum; ?>
		</h3>

		<div style="float: left;">
		<?php
		    
		    $file='http://vnexpress.net/rss/tin-moi-nhat.rss';

		    $dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
		    $dom->load($file);//muon lay rss tu trang nao thi ban khai bao day
		    $items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
		    foreach($items as $item)
		    {
		                $titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
		                $title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles

		                $links=$item->getElementsByTagName('link');
		                $link=$links->item(0);

		                $pubDates=$item->getElementsByTagName('pubDate');
		                $pubDate=$pubDates->item(0);

		                $descriptions=$item->getElementsByTagName('description');
		                // $descriptions=$descriptions->getElementsByTagName('a');
		                $des=$descriptions->item(0);
		            ?>
		            <table bgcolor="#e5eef2" style="border-bottom: #777777 1px solid; padding: 10px; ">
                      <tr>
                        <td colspan="2" style="font-size:16px; color:#FF0000; font-weight:bold; text-decoration:none; padding: 5px;">
                        	<a target="_blank" href="<?php  echo $link->nodeValue ;?>" ><?php echo $title->nodeValue ?></a>
                        </td>
                      </tr>
                      <tr>
                      		  <td align="left" valign="top">
                      		  		<?php
                      		  		$img = explode('</br>', $des->nodeValue);
                      		  		// echo '<pre>';
                      		  		// print_r($img);
                      		  		// echo '</pre>';
                      		  		// echo $img[0];
                      		  		?>
                      		  		<a target="_blank" href="<?php  echo $link->nodeValue; ?>"><?php echo $img[0]; ?></a>
                      		  </td>
		                      <td align="left" valign="top" style="padding-left: 5px; padding-right: 5px;">
		                        <?php
		                        echo 'Ngày đăng: <font color="blue" ><i>'.$pubDate->nodeValue. '</i></font><br/>';
		                        echo '<br/>';
		                        echo $img[1];
		                        // echo $des->nodeValue; 
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