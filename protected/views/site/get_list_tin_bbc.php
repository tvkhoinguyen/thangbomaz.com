<div id="leftcol">
<div class="main-cat-hotnews">
		<h3 class="main-daotao"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/family.png" /> 
			<?php echo $breadcrum; ?>
		</h3>

		<div style="float: left;">
		<?php
		    
		    $file='http://www.bbc.co.uk/vietnamese/index.xml';

		    // $data1 = file_get_contents( $file );

		    $dom=new DOMDocument('1.0','utf-8');
		    $dom->load($file);
		    $items = $dom->getElementsByTagName("entry");
		    
		    // $arr_xml = StringHelper::parseXml($data1);
		    // echo '<pre>';
		    // print_r($arr_xml);
		    // echo '</pre>';

		    foreach($items as $item)
		    {
		                $titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
		                $title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles

		                $links=$item->getElementsByTagName('link');
		                $link=$links->item(0);

		                $pubDates=$item->getElementsByTagName('updated');
		                $pubDate=$pubDates->item(0);

		                $descriptions=$item->getElementsByTagName('summary');
		                $des=$descriptions->item(0);
		            ?>
		            <table bgcolor="#e5eef2" style="border-bottom: #777777 1px solid; padding: 10px; ">
                      <tr>
                        <td colspan="2" style="font-size:16px; color:#FF0000; font-weight:bold; text-decoration:none; padding: 5px;">
                        	<a target="_blank" href="<?php  echo $link->getAttribute('href'); ?>" ><?php echo $title->nodeValue ?></a>
                        </td>
                      </tr>
                      <tr>
                      		  <td align="left" valign="top">
                      		  		<?php 
                      		  		// $xml = new DOMDocument();
                      		  		// $xml->loadXML($link);
                      		  		// $xmlArray = StringHelper::xml_to_array($xml);
                      		  		// print_r($xmlArray);
                      		  		///wait

                     //  		  		$aaa=$link->getElementsByTagName('media:content');
		                			// echo '<pre>';
		                			// print_r($aaa);
		                			// echo '</pre>';

		                			// $aaa=$link->getElementsByTagName('media:thumbnail');
		                			// echo '<pre>';
		                			// print_r($aaa);
		                			// echo '</pre>';

		                			// $aaa=$link->getElementsByTagName('media');
		                			// echo '<pre>';
		                			// print_r($aaa);
		                			// echo '</pre>';

		                			$aaa=$link->getElementsByTagName('img');
		                			$img_href = $aaa->item(0);
		                			// echo $img_href->getAttribute('src');
		                			
		                			if(!empty($img_href))
		                			{
		                				$src_link = $img_href->getAttribute('src');
		                				if(!empty($src_link))
		                				{
		                					?>
		                					<a href="<?php echo $link->getAttribute('href'); ?>" target="_blank" >
		                					<img src="<?php echo $src_link; ?>" width="106px" height="60px" />
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