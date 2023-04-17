
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
  <title>Document</title>
<style>
   @font-face {
        font-family: 'sbold';
        src: url('https://hcurvecdn.com/fonts/cardium-bold.woff2?v=3') format("truetype");
    }

    .abc:hover {
 background-image: linear-gradient(to bottom right, white, #3497e2);
  backdrop-filter: blur(550px); 
}
.abc:hover .xx {
        display: block;color:white;fort-size:16px;bottom:10%;position:absolute;text-align:center;width:100%;
    }
    .abc:hover .yy {
        display: block;color:black;fort-size:30px;bottom:50%;position:absolute;text-align:center;width:100%;
    }
    .xx, .yy{
        display: none;
    }


#pagination ul{
      display: flex;
      margin-left:5%;width:90%;
  justify-content: center;
  }
    #pagination li {
          list-style-type: none;
          margin: 10px 0px;
          padding: 6px 10px;
          font-size:20px;
      }

/*.input-box {*/
/*        display: flex;*/
/*        flex-direction: row;*/
/*        justify-content: center;*/
/*        align-items: center;*/
/*    }*/
    
    
    
</style>
</head>


<?php
 $sql = "SELECT * FROM `campaign_info` ORDER BY id DESC";

if(isset($_POST['submit'])){
$template=$_POST['template'];
$client=$_POST['clients'];
if($template!="" && $client!=""){
     $sql = "SELECT * FROM `campaign_info` WHERE `client_name` = '$client' AND `template`= '$template' ORDER BY id DESC ";
}
else if($template!=""){
// echo "hello";
// echo $template;

      $sql = "SELECT * FROM `campaign_info` WHERE `template`= '$template' ORDER BY id DESC";
   
}
else if($client!=""){
// echo "hello";
// echo $client;

      $sql = "SELECT * FROM `campaign_info` WHERE `client_name` = '$client' ORDER BY id DESC ";
}

else{
// echo "No data";

    
}
}
?>


<body>

    
    <div style="position:absolute;top:0%;left:0;width:100%;text-align:center;font-size:5rem;"><span style="background: linear-gradient(to right, #063970, #c651af); -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;">HC Public Library</span></div>
    
<div style="position:relative;top:20%;box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);border-radius:5px">
   
    <div class="grid-container">
    <?php
      include "../conn.php";
      error_reporting(E_ERROR | E_PARSE);

      $result = $connectDB->query($sql);
$count=0;
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $title=$row['campaign_title'];
             $client=$row['client_name'];
          $dimension=$row['dimension'];
          $dim=explode(",",$dimension);
          $fcat=$row['campaign_name'];
          $public=$row['public'];
          $publicc=explode(",",$public);
        //   echo $publicc;
          for($j=0;$j<count($publicc);$j++){
              
            if($publicc[$j]==1){
               
              $break=explode("x",$dim[$j]);
              $count++;
    ?>
            <div class="t2" style="width:300px;height:250px;position:relative;display:inline-block;overflow:hidden;margin:56px;border-radius:5px;box-shadow: 0 0 5px #063970;left: 10%;">
                <a target="_blank" href="https://publisherplex.io/selfserve/library/blog.php?param=<?php echo $client ?>,<?php echo $dim[$j] ?>,<?php echo $fcat ?>" style="cursor: pointer;">
                    <div class="abc" style="width:300px;height:250px;position:absolute; ">
                        <span class="xx"><?php echo $title ?><br><?php echo $client ?></span>
                         <span class="yy">Click to view Live Experience &rarr;</span>
                    </div>
                    <iframe style="pointer-events: none;" src="https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $dim[$j] ?>&client=<?php echo $client?>&fcat=<?php echo $fcat ?>&optout=false&hct=master" scrolling="yes" frameborder="0" width="<?php echo $break[0] ?>" height="<?php echo $break[1] ?>"></iframe>
                    
                </a>
            </div>
    <?php
            }
          }
        }
      }
//   echo $count;
?>
  </div>

   <div id="pagination">
        <ul>
            <li></li>
        </ul>
    </div>  

<form method="POST" style="display: flex;justify-content: center;top:20px;">
    <!--template-->
    <div class="input-box" style="display: flex; align-items: center;top: -85px;position: absolute;left: 440px">
             <label for="clients">Template &nbsp;</label>
     <select name="template" id="templte" style="border:2px solid #24b2be;border-radius:3px;height:39px;flex: 1;" class="templte" multiple>
            <option value="">Select Option </option>
            <?php
                $sqlc = "SELECT DISTINCT template FROM `campaign_info` WHERE `public` LIKE '%1%'  ORDER BY id DESC";
                $resultc = $connectDB->query($sqlc);
                if ($resultc->num_rows > 0) {
                    // output data of each row
                    while($rowc = $resultc->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $rowc['template'] ?>"><?php echo $rowc['template'] ?></option>
                        <?php
                    }
                }
            ?>
        </select>
    </div>
    <!--client-->
    <div class="input-box" style="display: flex; align-items: center;top: -85px;position: absolute;left: 710px">
               <label for="clients">Client</label>
   <select name="clients" id="clients" style="border:2px solid #24b2be;border-radius:3px;height:39px;flex: 1;" class="clients" multiple>
            <option value="">Select Client &nbsp;</option>
            <?php
                $sqld = "SELECT distinct client_name FROM `campaign_info` WHERE `public` LIKE '%1%'  ORDER BY id DESC";
                $resultd = $connectDB->query($sqld);
                if ($resultd->num_rows > 0) {
                    // output data of each row
                    while($rowd = $resultd->fetch_assoc()) {  $client=$row['client_name'];
                        ?>
                <option value="<?php echo $rowd['client_name'] ?>"><?php echo $rowd['client_name'] ?></option>
                        <?php
                    }
                }
            ?>
        </select>
    </div>
<!--btn-->
    <div class="input-box" style="display: flex; align-items: center;top:-85px;position: absolute;left:960px">
               <button type="submit" name="submit" style="width: 100px; height: 38px; font-size: 20px;">Result</button>
     </div>

</form>

</div>

<script>
    $(document).ready(function() {
    var items = $(".t2");
    var numItems = items.length;
    
    // Check if there is only one item in the list
    if (numItems === 1) {
        // Hide the pagination element
        $('#pagination').hide();
        // Show the only item in the list
        items.show();
        return; // Exit the function
    }
    
    var perPage = 6;
    var showFrom = 0;
    var showTo = perPage;
    items.hide().slice(showFrom, showTo).show();

    $('#pagination').pagination({
      items: numItems,
      itemsOnPage: perPage,
      prevText: "",
      nextText: "",
      onPageClick: function (pageNumber) {
        showFrom = perPage * (pageNumber - 1);
        showTo = showFrom + perPage;
        items.hide().slice(showFrom, showTo).show();
      }
    });
});

</script>
<script>
    let $select = $('select').multiselect({
  enableFiltering: true,
  includeFilterClearBtn: true,
  enableCaseInsensitiveFiltering: true
  
});
</script>


</body>
