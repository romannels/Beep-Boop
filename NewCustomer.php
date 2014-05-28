<?php
/**
 * NewCustomer.php
 * Creates and updates website customer accounts
 * @author roman.nelson
 */
class NewCustomer {
    /*New Customer class constructs a new customer and holds all pertinent info
     * 
     */
   public $tried; //string/boolean describing if page was submitted, form validation
   public $user; // describes form state, either as a user , or a shipto
   public $custno; // customer number
   public $username; // customer username
   public $email_address; //customer email address
   public $contact_name; // customer contact name
   public $pswd; // customer password
   public $pswdremind; // customer password reminder question
   public $pswdans; // customer password reminder answer
   public $pnone; // phone number area code 3 digit
   public $pntwo; // phone number prefix 3 digit
   public $pnthree; // phone number suffix 4 digit
   public $ext; // phone number extension
                  
    function __Construct($tried, $user, $custno,$username, $email_address, $contact_name, $pswd,
            $pswdremind, $pswdans, $pnone, $pntwo, $pnthree, $ext){
            // constructer for importing variables from the create account form
            $this->tried = $tried;
            $this->user = $user;
            $this->custno = $custno;
            $this->username = $username;
            $this->email_address = $email_address;
            $this->contact_name = $contact_name;
            $this->pswd = $pswd;
            $this->pswdremind = $pswdremind;
            $this->pswdans = $pswdans;
            $this->pnone = $pnone;
            $this->pntwo = $pntwo;
            $this->pnthree = $pnthree;
            $this->ext = $ext;
    }
    
    function FilterInput(){
        //Future filter to protect database
        $tried = ($this->tried == 'true'); // boolean, sent after form is submitted
        
        if($tried) {
            $validuser = self::ValidUser(); // boolean for valid template selection           
            if(!$validuser) {
                // alerts customer to invalid template selection
                die("<strong><p class='text-error'>Please select a User Template.</p></strong><br />");
            }
            
            // if form is submitted all pertinent fields are cheecked
        $validated = (!empty($this->user) && !empty($this->custno) && 
                !empty($this->username) && !empty($this->email_address)
                && !empty($this->contact_name) && !empty($this->pswd) &&
                !empty($this->pswdremind) && !empty($this->pswdremind) &&
                !empty($this->pswdans)); // defines a page with all entries filled
        
            if(!$validated) { 
                die("<strong><p class='text-error'>yo bro, whatchu tryin to pull?</p></strong><br />");
            } //kills program
            

            $validcust = self::ValidCustNum(); // boolean for valid customer numbers
            $validphone = self::ValidPhoneNumber(); // boolean for valid phone numbers
            $validemail = self::ValidEmail(); // boolean for valid email
           

            
            if(!$validcust) {
                // alerts customer to invalid field entry
                echo "<strong><p class='text-error'>Please enter a valid customer number.</p></strong><br />";
            } 
            
            if(!$validphone) {
                // alerts customer to invalid field entry
                echo "<strong><p class='text-error'>please enter a valid phone number.</p><strong><br />";
            }
            
            if(!$validemail) {
                // alerts customer to invalid field entry
                echo "<strong><p class='text-error'>Please enter a valid email address.</p></strong><br />";
            }
            
            if(!($validcust && $validphone && $validemail)) {
                die();
            } // kills program
            
            if($tried && $validated && $validcust && $validphone &&
                    $validemail) {
                return true;
            } //gtg!
        }
    }
    
    function IsNumber($isitanumber) {
       //determines if input parameter is a postive integer
        return $valid = strspn($isitanumber, "1234567890") == strlen($isitanumber); 
        // returns a boolean true if input is a positive integer, or false if it is not
    }
    
    function ValidUser() {
        if($this->user == "NULL"){
            return false;
        }
        else {
            return true;
        }
    }
    
    function ValidCustNum(){
        //returns boolean true if customer number is a positive integer, or false if it is not
        $number = self::IsNumber($this->custno);
        if(!$number){           
            return false;
        }
        else {
            return true;
        }
    }
    
