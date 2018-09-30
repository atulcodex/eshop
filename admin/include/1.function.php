<?php
	error_reporting(0);
	$conn = mysqli_connect("localhost","root","","eshop");

	/*----------------------------------------------ip address--------------------------------------------------*/
	function getRealIpAdd()
	{
		//whether ip is from share internet
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   
		  {
		    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
		  }
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
		  {
		    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		//whether ip is from remote address
		else
		  {
		    $ip_address = $_SERVER['REMOTE_ADDR'];
		  }
	}
	

	/*-----------------------------------getting default page for myaccount page--------------------------*/
	function getDefault()
	{
		global $conn;
		$cemail = $_SESSION['customer_email'];

		$query1 = "SELECT * FROM customers WHERE c_email='$cemail'";
		$data1 = mysqli_query($conn, $query1);

		$result = mysqli_fetch_assoc($data1);
		
		$customer_id = $result['c_id'];
		$customer_name = $result['c_name'];

		if (!isset($_GET['my_order'])) 
		{
			if (!isset($_GET['edit_account'])) 
			{
				if (!isset($_GET['change_pass'])) 
				{
					if (!isset($_GET['delete_account'])) 
					{
						$query2 = "SELECT * FROM c_order WHERE customer_id='$customer_id' AND order_status='pending'";
						$data2 = mysqli_query($conn, $query2);

						$total = mysqli_num_rows($data2); 
						if ($total>0) 
						{
							echo "<div>
							    <img src='img/account.jpg' width='100%' height='400'/>
								 <h3 style='color:#4081e8; font-family: Lobster, cursive;'>Hii Mr/Mrs. $customer_name</h3>
								 <h2 style='color:#4081e8; font-family: Lobster, cursive;', sans-serif'>You Have $total Pending Orders</h2>
								 <h2 style='color:#4081e8; font-family: Lobster, cursive;', sans-serif'>You can see your order details <a href='1.myaccount.php?my_order'>click here</a></h2>
								</div> ";
						}
						else
						{
							echo "
								 <div>
								 	<img src='img/account.jpg' width='100%' height='400'/>
								 	<h3 style='color:#4081e8; font-family=''Open Sans Condensed', sans-serif'>Hii Mr/Mrs. $customer_name
								 	</h3>
								 	<h2 style='color:#4081e8; font-family=''Open Sans Condensed', sans-serif'>You Don't Have any Pending Orders Start shopping now
								 	</h2>
								 	</div>
								 ";
						}
					}
				}
			}
		}
		
	}
	

	/*------------------------------------------updating cart price-----------------------------------------------*/
	function updater()
	{
		
		if (isset($_GET['update'])) 
		{
			global $conn;
			$quantity = $_GET['qty'];
			$cip = getRealIpAdd();    //customer ip address

			$query = "UPDATE cart SET qty='$quantity' WHERE ip_add='$cip'";
			$data = mysqli_query($conn, $query);
			$total = $total*$quantity;

			if ($total) 
			{
				echo "<script>alert('Your cart is successfully updated!')</script>";
				header('location:cart.php');
			}
		}
	}

	/*-----------------------------------------creating script for cart-----------------------------------------------*/
	function cart()
	{
		if (isset($_GET['add_cart'])) 
		{
			global $conn;

			$cip = getRealIpAdd();    //customer ip address
			$pid = $_GET['add_cart'];    //product id

			$query = "SELECT * FROM cart WHERE p_id='$pid' AND ip_add='$cip'";
			$data = mysqli_query($conn , $query);
			$total = mysqli_num_rows($data);

			if ($total>0) 
			{
				echo "";
			}
			else
			{
				$query = "INSERT INTO cart (p_id ,ip_add) VALUES ('$pid','$cip')";
				$data = mysqli_query($conn, $query);

				if ($data) 
				{
					echo "<script>alert('product added in your cart, checkout your cart!')</script>";
					echo "<script>window.open('cart.php','_self')</script>";
				}
			}
		}
	}

	/*-------------------------------------------showing number of cart item--------------------------------------------*/
	function cartitem()
	{
		if (isset($_GET['add_cart'])) 
		{
			global $conn;

			$cip = getRealIpAdd();    //customer ip address
			$pid = $_GET['add_cart'];    //product id

			$query = "SELECT * FROM cart WHERE ip_add='$cip'";
			$data = mysqli_query($conn , $query);
			$item = mysqli_num_rows($data);

			echo $item." items";
		}
	}
	

	/*---------------------------------------total price of product-----------------------------------------*/
	function total_price()
	{
			global $conn;

			$cip = getRealIpAdd();    //customer ip address
			$total = 0;

			$query = "SELECT * FROM cart WHERE ip_add='$cip'";
			$data = mysqli_query($conn ,$query);

			while($result = mysqli_fetch_assoc($data)) 
			{
				$pro_id = $result['p_id'];

				$query1 = "SELECT * FROM products WHERE product_id='$pro_id'";
				$data1 = mysqli_query($conn ,$query1);
				
				while ($result1 = mysqli_fetch_assoc($data1)) 
				{
					$pro_price = array($result1['product_price']);
					$sum = array_sum($pro_price);
					$total += $sum;
				}
				
			}
			echo $total."/-";		
	}



	/*-----------------------------------------First product box--------------------------------------------------*/
	function product_box()
	{
		if (!isset($_GET['cat_id'])) 
		{
			if (!isset($_GET['bra_id'])) 
			{
				GLOBAL $conn;

				$query = "SELECT * FROM products ORDER BY rand() LIMIT 0,10";
				$data = mysqli_query($conn , $query);

				
				while ($result = mysqli_fetch_assoc($data)) 
				{
					$p_id = $result['product_id'];
					$p_title = $result['product_title'];
					$c_id = $result['cat_id'];
					$b_id = $result['brand_id'];
					$p_desc = $result['product_desc'];
					$p_price = $result['product_price'];
					$p_img = $result['product_img1'];

					echo "<div id='single_product'>
							 <p id='pname'>$p_title</p>
							 <a href='detail.php?pid=$p_id'>
							 	<img id='pimg' src='admin/$p_img' alt='product_img' width='195' height='200'/>
							 </a>
							 <P>
							 	<a href='detail.php?pid=$p_id'><button>Quick View</button></a>
							 	<i class='fas fa-rupee-sign'> $p_price/-</i>
							 	<a href='index.php?add_cart=$p_id'><button><i class='fas fa-plus'></i><i class='fas fa-shopping-cart'></i></button></a>
							 </p>
						  </div>";
				}
			}
		}
	}

/*------------------------------------if click on category----------------------------------------------------*/
function clickp_box()
	{
		if (isset($_GET['cat_id'])) 
		{
				$cid = $_GET['cat_id'];

				GLOBAL $conn;
				$query = "SELECT * FROM products WHERE cat_id='$cid'";
				$data = mysqli_query($conn , $query);

				$total = mysqli_num_rows($data);
				if ($total==0) 
				{
					echo "<img src='img/dog.png'>";
				}

				while ($result = mysqli_fetch_assoc($data)) 
				{
					$p_id = $result['product_id'];
					$p_title = $result['product_title'];
					$c_id = $result['cat_id'];
					$b_id = $result['brand_id'];
					$p_desc = $result['product_desc'];
					$p_price = $result['product_price'];
					$p_img = $result['product_img1'];

					echo "<div id='single_product'>
							 <p id='pname'>$p_title</p>
							 <a href='detail.php?pid=$p_id'>
							 	<img id='pimg' src='admin/$p_img' alt='product_img' width='195' height='200'/>
							 </a>
							 <P>
							 	<a href='detail.php?pid=$p_id'><button>Quick View</button></a>
							 	<i class='fas fa-rupee-sign'> $p_price/-</i>
							 	<a href='index.php?add_cart=$p_id'><button><i class='fas fa-plus'></i><i class='fas fa-shopping-cart'></i></button></a>
							 </p>
						  </div>";
				}
		}
	}

/*------------------------------------if click on brand----------------------------------------------------*/
function clickbrand()
	{
		if (isset($_GET['bra_id'])) 
		{
				$bid = $_GET['bra_id'];

				GLOBAL $conn;
				$query = "SELECT * FROM products WHERE brand_id='$bid'";
				$data = mysqli_query($conn , $query);

				$total = mysqli_num_rows($data);
				if ($total==0) 
				{
					echo "<img src='img/dog.png'>";
				}

				while ($result = mysqli_fetch_assoc($data)) 
				{
					$p_id = $result['product_id'];
					$p_title = $result['product_title'];
					$c_id = $result['cat_id'];
					$b_id = $result['brand_id'];
					$p_desc = $result['product_desc'];
					$p_price = $result['product_price'];
					$p_img = $result['product_img1'];

					echo "<div id='single_product'>
							 <p id='pname'>$p_title</p>
							 <a href='detail.php?pid=$p_id'>
							 	<img id='pimg' src='admin/$p_img' alt='product_img' width='195' height='200'/>
							 </a>
							 <P>
							 	<a href='detail.php?id=$p_id'><button>Quick View</button></a>
							 	<i class='fas fa-rupee-sign'> $p_price/-</i>
							 	<a href='index.php?add_cart=$p_id'><button><i class='fas fa-plus'></i><i class='fas fa-shopping-cart'></i></button></a>
							 </p>
						  </div>";
				}
		}
	}
	/*----------------------------------------------Second product box-----------------------------------------------*/
	function product_box1()
	{	
			GLOBAL $conn;		
			$query = "SELECT * FROM products ORDER BY rand() LIMIT 0,5";
			$data = mysqli_query($conn , $query);
			
			while ($result = mysqli_fetch_assoc($data)) 
			{
				$p_id = $result['product_id'];
				$p_title = $result['product_title'];
				$c_id = $result['cat_id'];
				$b_id = $result['brand_id'];
				$p_desc = $result['product_desc'];
				$p_price = $result['product_price'];
				$p_img = $result['product_img1'];

				echo "<div id='single_product'>
						 <p id='pname'>$p_title</p>
						 <a href='detail.php?pid=$p_id'>
						 	<img id='pimg' src='admin/$p_img' alt='product_img' width='200' height='250'/>
						 </a>
						 <P>
						 	<a href='detail.php?pid=$p_id'><button>Quick View</button></a>
						 	<i class='fas fa-rupee-sign'> $p_price/-</i>
						 	<a href='index.php?add_cart=$p_id'><button><i class='fas fa-plus'></i><i class='fas fa-shopping-cart'></i></button>
						 	</a>
						 </p>

					  </div>";
			}
	}
	


/*-------------------------------------------Category list-------------------------------------------------------*/
function catanbrand()
{	
			
		?>
		<ul id="head" >
		<li><img src="img/suit.png"> Top Category Formal's</li>
		</ul>
		<ul id="head2">
			<?php
				GLOBAL $conn;
				$query = "SELECT * FROM categories";
				$data = mysqli_query($conn , $query);

				while ($result = mysqli_fetch_assoc($data)) 
				{
					$id = $result['cat_id'];
					$title = $result['cat_title'];

					echo" <li><a href='index.php?cat_id=$id'> <img src='img/suit1.png' alt='suitname'> $title </a></li>";
				}
			?>
		</ul>

		<ul id="head" >
			<li><img src="img/trousers.png"> Top Brands Of Suit's</li>
		</ul>

		<ul id="head2">
			
			<?php
				GLOBAL $conn;
				$query = "SELECT * FROM brands";
				$data = mysqli_query($conn , $query);

				while ($result = mysqli_fetch_assoc($data)) 
				{
					$id = $result['brand_id'];
					$title = $result['brand_title'];

					echo" <li><a href='index.php?bra_id=$id'> <img src='img/suit1.png' alt='suitname'> $title</a></li>";
				}
			?>
		</ul>
		<?php
	
}
?>