<?php 
session_start();

  include("connection.php");
  include("function.php");

  $user_data = check_login($conn);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css_files/payment.css">

	
	
</head>
<body>

<img src="image/20.png">
<?php



  if(isset($_POST['checkout'])){


     $name=$_POST['name'];
     $email=$_POST['email'];
     $address=$_POST['address'];
     $city=$_POST['city'];
     $province=$_POST['province'];
     $zip=$_POST['zip'];
     $cname=$_POST['cardName'];
     $cnumber=$_POST['cardNumber'];
     $expM=$_POST['expM'];
     $expY=$_POST['expYear'];
     $cvv=$_POST['cvv'];
     $amount=$_POST['amount'];


       if($conn->connect_error)
          {
            die('Connection Failed :'.$conn->connect_error);
          }
          else
          {


              $stmt=$conn->prepare("INSERT INTO payment(amount,name,email,address,city,province,zip_code,card_name,card_number,exp_month,exp_year,cvv) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
              //table3 is the table name//

              $stmt->bind_param("isssssissssi",$amount,$name,$email,$address,$city,$province,$zip,$cname,$cnumber, $expM,$expY,$cvv);

              $stmt->execute();
                          
                           echo ("<script LANGUAGE='JavaScript'>
                window.alert('Succesfully added!!!');
                window.location.href='paySucess.php';
                </script>");

              
              $stmt->close();
              $conn->close();
              }
                
          
      }     
  

   ?>


<div class="container">

    <form method="POST">

        <div class="row">

            <div class="col">

                <h3 class="title">billing address</h3>

                 <div class="inputBox">
                    <span>Amount You Pay :</span>
                    <input type="number" value="500.00" name="amount">
                </div>

                <div class="inputBox">
                    <span>Name :</span>
                    <input type="text" value="<?php echo $user_data['username'];?>" name="name">
                </div>

                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" value="<?php echo $user_data['email'];?>" name="email">
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="address">
                </div>
                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" placeholder="enter your city" name="city">
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Province :</span>
                        <input type="text" placeholder="enter your province" name="province">
                    </div>
                    <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" placeholder="123 456" name="zip">
                    </div>
                </div>

            </div>

            <div class="col">

                <h3 class="title">payment</h3>

                <div class="inputBox">
                    <span>cards accepted :</span>
                    <img src="image/card_img.png" alt="">
                </div>
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" placeholder="mr. john " name="cardName" required>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444" name="cardNumber" required>
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" placeholder="january" name="expM" required>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" placeholder="2022" name="expYear" required>
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="123" name="cvv" required>
                    </div>
                </div>

            </div>
    
        </div>

        <input type="submit" value="proceed to checkout" class="submit-btn" name="checkout">

    </form>

</div>    
    
</body>
</html>