    function ValidPhoneNumber() {
        // returns true if phone number is a positive integer, or false if it is not
        $numberone = self::IsNumber($this->pnone);
        $numbertwo = self::IsNumber($this->pntwo);
        $numberthree = self::IsNumber($this->pnthree);  
        if(!empty($this->ext)) {
            $numberfour = self::IsNumber($this->ext);
             if(!($numberfour && $numberthree && $numbertwo && $numberone)) {
                 return false;    
             }       
             else {
                 return true;
             }
        }
        
        else {
              if(!($numberthree && $numbertwo && $numberone)) {
                 return false;
             }  
             else {
                 return true;
             }
        }
    }
    
    function ValidEmail() {
        //returns true if email address is a well formed email address (@ and .)
        $email = $this->email_address;
        if (!preg_match('/@.+\..+$/',$email)) {
            return false;
        }
        else {
            return true;
        }
    }
    
}

class NewShipTo extends  NewCustomer {
    /* New ship to class to extend the new customer class to work with customers
     * that have bill tos that are different than the ship to, or have multiple
     * ship tos
     */
   
   public $shipto; // customer ship to number
    
    function __Construct($tried, $shipto, $user, $custno, $username, $email_address, $contact_name, $pswd,
            $pswdremind, $pswdans, $pnone, $pntwo, $pnthree, $ext) {

        parent::__construct($tried, $user, $custno,$username, $email_address, $contact_name, $pswd,
            $pswdremind, $pswdans, $pnone, $pntwo, $pnthree, $ext); // calls parent constructor
                
        $this->shipto = $shipto; //
    }
    
     function FilterInput(){
    
        $tried = ($this->tried == 'true');
        
        if($tried) {
            // if form is submitted all pertinent fields are cheecked
        $validated = (!empty($this->shipto) && !empty($this->user) && !empty($this->custno) && 
                !empty($this->username) && !empty($this->email_address)
                && !empty($this->contact_name) && !empty($this->pswd) &&
                !empty($this->pswdremind) && !empty($this->pswdremind) &&
                !empty($this->pswdans)); // defines a page with all entries filled
        
            if(!$validated) { 
                die("<strong><p class='text-error'>yo bro, whatchu tryin to pull?</p></strong><br />"); //throws this up if all fields are not populated and kills program
            }
            
            $validcust = self::ValidCustNum(); // boolean for valid customer numbers
            $validphone = self::ValidPhoneNumber(); // boolean for valid phone numbers
            $validemail = self::ValidEmail(); // boolean for valid email
            if(!$validcust) {
                // alerts customer to invalid field entry
                echo "<strong><p class='text-error'>Please enter a valid customer number.</p></strong><br />";
            } 
            
            if(!$validphone) {
                // alerts customer to invalid field entry
                echo "<strong><p class='text-error'>please enter a valid phone number.</p></strong><br />";
            }
            
            if(!$validemail) {
                // alerts customer to invalid field entry
                echo "<strong><p class='text-error'>Please enter a valid email address.</p></strong><br />";
            }
            
            if(!($validcust && $validphone && $validemail)) {
                die();
            } // kills program
            
            if($tried && $validated && $validcust && $validphone && $validemail) {
                return;
            } //gtg!
        }
    }
}

class DBInteract {
    /*DBInteract class implements several functions to interface between the 
     * database and the web form
     */
    protected $db; // database handle
    protected $newcustomer; //NewCustomer object

    
   public function __Construct(NewCustomer $newcustomer) {
        $this->newcustomer = $newcustomer; // assign object to get the info for the new account from the user
        $this->db = self::newConnection(); //Connect to database
    }
    
 
 private static function newConnection() {
//Static function to connect to database
     
    $server = "xxx.xxx.xxx.xxx"; // server address
    $database = "TEST"; // database name
    $uid = "TEST"; // user id
    $pwd = "TEST";// user password          
     
     try{
        $db = new PDO("odbc:Driver={SQL Native Client};Server=$server;Database=$database; Uid=$uid;Pwd=$pwd;"); //connects to database and assigns it to the handle
     }     
     catch (PDOException $e) {
         die("<p class='text-error'>Could not connect to server</p>") . $e; // if it can't connect it throws this up
     }   
     
     return $db;
 }
 
 private function closeConnection($db) {
     // closes a database connnection that is passed into it 
     $db = null;
 }
 
