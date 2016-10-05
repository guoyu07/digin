<style>
    .twocolumns {
        padding:10px;
        width:100%;
        -moz-column-count: 3;
        -moz-column-gap: 10px;
        -webkit-column-count:3;
        -webkit-column-gap: 10px;
        column-count: 3;
        column-gap: 10px;
        margin-top: 20px;
    }
    .lvl a{
        color: #808080;
        text-decoration:none;
    }


    .lvl
    {
        padding:0;
        padding-left:2px;
        list-style-type: none;
    }
    .lvl_1
    {

        position:relative;
        line-height:1.5em;
        padding-left: 0px;
        display:block;
        list-style-type: none;

    }
    .lvl_1 ul{
        padding-left:2px;

        list-style-type: none;
        //overflow:hidden;


    }
    .lvl_2
    {

        position:relative;
        line-height:1.5em;
        padding-left: 0px;
        display:block;
        list-style-type: none;

    }
    .lvl_2 ul{
        padding-left:4px;
        list-style-type: none;
    }
    .lvl_3
    {

        position:relative;
        line-height:1.5em;
        padding-left: 0px;
        display:block;
        list-style-type: none;

    }
    .lvl_3 ul{
        padding-left:4px;
        list-style-type: none;
    }



    /*.lvl_1  { width:33.33%;}*/
    .lvl_1:hover
    {
        background-color:#c0c0c0;
        color:#fefefe;
    }
    .lvl_1 ul:hover
    {
        background-color:#c0c0c0;

    }
    .lvl_1:hover a{
        color: #eee;

    }
    .lvl_1 ul:hover + li a
    {

        color:#fefefe;
    }
    .lvl_2 ul:hover + li a
    {

        color:#fefefe;
    }
    /*.lvl_1 ul li a:hover
    {
        color:#fefefe;
    }*/
    .lvl_2:hover
    {
        background-color:#b0b0b0;

    } 
    .lvl_2 ul:hover
    {
        background-color:#b0b0b0;
    }

    .lvl_3:hover
    {
        background-color:#a0a0a0;
    }
    .lvl_3 ul:hover
    {
        background-color:#a0a0a0;
    }
    .lvl_4:hover
    {
        background-color:#909090;
    }
    .lvl_4 ul:hover
    {
        background-color:#909090;
    }
    .lvl_5:hover
    {
        background-color:#808080;
    }
    .lvl_5 ul:hover
    {
        background-color:#808080;
    }
    .lvl_6:hover
    {
        background-color:#707070;
    }
    .lvl_6 ul:hover
    {
        background-color:#707070;
    }


</style>
<div class="container sectionWrap">
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">All Products</li>
    </ul>

    <!--        /*Search input box for category search*/-->
    <div>
        <form method="GET" id="srch" action="index.php">
            <div class="accordion-group">
              <div class="row">
                <div class="col-md-5 col-sm-3 col-xs-12">
                    <input type="hidden" name="r" value="site/viewallproductsearch">
                    <input type="text" name="search" placeholder="Search" class="form-control src" required value="<?php if (isset($_GET['search'])) {
    echo $_GET['search'];
} ?>">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 mtt10">
               		 <input type="submit" value="Search" class="btn btn-danger">
              		 <a href="index.php?r=site/viewallproducts" class="btn btn-danger">Clear</a>
                </div>
            	</div>
            </div>
        </form>  
    </div>
    <div>
        <?php
        if (isset($search) && $search != "") {
            $srch = $_GET['search'];
            echo '
          <li class="lvl_1"><b>' . $srch;
            foreach ($search as $s) {

                echo '
          </b><ul><li class="lvl_2">' . '<a href="index.php?r=productdetail/productdetails&catid=' . $s['id'] . '">' . '&nbsp;' . $s['path'] . '&nbsp;&nbsp;' . $s['name'] . '</li></ul></li>';
            }
        } else {
            ?>	
        </div>    
         
          <div class="twocolumns">
	            <?php
	            echo $menuhtml;
	            ?>
            </div>
        	
    <?php } ?>
</div>
