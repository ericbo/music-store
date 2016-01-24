<?php 
  session_start();
  $dir = dirname(__FILE__);
  include_once($dir . "/functions/helper_functions.php");
  $total = 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/audio-player.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .modal {
        max-height: 90%;
        overflow-y: auto;
    }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h1>Shopping Cart</h1>
                </div>
                <?php 
                if(isset($_SESSION['cart']) && count($_SESSION['cart']))
                {
                ?>
                <table class="table table-hover">
                    <tbody>
                        <?php 
                            foreach($_SESSION['cart'] as $item)
                            {
                              if(isset($item['exclusive']) && $item['exclusive'] == true)
                              {
                                $leaseStatus = "<span class=\"text-success\"><strong>Exclusive for life</strong></span>";
                                $price = $item['exclusivePrice'];
                              }
                              else
                              {
                                $leaseStatus = "<span class=\"text-warning\"><strong>3 month lease</strong></span>";
                                $price = $item['leasePrice'];
                              }

                              $total += $price;

                              echo "
                        <tr>
                            <td class=\"col-sm-6 col-md-4\">
                            <div class=\"media\">
                                <h4 class=\"media-heading\">{$item['title']}<br><small>{$item['category']}</small></h4>
                            </div></td>
                            <td class=\"col-sm-4 col-md-6 text-center\">{$leaseStatus}</td>
                            <td class=\"col-sm-1 col-md-1 text-center\"><strong>\${$price}</strong></td>
                            <td class=\"col-sm-1 col-md-1\">
                            <button onClick=\"removeFromCart({$item['beatID']})\" type=\"button\" class=\"btn btn-danger\">
                                <span class=\"glyphicon glyphicon-remove\"></span> Remove
                            </button></td>
                        </tr>
                              ";
                            }
                        ?>
                        <tr>
                            <td class="col-sm-6 col-md-4">   </td>
                            <td class="col-sm-4 col-md-6">   </td>
                            <td class="col-sm-1 col-md-1"><h3>Total</h3></td>
                            <td class="col-sm-1 col-md-1 text-right"><h3><strong><?php echo "\${$total}"; ?></strong></h3></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <a href="<?php echo get_base_url(); ?>" type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </a></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    Checkout <span class="glyphicon glyphicon-play"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php 
                } 
                else
                  echo '        
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Warning!</h3> 
          </div>
          <div class="panel-body">You\'re cart is currently empty!</div>
        </div>

        <a href="' .get_base_url(). '" type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </a>';

                ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      <p>Gummi bears chocolate bar lollipop caramels bear claw soufflé. Croissant icing tootsie roll dessert toffee jelly beans cake. Brownie sugar plum tiramisu sugar plum. Ice cream halvah lollipop cake bear claw caramels cake. Dessert cake powder marzipan sesame snaps jelly marshmallow candy canes. Liquorice fruitcake candy tart. Jelly pastry lollipop. Dragée bonbon icing jujubes liquorice gummi bears apple pie lemon drops. Muffin apple pie cookie. Pie halvah sugar plum. Chupa chups tootsie roll tiramisu sweet. Dragée chocolate bar topping powder sweet pastry. Tiramisu pastry pie sesame snaps soufflé dessert chocolate tiramisu sweet roll. Brownie cheesecake cotton candy gummi bears gummies.</p>
      <p>Candy brownie cake. Gummies lemon drops bonbon lollipop lollipop. Cake apple pie lollipop dessert cookie wafer. Cake toffee cake. Chocolate cake tootsie roll ice cream soufflé dragée biscuit jelly beans bear claw. Topping candy carrot cake pie jelly beans tart brownie ice cream. Ice cream croissant wafer. Sweet oat cake lemon drops soufflé pudding. Tootsie roll jelly caramels oat cake chupa chups. Muffin candy canes jelly gummies. Powder pastry jelly beans muffin cookie. Dragée jelly-o liquorice ice cream.</p>
      <p>Dragée ice cream lollipop. Caramels chocolate apple pie biscuit dragée tootsie roll cookie jujubes lemon drops. Dragée biscuit cookie jujubes. Gummi bears caramels soufflé danish dessert dessert. Jelly-o pudding fruitcake chocolate cake chocolate bar pie. Muffin lemon drops marzipan biscuit sesame snaps dragée liquorice toffee tart. Apple pie tootsie roll lollipop jelly-o wafer lollipop fruitcake sweet roll. Tootsie roll lemon drops marshmallow. Tiramisu sweet roll ice cream macaroon. Sesame snaps topping cotton candy halvah sesame snaps tootsie roll donut bear claw. Oat cake croissant biscuit soufflé cookie chocolate chocolate bar. Bear claw candy donut sesame snaps liquorice brownie chocolate marzipan.</p>
      <p>Marshmallow chocolate bar marzipan oat cake cake marshmallow gingerbread. Jujubes liquorice biscuit sweet. Ice cream fruitcake jelly lollipop biscuit cake tiramisu apple pie. Gummi bears bonbon candy topping dragée gummies. Dragée liquorice tiramisu topping brownie. Pastry bonbon danish pie muffin donut brownie. Pie brownie candy cookie danish toffee tiramisu jelly beans chocolate cake. Oat cake oat cake ice cream jelly beans jelly-o gummi bears liquorice. Cookie tootsie roll gummi bears sesame snaps gummies jujubes. Brownie pie caramels carrot cake. Danish jelly pie sugar plum powder chupa chups jujubes fruitcake lollipop. Gummi bears apple pie cake sweet roll jelly-o wafer. Gingerbread bonbon cake toffee chocolate cake. Cheesecake carrot cake tart topping bear claw gummi bears icing.</p>
      <p>Ice cream jelly muffin icing cupcake croissant brownie. Chocolate bar carrot cake gummi bears candy canes tart ice cream dessert. Tart cookie donut apple pie croissant topping. Jelly-o sesame snaps jujubes biscuit. Jelly beans brownie cake ice cream soufflé. Sweet cupcake sweet roll. Dragée brownie liquorice powder macaroon brownie. Jujubes marzipan candy sweet. Dessert dessert bear claw fruitcake cotton candy soufflé. Jelly beans dessert fruitcake jelly beans wafer tiramisu sweet roll lollipop carrot cake. Halvah dragée fruitcake wafer chupa chups halvah. Brownie carrot cake lemon drops candy canes. Marshmallow topping sesame snaps tootsie roll sesame snaps tiramisu. Chupa chups soufflé caramels ice cream ice cream sesame snaps tart cheesecake.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Agree &amp; Continue</button>
      </div>
    </div>
  </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>