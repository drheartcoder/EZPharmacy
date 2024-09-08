<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta property="og:title" content="printing" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="http://www.webwingtechnologies.com/" />
      <meta property="og:image" content="images/logo.png" />
      <meta property="og:description" content="printing" />
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      <title>Printing</title>
      <!-- ======================================================================== -->
     
      <!--   Angular End Here-->
      <style type="text/css">
         .modal.container {
         max-width: none;
         }
         .modal-backdrop {
         z-index: 8 !important;
         }
          .listed-btn a {
    border: 1px solid #302563;
    color: #302563;
    display: block;
    font-size: 15px;
    height: initial;
    letter-spacing: 0.4px;
    margin: 0 auto;
    max-width: 204px;
    padding: 9px 4px;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    width: 100%;
}
      </style>
   </head>
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:'roboto', sans-serif; line-height:21px; color:#666; text-align:justify;">
      <div style="max-width:630px;width:100%;margin:0 auto;">
        <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <td bgcolor="#FFFFFF" style="border:1px solid #e5e5e5;">
               <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                  
                  <tr>
                    
                    <tr style="text-align: right;">
                      <td style="color: #333;font-size: 15px;padding-top: 10px;padding-right: 10px;"> <?php echo date('dS M, Y'); ?> </td>
                    </tr>
                     <td style="background-image: url('{{url('front-assets')}}/images/login-bg.jpg');background-position: center center;background-repeat: no-repeat;    color: #333;    font-size: 15px;    padding: 20px 25px;    text-align: center;">
                        <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="text-align:center;"><a href="{{url('/')}}"><img src="{{url('front-assets')}}/images/logo-head.png"  alt="logo"/></a></td>
                              
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td height="20"></td>
                  </tr>
                  <tr><td style="color: rgb(51, 51, 51); text-align: center; font-size: 19px; line-height: 35px; padding-top: 3px;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('pwelcome_top')));?> {{config('app.project.name')}}  </td></tr>
                    <tr><td style="color: #333333;font-size: 15px;padding-top: 3px;text-align: center;">{!! $subject !!}</td></tr>
                   <tr>
                     <td height="40"></td>
                  </tr>
                  <tr>
                     <td style="color: #545454;font-size: 15px;padding: 12px 30px;">
                        {!! $content !!}                     
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>                  
                    <tr>
                     <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                   <?php echo (preg_replace('#<[^>]+>#',' ',translation('pthanksp')));?> &amp; <?php echo (preg_replace('#<[^>]+>#',' ',translation('pregardsp')));?>,
                     </td>
                  </tr>
                  
               <tr>
                  <td style="color: #302563;  font-size: 15px; padding: 0 30px;">
                     {{config('app.project.name')}}
                  </td>
               </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>                                    
               <tr>
                  <td>
                     <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td style="font-size:13px;background:#302563; text-align: center; color: rgb(255, 255, 255); padding: 12px;">
                            <?php echo (preg_replace('#<[^>]+>#',' ',translation('copyright')));?> &copy; {{date('Y')}} <a href="{{url('/')}}" style="color:#fff;">{{config('app.project.name')}}</a>.<?php echo (preg_replace('#<[^>]+>#',' ',translation('all_rights_reserved')));?><a href="{{url('/')}}/page/privacy-policy" style="color:#fff;"><?php echo (preg_replace('#<[^>]+>#',' ',translation('privacy_policy')));?></a>
                           </td>
                        </tr>
                     </table>
                  </td>                 
               </tr>
            </table>
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
      </table>
        </div>      
      </div>       
   </body>
</html>
