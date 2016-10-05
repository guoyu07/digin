<style>
.container {
    overflow: hidden;
}
@media (min-width: 768px){
.sectionWrap {
    padding: 10px 10px;
    min-height: 350px;
}  }
.wishOrderName .col-xs-12 {
    padding: 0;
}
.row {
    margin-right: 0px;
    margin-left: 0px;
}
.col-xs-12 {
    width: 100%;
    float: left;
}
.wishOrderName {
    float: left;
    font-size: 12px;
    padding: 2px;
    margin-left: 40px;
}
div.OrderList {
    color: #555;
    font-size: 25px;
    margin: 16px 0 0;
}
div.OrderList {
    background: #f9f9f9;
    border-bottom: 1px solid #ccc;
    border-top: 1px solid #fff;
    display: block;
    padding: 10px;
}
.clearfix:after {
    clear: both;
}
.clearfix:before, .clearfix:after {
    display: table;
    content: " ";
}
.wishOrderName h2 {
    color: #4C92BB;
    font-size: 18px;
    margin: 0;
}
.wishDilvrName {
    margin-left: 170px;
    margin-top: 20px;
    font-size: 15px;
    padding: 2px;
    color: #444;
}
p {
    margin: 0 0 10px;
}
div.readBody table.table2 td {
    width: 0px;
}
table.border {
    border-style: solid;
    border-color: #828282;
}
.table1 {
    width: 600px;
}
.table {   
    margin-bottom: 20px;
}
.table>tbody>tr>th,  .table>tbody>tr>td{
    padding: 8px;
    line-height: 1.428571429;
    vertical-align: top;
    border-top: 1px solid #ddd;
    font-weight: bold;
}
th.special {
    border: 2px double #828282;
    //border-bottom: solid #828282;
    //border-style: double;
    text-align: center;
    font-size: 15px;
}
.td1 {
    text-align: center;
    height: 50px;
    border: 2px solid #999;
}
.orderList {
    border-bottom: 1px solid #ccc;
    margin-bottom: 30px;
}
div.orderValue {
    margin-top: 20px;
    margin-left: 52%;
}
.totalOrderCost {
    background: #ccc;
}
.orderValue {
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;    
    text-align: center;
}
@media (min-width: 768px){
.col-sm-push-1 {
    left: 8.333333333333332%;
}}
@media (min-width: 768px){
.col-sm-2 {
    width: 16.666666666666664%;
    float: left;
}}
.col-sm-2, .col-xs-4 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.orderValue .label {
    color: #777;
    font-size: 18px;
    //font-size: 14px;
    font-weight: normal;
    margin: 0;
    padding: 0;
}
.orderValue .value {
    color: #000;
    font-size: 16px;
    margin: 0;
}
.orderValue{
    text-align: center;
}
</style>


<div class="container sectionWrap">    
         <div class="row wishOrderName">
             <div class="col-xs-12"> <div class="clearfix OrderList">
                <div class="wishOrderName">
                    <h2>Order No. : &nbsp;  &nbsp;  &nbsp;</h2></div> 
                     <div class="wishDilvrName" style="margin-left: 170px;"><?php echo $orderdetails[0][0]['displayid'] ; ?></div>
                           
          </div>
          </div>
          
          <div class="col-xs-12"> <div class="clearfix OrderList">
          <div class="wishOrderName">
           <h2>Delivery Address : </h2>
           <p> <div class="wishDilvrName" style="margin-left: 170px;">
              <?php echo $orderdetails[1][0]['name']; ?><br>
              <?php echo $orderdetails[1][0]['address1']; ?>,<br>
              <?php echo $orderdetails[1][0]['address2']; ?>,
              <?php echo $orderdetails[1][0]['city']; ?>,<br>
              <?php echo $orderdetails[1][0]['state']; ?><br>
              <?php echo "<b>PIN:</b>&nbsp;&nbsp;".$orderdetails[1][0]['pin']; ?><br>
              <b>phone:</b>   <?php echo $orderdetails[1][0]['phone']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Email:</b>   <?php echo $orderdetails[1][0]['email']; ?> <br>
            
             </div>
          </div>
          </div>
          </div>
          
          <div class="col-xs-12"> <div class="clearfix OrderList">
          <div class="wishOrderName">
            <h2>Order Details :</h2>
            </div><br>
             <div class="wishOrderName" style="margin-left: 170px;">
                 <table class="table1 table border">
                     <tr>
                       <th class="special">Sr No.</th>
                       <!--th class="th1 special">Product Image</th-->
                          <th class="special">Product Name</th>		
                          <th class="special">Quantity</th>
                          <th class="special">Price</th>
                          <th class="special">Subtotal</th>
                          <th class="special">Shipping</th>
                        </tr>
                        
                        <?php 
                        $sr = 0;
                        $total = 0;
                        foreach ($orderdetails[2] as $ord){
                           $sr = $sr +  1; 
                        ?>
                     <tr>
                          <td class="td1"><?php echo $sr; ?></td>
                          <!--td class="td1"><div><?php// echo '<img src="'.$ord['Image'].'" style="max-width:100%; width:40px;">'; ?></div></td-->
                          <td class="td1"><?php echo $ord["prodname"];  echo "<br>- <b>By</b> ".$ord["businessname"]; ?></td>		
                          <td class="td1"> <?php echo $ord["quantity"]; ?></td>
                          <td class="td1"> <?php echo $ord["rate"]; 
                          $total = $total + $ord["producttotal"]?></td>
                          <td class="td1"> <?php echo $ord["producttotal"]; ?> </td>
                          <td class="td1"> <?php echo $ord["shipping"]; ?> </td>                       
                         </tr>
                        
                        <?php } ?> 
                        
                 </table>
            </div>
      </div>
              
              
          <div class="clearfix OrderList">
            <h4>Vendor Address : </h4>
      <?php foreach ($orderdetails[2] as $ord){?>
              <div class="wishOrderName">                  
               <div class="wishDilvrName" style="margin-left: 170px;"><?php echo  "<h4>".$ord["businessname"]."</h4><br>".$ord['address1']; ?>,<br>
            <?php echo $ord['address2']; ?>,
              <?php echo $ord['city']; ?>,<br>
              <?php echo $ord['state']; echo ", ".$ord['pin']; ?><br>              
              <b>phone:</b><?php echo $ord['phone']; ?><br><b>Email:</b><?php echo $ord['email']; ?> <br>
            
             </div>
         </div> 
               <?php } ?>
          </div>
             
          </div>
          
        <!--  <div class="col-xs-12">          
            <div class="row orderList">
          <div class="col-xs-4 col-sm-2 col-sm-push-1 orderValue totalOrderCost">
          <p class="label">Shipping Total</p>
          <p class="value">< ?php echo $orderdetails[0][0]['shipment']; ?></p>
           </div>
          <div class="col-xs-4 col-sm-2 col-sm-push-1 orderValue totalOrderCost">
          <p class="label">Gross Total</p>
          <p class="value">< ?php echo $orderdetails[0][0]['grosstotal']; ?></p>
           </div>
           </div>
          </div> -->
          
                 
                
      </div>

    </div>
   