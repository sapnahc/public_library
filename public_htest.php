
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">-->

 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
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
    
    .abc {
        transition: all 1s ease-in;
    }

    .abc:hover {
 background-image: linear-gradient(to bottom right, white, #3497e2);
  backdrop-filter: blur(550px); 
}
.abc:hover .xx {
        display: block;color:white;font-size:16px;bottom:10%;position:absolute;text-align:center;width:100%;
    }
    .abc:hover .yy {
        display: block;color:black;font-size:30px;bottom:50%;position:absolute;text-align:center;width:100%;
    }
    .xx, .yy{
        display: none;
    }


#pagination ul{
      display: flex;
      margin-left:5%;
      width:90%;
      justify-content: center;
  }
    #pagination li {
          list-style-type: none;
          margin: 10px 0px;
          padding: 6px 10px;
          font-size:20px;
      }
      
.current {
    color: black;
    pointer-events: none;
}

.input-box {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    
</style>
</head>


<?php
 $sql = "SELECT * FROM `campaign_info` ORDER BY id DESC";

if(isset($_POST['submit'])){
 
$template=$_POST['template'];
if($template!=""){
// echo "hello";
// echo $template;

if(isset($_GET['page'])){
        $page = 1;
    } else {
    }
      $sql = "SELECT * FROM `campaign_info` WHERE `template`= '$template' ORDER BY id DESC";
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
    //   print_r($result);
    $count = 0;
    $data = [];
    
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
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
          for($j=0;$j<count($publicc);$j++){
              
            if($publicc[$j]==1){
                
              $count++;
              array_push($data, [
                  'client' => $client,
                  'dim' => $dim[$j],
                  'fcat' => $fcat,
                  'title' => $title,
              ]);
            }
          }
        }
        $limit = 6;
        $start = ($page - 1) * $limit;
        $end = $page * $limit;
        $end = count($data) > $end ? $end : count($data);
        for($i=$start; $i<$end; $i++){
            $break=explode("x", $data[$i]['dim']);
            ?>
            <div class="t2" style="width:300px;height:250px;position:relative;display:inline-block;overflow:hidden;margin:56px;border-radius:5px;box-shadow: 0 0 5px #063970;left: 10%;">
                <a target="_blank" href="https://publisherplex.io/selfserve/library/blog.php?param=<?php echo $data[$i]['client'] ?>,<?php echo $data[$i]['dim'] ?>,<?php echo $data[$i]['fcat'] ?>" style="cursor: pointer;">
                    <div class="abc" style="width:300px;height:250px;position:absolute;">
                        <span class="xx"><?php echo $data[$i]['title'] ?><br><?php echo $data[$i]['client'] ?></span>
                         <span class="yy">Click to view Live Experience &rarr;</span>
                    </div>
                    <iframe style="pointer-events: none;" src="https://ad.hockeycurve.com/ad.php?zoneid=<?php echo $data[$i]['dim'] ?>&client=<?php echo $data[$i]['client'] ?>&fcat=<?php echo $data[$i]['fcat'] ?>&optout=false&hct=master" scrolling="yes" frameborder="0" width="<?php echo $break[0] ?>" height="<?php echo $break[1] ?>"></iframe>
                    
                </a>
            </div>
            <?php
        }
      }
    ?>
 
  </div>

   <div id="pagination">
        <ul id="pages"></ul>
    </div>  
    
    
<form method="POST" style="display: flex;justify-content: center;top:20px">
    <div class="input-box" style="display: flex; align-items: center;top: -60px;position: absolute;">
        <select name="template" id="templte" style="border:2px solid #24b2be;border-radius:3px;height:39px;flex: 1;" class="templte" multiple>
            <option value="">Select Option</option>
            <?php
                $sqlc = "SELECT DISTINCT template FROM `campaign_info` WHERE `public` LIKE '%1%'  ORDER BY id DESC";
                $resultc = $connectDB->query($sqlc);
                if ($resultc->num_rows > 0) {
                    // output data of each row
                    while($rowc = $resultc->fetch_assoc()) {
                        ?>
               <option value="<?php echo $rowc['template'] ?>" ><?php echo $rowc['template'] ?></option>
                        <?php
                    }
                }
            ?>
        </select>
        <div class="input-box" style="margin-left: 10px;">
            <button type="submit" name="submit" onclick="search" style="width: 100px; height: 38px; font-size: 20px;">Result</button>
        </div>
    </div>
</form>

</div>
<script>
    const data = <?= $count; ?>;
    const totalPages = Math.ceil(data/6);
    const page = <?= $page; ?>;
    const p = document.getElementById("pagination");
    const pages = document.getElementById("pages");
    
    for(let i=1; i<=totalPages; i++){
        let pageNo = `<li><a href="?page=${i}">${i}</a></li>`;
        pages.innerHTML += pageNo;
    }
    
    const links = p.querySelectorAll('a');
    for(let i=0; i<links.length; i++){
        if(links[i].innerText == page){
            links[i].classList.add('current');
        } else {
            links[i].classList.remove('current');
        }
    }
</script>
<script>
    let $select = $('select').multiselect({
  enableFiltering: true,
  includeFilterClearBtn: true,
  enableCaseInsensitiveFiltering: true
  
});
</script>


</body>
