
   <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $userPictureURL; ?>" id="imagePreview3" style="height: 45px; width: 45px; " class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $row['name']; ?></p>
          
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
       
       <li class="<?php if ($current_page=="index1") {echo "active"; }?>">
          <a href="index1.php">
            <i class="fa fa-dashboard" style="padding-left: 4px"></i> <span>Dashboard</span>
          </a>
        </li>        


<!-- 
           <li class="<?php if ($current_page == "accounts") {echo "active"; }?> treeview menu-open">
          <a href="#">
            <i class="fa fa-fw fa-calculator"></i>
            <span>Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>

          <ul class="treeview-menu" style="display: block;">
            <li class="<?php if ($current_page1=="accounts1") {echo "active"; }?>"><a href="accounts.php"><i class="fa fa-fw fa-users"></i> Accounts</a></li>
            <li class="<?php if ($current_page1=="acctype") {echo "active"; }?>"><a href="acc type.php"><i class="fa fa-fw fa-user-plus"></i> Add/View Account Type</a></li>
            <li class="<?php if ($current_page1=="Fixed Assets") {echo "active"; }?>"><a href="fd.php"><i class="glyphicon glyphicon-fire"></i>Fixed Assets</a></li>
          </ul>
        </li> 
 -->
     

        <li class="<?php if ($current_page=="manage-clients") {echo "active"; }?>">
          <a href="manage-clients.php">
            <i class="fa fa-fw fa-shield"></i> <span>Manage Clients</span>
                      </a>
        </li>

        <li class="<?php if ($current_page=="manage-products") {echo "active"; }?>">
          <a href="manage-products.php">
            <i  class="fa fa-fw fa-gears"></i> <span>Products</span>
                      </a>
        </li>

         <li class="<?php if ($current_page=="manage-suppliers") {echo "active"; }?>">
          <a href="manage-suppliers.php">
            <i class="fa fa-fw fa-qrcode"></i> <span>Supplier</span>
           
          </a>
        </li>




        <li class="<?php if ($current_page=="manage-purinv") {echo "active"; }?>">
          <a href="genpurchaseinv.php">
            <i class="fa fa-fw fa-opencart"></i> <span>Add Purchase</span>
           
          </a>
        </li>

         <li class="<?php if ($current_page=="manage-purlist") {echo "active"; }?>">
          <a href="purlist.php">
            <i class="fa fa-fw fa-list"></i> <span>Purchase List</span>
           
          </a>
        </li>

        <li class="<?php if ($current_page=="quick quotation") {echo "active"; }?>">
          <a href="quickquotepg.php">
            <i class="fa fa-fw fa-opencart"></i><span style="padding-left: 2px;">Quick Quotation</span>
           
          </a>
        </li>



         <li class="<?php if ($current_page=="gen-q") {echo "active"; }?>">
          <a href="gen-q.php">
            <i class="fas fa-search-dollar"></i> <span style="padding-left: 4px; ">Gen. Quotation</span>
           
          </a>
        </li>

         <li class="<?php if ($current_page=="manage-qlist") {echo "active"; }?>">
          <a href="q-list.php">
            <i class="fa fa-fw fa-list"></i><span style="padding-left: 2px;">Quotation List</span>
           
          </a>
        </li>

        <li class="">
          <a href="https://web.whatsapp.com/" target="_blank">
            <i class="fa fa-whatsapp"></i><span style="padding-left: 2px;">Whatsapp</span>
           
          </a>
        </li>

        <!--  <li class="<?php if ($current_page=="email") {echo "active"; }?>">
          <a href="email.php">
            <i class="fa fa-envelope"></i><span style="padding-left: 2px;">Festival Email</span>
           
          </a>
        </li>
 -->
         

        <li class="<?php if ($current_page == "manage-invoice") {echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-fw fa-cloud-download"></i>
            <span>Manage Invoice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if ($current_page1=="manage-prolist") {echo "active"; }?>"><a href="proforma-list.php"><i class="glyphicon glyphicon-floppy-saved"></i> Proforma Invoice List</a></li>
            <li class="<?php if ($current_page1=="manage-invlist") {echo "active"; }?>"><a href="inv-list.php"><i class="glyphicon glyphicon-barcode"></i> Tax Invoice List</a></li>
           
          </ul>
        </li>




<!--         <li class="<?php if ($current_page=="manage-paidhistory") {echo "active"; }?>">
          <a href="paid-his.php">
            <i class="fa fa-fw fa-rupee"></i> <span>Transaction </span>
            
          </a>
        </li> -->

        <li class="<?php if ($current_page=="generate-inv") {echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-fw fa-print"></i> <span>Generate </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: block;">
            <li class="<?php if ($current_page1=="gen-pro") {echo "active"; }?>"><a href="gen-pro.php"><i class="glyphicon glyphicon-floppy-saved"></i>Gen. Proforma Invoice </a></li>
            <li class="<?php if ($current_page1=="gen-inv") {echo "active"; }?>"><a href="gen-inv.php">
            <i class="glyphicon glyphicon-barcode"></i>Gen. Tax Invoice</a></li>
          
          </ul>


          




           <li class="<?php if ($current_page == "purchase report") {echo "active"; }?> treeview menu-open">
          <a href="#">
            <i class="fa fa-fw fa-download"></i>
            <span>Purchase Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>

          <ul class="treeview-menu" style="display: block;">

          <li class="<?php if ($current_page1=="purchase item report") {echo "active"; }?>"><a href="pitem-report.php">
            <i class="fa fa-fw fa-gears"></i> Purchase Item Report</a></li>

            <li class="<?php if ($current_page1=="purchase report") {echo "active"; }?>"><a href="purchase-report.php">
            <i class="fa fa-fw fa-opencart"></i> Purchase Report</a></li>

          </ul>
        </li> 



          <li class="<?php if ($current_page == "sale report") {echo "active"; }?> treeview menu-open">
          <a href="#">
            <i class="fa fa-fw fa-download"></i>
            <span>Sales Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>

          <ul class="treeview-menu" style="display: block;">        
           <li class="<?php if ($current_page1=="sale item report") {echo "active"; }?>"><a href="item-report.php">
            <i class="fa fa-fw fa-gears"></i> Sale Item Report</a></li>

            <li class="<?php if ($current_page1=="sale report") {echo "active"; }?>"><a href="sale report.php">
            <i class="fa fa-fw fa-line-chart"></i> Sales Report</a></li>       
            
          </ul>
        </li> 

        
        

          <li class="<?php if ($current_page=="setting") {echo "active"; }?>">
          <a href="profile.php">
            <i class="fa fa-fw fa-gear" ></i> <span>Settings</span>
           
          </a>
        </li>

        <li>
          <a href="logout.php">
            <i class="fa fa-fw fa-power-off" ></i> <span>Logout</span>
            
          </a>
        </li>

      </ul>
      
    </section>
    <!-- /.sidebar -->
  </aside>