 function DBCheck() {
        // checks customer username against usernames in database
     
     try{
        //$statement = $this->db->prepare(" SELECT * FROM Information_schema.Tables");
        $statement = $this->db->prepare(" SELECT acc_usr_name FROM account");// WHERE TABLE_NAME = " . $this->newcustomer->username); //$statement = $db->prepare(" SELECT * FROM Information_schema.Tables");
        $statement->execute(); //prepared statements to select all usernames from database

        $result = $statement->fetchAll(PDO::FETCH_COLUMN); // fetches usernames and inserts them into the $result array
 
     }
     catch (PDOException $e) {
         die("<p class='text-error'>Connection Error</p>") . $e;         // if it can't process the database request it throws this up
     }
     
       foreach($result as $username) {
           //loops through the $result array 
            if ($username == $this->newcustomer->username){
            //compares the usernames in the database to the requested username
            die( "<p class='text-info'>The username " . $username . " is already in use</p>");
            //throws this up if it finds a match and then kills the program
        }
       } 
       echo "<p class='text-success'>Customer added.</p>"; 
}
 
 function DoppleGanger($copy) {
     /*function to notify customer if username already exists (move into DBCheck)
      * 
      */
     if ($copy) {
         return "Bro you already exist";
     }

 }

 function DBUpdate(){
     /*Function to transfer form data to database
      * 
      */
 

    $user = $this->newcustomer->user;   
    if ($user == "WEB"){
    }
    elseif($user == "SHIP"){
        $user = 4;
    }
        
    $custno = $this->newcustomer->custno;
    $username = $this->newcustomer->username;
    $email_address = $this->newcustomer->email_address;
    $contact_name = $this->newcustomer->contact_name;
    $pswd = $this->newcustomer->pswd;
    $pswdremind =$this->newcustomer->pswdremind;
    $pswdans = $this->newcustomer->pswdans;
    $pnone = $this->newcustomer->pnone;
    $pntwo = $this->newcustomer->pntwo;
    $pnthree = $this->newcustomer->pnthree;
    $ext =$this->newcustomer->ext;
    $statement = $this->db->prepare(" SELECT acc_id FROM account");// WHERE TABLE_NAME = " . $this->newcustomer->username); //$statement = $db->prepare(" SELECT * FROM Information_schema.Tables");   
    $statement->execute(); //prepared statements to select all usernames from database
    $result = $statement->fetchAll(PDO::FETCH_COLUMN) ; // fetches account id's and inserts them into the $result array
    $newid = max($result) + 1;

 if ($user == "WEB") {
     $shipto = NULL;
 }
 else {
     $shipto = $this->newcustomer->shipto;
 }
 
 try{    
     $statement = $this->db->prepare("INSERT INTO account (acc_id, env_id, cmp_id, cgp_id, grp_id, acc_type, acc_cust_name, acc_cust_num, acc_cust_shipto,
        acc_status, acc_failedattempts,
        acc_adminlock, acc_guest_flg, acc_usr_name, acc_usr_password, acc_usr_pw_question, 
        acc_usr_pw_answer, acc_dft_whs_id, acc_list_price)" . " VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

     $statement->execute(array($newid,2,2,0,0,1,$contact_name,
          $custno, $shipto, 4, 0, 0, 0, $username,
          $pswd, $pswdremind, $pswdans, 0, 0));           
     
     $account_options_array = array($newid,'accountAllow',NULL,$newid,'accountReceivable','y',$newid,'addressMod','s',
              $newid,'altCarrier','d',$newid,'attempts',NULL,$newid,'browseView','d',
              $newid,'calcAvailMeth','a',$newid,'catalogName',2,$newid,'cod',NULL,$newid,'creditAllow',NULL,
              $newid,'creditReq','d',$newid,'display_cin','d',$newid,'display_oum','d',$newid,'dispPickuplocation','d',
              $newid,'emailDoc',2,$newid,'endOrderMessage','d',$newid,'endOrderMessageText',NULL,
              $newid,'freightCalc',0,$newid,'hide_in','d',$newid,'holdCode',NULL,$newid,'homePage','d',
              $newid,'inquiryOnly','n',$newid,'maxOpenInvoices',1000,$newid,'maxPaidInvoices',1000,
              $newid,'openDaysBackDateAge',7,$newid,'openDaysBackDateInv',7,$newid,'orderConfDoc',1,
              $newid,'orderConfirm','d',$newid,'orderEntry','y',$newid,'paidDaysBackDateAge',7,
              $newid,'pl_group_id',10,$newid,'poReqFl',0,$newid,'pwChange','y',$newid,'quantAvail','n',
              $newid,'quoteEntry','n',$newid,'quoteRelease','y',$newid,'reviewCode',NULL,
              $newid,'shipReqFl',0,$newid,'showQuantIfAvail','n',$newid,'soldToMod','n',
              $newid,'statusDays',31,$newid,'stockAmount','i');
      
     
     $statement_two = $this->db->prepare("INSERT INTO accountoptions "
             . "(acc_id, acc_opt_type, acc_opt_value)"
             . " VALUES (?,?,?)");

     $array_size = sizeof($account_options_array) / 3 - 1;
     for ($i=0; $i<=$array_size; $i++) {
         $acc_id = 3 * $i;
         $acc_opt_type = 3 * $i + 1;
         $acc_opt_value = 3 * $i + 2;
         
         $statement_two->bindParam(1, $account_options_array[$acc_id],PDO::PARAM_INT);
         $statement_two->bindParam(2,$account_options_array[$acc_opt_type],PDO::PARAM_STR);
         $statement_two->bindParam(3,$account_options_array[$acc_opt_value],PDO::PARAM_STR);
         $statement_two->execute();         
     }


     
     
/*      
     $statement = $this->db->prepare("INSERT INTO account (acc_id, env_id, cmp_id, 
        cmp_id, grp_id, acc_type, acc_cust_name, acc_cust_num, acc_cust_shipto,
        acc_status, acc_firstinvalidlogin_dte, acc_failedattempts,
        acc_adminlock,acc_adminlock_dte, acc_adminlockuntil_dte, acc_guest_flg,
        acc_dte_created, acc_dte_updated, acc_usr_name, acc_usr_password,
        acc_usr_pw_question, acc_usr_pw_answer, acc_cust_cls, acc_dft_whs_id,
        acc_list_price)" . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

     $statement->execute(array($newid, '', '', '', '', '', $contact_name,
          $custno, $shipto, 4, '', 0, 0, '', '', 0, '', '', $username,
          $pswd, $pswdremind, $pswdans, '', 0, 0));  
 */
 }
 catch (PDOException $e) {
     die("Database write error" . $e);
 }
 }
 
