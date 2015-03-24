<?php
	
	function getAllChildren($categoryId)
	{
		$array = mysql_query('SELECT * from categories');
		$a_cat = mysql_fetch_assoc($array);
		while (!empty($a_cat))
		{
			if (($a_cat['parent_ID']) == NULL)
				$pair[0][] = $a_cat['ID'];
			else
     			$pair[$a_cat['parent_ID']][] = $a_cat['ID'];
     		$a_cat = mysql_fetch_assoc($array);
     	}
     	$cats[] = $categoryId;
		$current = 0;
		while ($current <= count($cats))
		{
			for ($i = 0; $i < count($pair[$cats[$current]]); $i++)
			{ 
				$cats[] = $pair[$cats[$current]][$i];
			}
			$current = $current + 1;
		}
		return $cats;

	}

	function getCatalog($categoryId)
	{
		$cats = getAllChildren($categoryId);
		$string = 
			'SELECT dishes.*
            from dishes JOIN categories_dishes
            ON dishes.ID = categories_dishes.dishes_ID
            WHERE ';
  		for ($i = 0; $i < count($cats) - 1; $i++)
  		{ 
  			$string = $string . 'categories_dishes.categories_ID = "' .$cats[$i]. '" OR ';
  		}
  		$string = $string . 'categories_dishes.categories_ID = "' . $cats[$i] . '" GROUP BY dishes.ID';
  		//var_dump($string);
		return mysql_query($string);
	}

	function genList($cat, $page, $start, $perpage)
	{
		
		/*
		$result = mysql_query("SELECT * from categories WHERE ID = $cat");
		$a_cat = mysql_fetch_assoc($result);
        if (!empty($a_cat))
        {
            $catName = $a_cat['name'];
        }
		echo '<p>' . $catName . '</p>'; ////////   FIX THIS SHIT   //////////
		*/
  
        $dishlist = '';
        $rowcount = 0;
        $result = getCatalog($cat);

        $a_dish = mysql_fetch_assoc($result);                                
        $cart_avail = '';
        if ($GLOBALS['login'])
       	{
       		$cart_avail = '<p><a href="#" class="btn btn-primary" role="button">В корзину</a></p>';
       	}                
        while (!empty($a_dish))
        {
            $dishlist .= '<div class="row-fluid"><ul class="thumbnails">';
            while ($rowcount++ < 3 && !empty($a_dish))
            {
                $dishlist .= '
                    <li class="span4">
                    	<div class="dishpic"><img src="/food/img/' . $a_dish[piclink] . '" /></div>
                    	<div class="caption">
                    		<h4>' . $a_dish[name] . '</h4>
                    		<p><b>' . $a_dish[price] . 'р.</b></p>
                    		<p>' . $a_dish[description] . '</p>' . 
                        	$cart_avail .
                    	'</div>
                    </li>';
                $a_dish = mysql_fetch_assoc($result);                                                        
            }
            $rowcount = 0;
            $dishlist .= '</ul></div>';
        }   
        return $dishlist;
	}