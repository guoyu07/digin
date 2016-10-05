<style type="text/css">
td {
	font-family: Cambria, Hoefler Text, Liberation Serif, Times, Times New Roman, serif;
}
</style>
<table width="682" border="0">
  <tbody>
    <tr>
      <td width="154" height="47">&nbsp;</td>
      <td width="202">&nbsp;</td>
      <td  align="right" width="312"><img src="<?=Yii::$app->request->baseUrl."/images/receiptlogo.png"?>" width="183" height="43" style="width:300px; height:35px;"></td>
    </tr>
    <tr>
      <td height="69">&nbsp;</td>
      <td>&nbsp;</td>
      <td><p style="font-size:12px;">DIGIN TECHNOLOGIES PRIVATE LIMITED
        105/1/1, Ground Floor, Pavilion, Baner, Pune, Maharashtra, INDIA 411045.
      mail@digin.in    |    www.digin.in CIN: U72200PN2015PTC157389 </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p align="center"><strong><u>Invoice  Cum Receipt</u></strong></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <?php $dt1=  explode('-', $data['crtdt']);
            $dt2=  explode('-', $data['enddate']);?>
      <td><p align="right"><strong>Invoice  No :DTPL/</strong><?=$data['invoiceno']?>/<?php echo $dt1[0]."-".$dt2[0];?></p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><p align="right"><strong>Date :</strong><?= $data['crtdt']?></p></td>
    </tr>
    <tr>
      <td><strong>Name : </strong></td>
      <td><p><?=$data['name']?></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Address :</strong></td>
      <td><p><?=$data['address']?></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Phone :</strong></td>
      <td><p><strong>+91 </strong><?=$data['phone']?> </p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Email :</strong></td>
      <td><p><?=$data['email']?></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Business Name : </strong></td>
      <td><?=$data['business']?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Plan: </strong> </td>
      <td><p><strong><?=$data['plan']?></strong></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Subscription:</strong></td>
      <td><?=$data['crtdt']?> TO <?=$data['enddate']?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Plan Fee:</strong></td>
      <td><p><?php echo $data['currency']."  ".$data['charge']?></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><p><strong>Receipt Details: </strong></p></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php if($data['paytype']==1) {?>
    <tr>
      <td><strong>Pay By :</strong></td>
      <td>Cash</td>
      <td>&nbsp;</td>
    </tr>
    <?php } else if($data['paytype']==2){?>
    <tr>
      <td><strong>Pay By :</strong></td>
      <td>Cheque</td>
      <td>&nbsp;</td>
    </tr>
    <tr>        
      <td><strong>Cheque No :</strong></td>
      <td><?=$data['payno']?></td>
      <td>&nbsp;</td>
    </tr>
    <?php }else if($data['paytype']==3){ ?>
    <tr>
      <td><strong>Pay By :</strong></td>
      <td>Online</td>
      <td>&nbsp;</td>
    </tr>
    <tr>        
      <td><strong>Transaction No :</strong></td>
      <td><?=$data['payno']?></td>
      <td>&nbsp;</td>
    </tr>
    <?php } else if($data['paytype']==4){?>
    <tr>
      <td><strong>Pay By :</strong></td>
      <td>DD</td>
      <td>&nbsp;</td>
    </tr>
    <tr>        
      <td><strong>DD No :</strong></td>
      <td><?=$data['payno']?></td>
      <td>&nbsp;</td>
    </tr>
    <?php }?>
    
    <tr>
      <td><strong>Received :</strong></td>
      <td><p><?php echo $data['currency']."  ".$data['charge']?></p></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><p align="right">Digin  Technologies Pvt Ltd </p></td>
    </tr>
    <tr>
      <td height="21" colspan="3" ><p align="left"><strong>System  Generated.</strong><img width="674" height="2" src="<?=Yii::$app->request->baseUrl."/images/receipt_clip_image001.png"?>"></p></td>
    </tr>
  </tbody>
</table>
