<?php

namespace App\Helpers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use Auth;
use Config;
use View;
use Input;
use session;
use Crypt;
use Hash;
use Menu;
use Html;
use Illuminate\Support\Str;
use App\User;
use Phoenix\EloquentMeta\MetaTrait; 
use Illuminate\Support\Facades\Lang;
use App\CorporateProfile;
use Validator; 
use App\Position;
use App\InterviewRating;
use App\Interview;
use App\Criteria;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\RatingFeedback;
use PHPMailerAutoload;
use PHPMailer; 

class Helper {

    /**
     * function used to check stock in kit
     *
     * @param = null
     */
    
    public function generateRandomString($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

         return $key;
    } 
/* @method : createCompanyGroup
    * @param : email,user_id
    * Response :  string
    * Return : company name
    */
    
/* @method : getCorporateGroupName
    * @param : email
    * Response :  string
    * Return : company name
    */
    public function getCorporateGroupName($email=null)
    {
        $fps =  strripos($email,"@");
        $lps =  strpos(substr($email,$fps),".");
        $company_name = substr($email,$fps+1,$lps-1);
        return  $company_name;       
    } 
/* @method : getCompanyUrl
    * @param : email
    * Response :  string
    * Return : company URL
    */
    public function getCompanyUrl($email=null)
    {   
        $fps =  strripos($email,"@");
        $lps =  strpos(substr($email,$fps),".");
        $company_url = substr($email,$fps+1);
        return  $company_url;       
    }

 
/* @method : isUserExist
    * @param : user_id
    * Response : number
    * Return : count
    */
    static public function isUserExist($user_id=null)
    {
        $user = User::where('id',$user_id)->count(); 
        return $user;
    }
 
/* @method : getpassword
    * @param : email
    * Response :  
    * Return : true or false
    */
    
    public static function getPassword(){
        $password = "";
        $user = Auth::user();
        if(isset($user)){
            $password = Auth::user()->Password;
        }
        return $password;
    }
/* @method : check mobile number
    * @param : mobile_number
    * Response :  
    * Return : true or false
    */     
   
    
    public static function FormatPhoneNumber($number){
        return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $number). "\n";
    }
 
 
    
