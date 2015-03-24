<?php
function makeCategoryTree()
	{
		//$array = $this->getCategories();
		$query = mysql_query('SELECT * from categories');
		$a_cat = mysql_fetch_assoc($query);
		while (!empty($a_cat))
		{
					$array[]=$a_cat;
				$a_cat = mysql_fetch_assoc($query);
		}

		foreach ($array as $key => &$value) {
			$pair[$value['ID']]= &$value;
		}
		unset($value);
		//var_dump($pair);
		foreach ($array as $key => &$value)
		{
			if ($value['parent_ID']==null)
			{
				$arr[]= &$value;
			}
			else
				$pair[$value['parent_ID']]['child'][]= &$value;
			//$pair[$value['parent_id']][]=$value;
		}
		unset($value);
		//var_dump($pair);
		//var_dump($arr);
		return $arr;

	}

function rec($array)
{?>
 	<ul class="nav nav-list">
		<?php foreach ($array as $key): ?>
		<li><a href="index.php?cat=<?=$key['ID']?>"><?=$key['name']?></a></li>
		<?php if (count($key['child'])>0)
		{
			rec($key['child']);
		}
			endforeach; ?>
	</ul>
<?php }

$array = makeCategoryTree();?>


<li class="nav-header"><?=$array[0]['child'][0]['name']?></li>

<?rec($array[0]['child'][0]['child']);?>

<li class="nav-header"><?=$array[0]['child'][1]['name']?></li>

<?rec($array[0]['child'][1]['child']);?>
