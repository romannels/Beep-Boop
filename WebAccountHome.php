<!DOCTYPE html>
<!---------------------------------Home Page----------------------------------->

<html>
   <head>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link href="bootstrap.css" rel="stylesheet" media="screen">
       <script src="jquery.js" type="text/javascript"></script>
       <script src="bootstrap.js" type="text/javascript"></script> 
       <title>Voss Web Accounts</title>
       <link rel="icon" type="image/ico" href="favicon.ico">
   </head>

   <body>
       <!--Navbar -->
     <div class="navbar">
        <div class="navbar-inner" >
            <div class="container">
           <a class="brand" >Voss Web Accounts</a>
           <ul class="nav">
               <li class="active"><a href="WebAccountHome.php">Home</a></li>                
               <li><a href="NewCustomer.php">New Account</a></li>
               <li><a href="http://reports.vosslighting.com/website_tools/accounts.asp">Current Accounts</a></li>
               <li><a href="http://reports.vosslighting.com/website_tools/shopping_lists.asp">Shopping Lists</a></li>
           </ul>
          </div> 
        </div>
     </div>       
       
       <!--Search -->
     <div class="container-fluid">
      <a>Search by Customer Number</a>
      <form class="navbar-form navbar-left" role="search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       <div class="form-group">
           <input type="text" name="search" class="form-control" placeholder="Search" value="<?php if(isset($_POST['search'])) echo $_POST['search']; ?>" >       
           <button type="submit" name="button" id="button" class="btn btn-default">Submit</button>
           <input type="hidden" name="submitted" id="submitted" value="true">
       </div>
      </form>
     
       <!-- Usernames -->
     <div class="panel panel-default">          
       <table class='table table-hover'>  
         
         <?php
         require_once 'search.php';

         if(isset($_POST['submitted']) && isset($_POST['search'])){
         $findit = new search($_POST['submitted'], $_POST['search']);
         $findit->filterInput();
         $findit->DBCheck();
         }
         ?>
       </table>    
     </div>    
       </div>
   </body>
</html>