/* @method : send Mail
    * @param : email
    * Response :  
    * Return : true or false
    */
     
     public  function sendMailFrontEnd($email_content, $template)
    {        
        $email_content['verification_token'] =  Hash::make($email_content['receipent_email']);
        $email_content['email'] = isset($email_content['receipent_email'])?$email_content['receipent_email']:''; 
       //dd($email_content);
        $mail = new PHPMailer;
        $html = view::make('emails.'.$template,['content' => $email_content]);
        $html = $html->render(); 

        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
             

            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Host       = getenv('MAIL_HOST'); // sets the SMTP server
            $mail->Port       = getenv('MAIL_PORT');
            $mail->SMTPSecure = 'false';                 // set the SMTP port for the GMAIL server
            $mail->Username   = getenv('MAIL_USERNAME'); // SMTP account username
            $mail->Password   = getenv('MAIL_PASSWORD');

            $mail->setFrom(getenv('MAIL_USERNAME'), "Admin");
            $mail->Subject = $email_content['subject'];
            $mail->MsgHTML($html);
            $mail->addAddress($email_content['receipent_email'], "Admin");
            $mail->addAddress("kroy@mailinator.com","Admin");

            //$mail->addAttachment(‘/home/kundan/Desktop/abc.doc’, ‘abc.doc’); // Optional name
            $mail->SMTPOptions= array(
                    'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->send();
            //echo "success";
            } catch (phpmailerException $e) {
             
            } catch (Exception $e) {
             
        } 
    } 
  /* @method : send Mail
    * @param : email
    * Response :  
    * Return : true or false
    */
    public  function sendMail($email_content, $template)
    {        
        
        $mail       = new PHPMailer;
        $html       = view::make('emails.'.$template,['content' => $email_content]);
        $html       = $html->render(); 
        $subject    = $email_content['subject'];

        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
             

           $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Host       = getenv('MAIL_HOST'); // sets the SMTP server
            $mail->Port       = getenv('MAIL_PORT');
            $mail->SMTPSecure = 'false';                 // set the SMTP port for the GMAIL server
            $mail->Username   = getenv('MAIL_USERNAME'); // SMTP account username
            $mail->Password   = getenv('MAIL_PASSWORD');

            $mail->setFrom(getenv('MAIL_USERNAME'), $email_content['from']);
            $mail->Subject = $email_content['subject'];
            $mail->MsgHTML($html);
            $mail->addAddress($email_content['receipent_email'], $email_content['first_name']);
            
           // $mail->addReplyTo("kroy.iips@mailinator.com","admin");
             
            if($email_content['addBCC']){
                $mail->addBCC($email_content['addBCC']);
            }

            //$mail->addAttachment(‘/home/kundan/Desktop/abc.doc’, ‘abc.doc’); // Optional name
            $mail->SMTPOptions= array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );

            $mail->send();
            //echo "success";
            } catch (phpmailerException $e) {
             
            } catch (Exception $e) {
             
            }
    }

     public  function sendMailToAdmin($email_content, $template)
    {        
        
        $mail       = new PHPMailer;
        $html       = view::make('emails.'.$template,['content' => $email_content]);
        $html       = $html->render(); 
        $subject    = $email_content['subject'];

        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
             

           $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Host       = getenv('MAIL_HOST'); // sets the SMTP server
            $mail->Port       = getenv('MAIL_PORT');
            $mail->SMTPSecure = 'false';                 // set the SMTP port for the GMAIL server
            $mail->Username   = getenv('MAIL_USERNAME'); // SMTP account username
            $mail->Password   = getenv('MAIL_PASSWORD');

            $mail->setFrom(getenv('MAIL_USERNAME'), $email_content['from']);
            $mail->Subject = $email_content['subject'];
            $mail->MsgHTML($html);
            $mail->addAddress($email_content['receipent_email'], $email_content['first_name']);
            
           // $mail->addReplyTo("kroy.iips@mailinator.com","admin");
            

            //$mail->addAttachment(‘/home/kundan/Desktop/abc.doc’, ‘abc.doc’); // Optional name
            $mail->SMTPOptions= array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );

            $mail->send();
            //echo "success";
            } catch (phpmailerException $e) {
             
            } catch (Exception $e) {
             
            }
    }
    /* @method : send Mail
    * @param : email
    * Response :  
    * Return : true or false
    */
    public  function sendNotificationMail($email_content, $template)
    {        
        
        return  Mail::send('emails.'.$template, array('content' => $email_content), function($message) use($email_content)
          {
            $name = $_SERVER['SERVER_NAME'];
            $message->from('no-reply@abc.com',$name);  
            $message->to($email_content['receipent_email'])->subject($email_content['subject']);
            
          });
    }

    public static function send_ios_notification($deviceToken,$message)
    {
        // var_dump($notification_id, $owner_id, $member_id); exit;
        
        // $deviceToken = '9e88aba24a3981635b2620f7a9762fb97a10cbb694f37e93b212035138872bd6';
        
        // Put your private key's passphrase here:
        $passphrase = 'pushchat';
        
        // Put your alert message here:
        // $message = 'Myredfolder notification!';
        
        ////////////////////////////////////////////////////////////////////////////////
        
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', app_path().'/PushUDEX.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        
        // Open a connection to the APNS server
        $fp = stream_socket_client(
                                   'ssl://gateway.sandbox.push.apple.com:2195', $err,
                                   $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        if (!$fp)
        exit("Failed to connect: $err $errstr" . PHP_EOL);
        
        //echo 'Connected to APNS' . PHP_EOL;
        
        // Create the payload body
        $body['aps'] = array(
                             'alert' => trim($message),
                             'sound' => 'default',
                             );
        
        // Encode the payload as JSON
        $payload = json_encode($body);
        
        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', trim($deviceToken)) . pack('n', strlen($payload)) . $payload;
        
        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        
        if (!$result){
        //echo 'Message not delivered' . PHP_EOL;
        }
        else
        {
        //echo 'Message successfully delivered' . PHP_EOL;
        }
        
        // Close the connection to the server
        fclose($fp);
    }

    public static function getRatingFeedback($rating_value=null)
    {
        
        $feedback_data = RatingFeedback::lists('feedback','rating_value');

        $rating_value = isset($rating_value)?$rating_value:"";
                switch ($rating_value) {
                    case 1:
                        $feedback = isset($feedback_data[1])?$feedback_data[1]:'Terrible';
                        return $feedback;
                        break;
                    case 2:
                        $feedback = isset($feedback_data[2])?$feedback_data[2]:'Poor';
                        return $feedback;
                        break;
                    case 3:
                        $feedback = isset($feedback_data[3])?$feedback_data[3]:'Average';
                        return $feedback;
                        break;
                    case 4:
                        $feedback = isset($feedback_data[4])?$feedback_data[4]:'Good';
                        return $feedback;
                        break;
                    case 5:
                        $feedback = isset($feedback_data[5])?$feedback_data[5]:'Excellent';
                        return $feedback;
                        break;                
                    
                    default:
                        $feedback = "Not rated";
                        return $feedback;
                        break;
                }
    }

    public static function getCondidateCountByUserID($user_id=null){
        
        $query  = CorporateProfile::query();
        $corp_profile       = $query->where('userID',$user_id)->first();
        $query  = CorporateProfile::query();
        $total_cuser = $query->where('company_url',$corp_profile->company_url)->get();
        $user_arr = $total_cuser->lists('userID'); 
        $c = [];
        foreach ($user_arr as $key => $userid) {
          # code...
       
            $interviewD = Interview::where(function($query) use($userid){
                $query->whereRaw('FIND_IN_SET('.$userid.',interviewerID)');
                }
            )
            ->get(); 
           foreach ($interviewD as $key => $value) {
              $c[$value->id] = $value->condidate_name; 
           } 
         }

        return count($c); 
    }
   /*
    *Method : getActiveUserCount
    * Parameter : company_url
    * Response : active user Count
    */
    public function getActiveUserCount($company_url=null){

        $arr1 =   CorporateProfile::where('company_url',$company_url)->lists('userID')->toArray();
        $user_arr = User::whereIn('userID',$arr1)->where('status',1)->lists('userID');
        return $user_arr->count();
    }
   /*
    *Method : getEvaulationCount
    * Parameter : User ID
    * Response : condidate Evaluation Count
    */

    public function getEvaulationCount($userid=null){ 
        $evaluated = InterviewRating::where('interviewerID',$userid)->count(); 
        return $evaluated;
    }
   /*
    *Method : getPendingEvaulationCount
    * Parameter : User ID
    * Response : condidate Evaluation Count
    */

    public function getPendingEvaulationCount($userid=null){ 
        $evaluated_count = InterviewRating::where('interviewerID',$userid)->count(); 
        $pending_count   = Interview::whereRaw('FIND_IN_SET('.$userid.',interviewerID)')->count();
        $actual_pending = $pending_count-$evaluated_count;
        return  $pending_count;
    }

    /*
    *Method : getLastEvaluationDate
    * Parameter : User ID
    * Response : last Evaluation date
    */

    public function getLastEvaluationDate($userid=null){ 
        $evaluated_count = InterviewRating::where('interviewerID',$userid)
                            ->orderBy('id','desc')->first();
        $date =  "N/A";
        if($evaluated_count!=null){                    
            $date = (\Carbon\Carbon::parse($evaluated_count->created_at)->format('m-d-Y H:i:s A'));
        }                    
        return  $date;
    }
   /*
    *Method : getEvaluationCountByMonth
    * Parameter : User ID, month
    * Response : last Evaluation date
    */
    public function getEvaluationCountByMonth($userid=null,$month=null){
        $year = Input::get('year');
        $year =  isset($year)?$year:date('Y');  
        
        $count = InterviewRating::where('interviewerID',$userid)
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)->count(); 
        return $count;
    }
    /*
    *Method : getCorporateEvaluationCountByMonth
    * Parameter : User ID, month
    * Response : last Evaluation date
    */
    public function getCorporateEvaluationCountByMonth($userid=null,$month=null){ 
        
        $year = Input::get('year');
        $year =  isset($year)?$year:date('Y'); 
        $cp = CorporateProfile::where('userID',$userid)->first();
        $org_domain = $cp->company_url;
        $cp_user = CorporateProfile::where('company_url',$org_domain)->lists('userID')->toArray();
        $user = User::whereIn('userID',$cp_user)->count();
        $count = InterviewRating::whereIn('interviewerID',$cp_user)
                            ->whereYear('created_at', '=', $year)
                            ->whereMonth('created_at', '=', $month)->count();
        return $count;  
    }
     
}