 public function __Destruct(){
     //try{
        self::closeConnection($this->db);
    // }
//     catch(PDOException $e) {
 //        die("Database connection error" . $e);
  //   }
 }
} 

class Email {
    public $to;
    public $from;
    public $CC;
    public $custemailaddress;
    public $password;
    public $salesmanemail;
    public $choosesalesman;
    public $choosecustomer;
    public $custname;
    
    
    function __Construct($to, $from = "sc@vosslighting.com", $CC, $custemailaddress = NULL, $password, $salesmanemail, $choosesalesman, $choosecustomer, $custname){
        $this->to = $to;
        $this->from = $from;
        $this->CC = $CC; 
        $this->custemailaddress = $custemailaddress;
        $this->password = $password;
        $this->salesmanemail = $salesmanemail;
        $this->choosesalesman = $choosesalesman;
        $this->choosecustomer = $choosecustomer;
        $this->custname;
    }
    
    function sendit(){
        $message = "You may forward the login information below to your customer at your convenience. You may wish to review pricing and any shopping lists before sending this information.\n";
        $message = "Thank you ";
        $message .= $this->custname;
        $message .= " for requesting a login to our website.  Below is your login information.  We have generated a shopping list for you based off your order history.  Please let your salesman know if you have any questions or further requests. Thank you. 
            
Login: ";
        $message .= $this->custemailaddress;
        $message .= "Password: ";
        $message .= $this->password;
        $message .= " (your password may be changed by navigating to your account settings once you are logged in)
            


        ";
        $message .= "Support Center | Voss Lighting";
        $message .= "402-328-2292 | www.vosslighting.com";
        $message .= wordwrap($message, 70, "\r\n");
        $subject = "TEST";
        //$subject = "New Voss Lighting Web Account";
        if($this->choosesalesman == 1){
            mail($this->salesmanemail,$subject, $message, "From: sc@vosslighting.com");
        }
        
        if($this->choosecustomer == 1){
            mail($this->custemailaddress,$subject, $message, "From: sc@vosslighting.com");
        }
    }
            
}
?>
