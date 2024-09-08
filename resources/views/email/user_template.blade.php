<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>{{config('app.project.name')}}</title>
   </head>
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:21px; color:#666; text-align:justify;">
      <div style="max-width:630px;width:100%;margin:0 auto;">
        <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <td bgcolor="#FFFFFF" style="border:1px solid #e5e5e5;">
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr style="background-image: url(../../../images/front/emailer-banner-img.png); background-position: center bottom; background-repeat: no-repeat; ">
                     <td height="100" style="padding: 0 15px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                              <td><a href="#"><img src="{{url('/')}}/images/front/logo.png"  alt="logo" width="20%" height="" /></a></td>
                              <td align="right" style="font-size:13px; font-weight:bold; color: #ffffff">{{date('d F Y')}}</td>
                           </tr>
                        </table>
                     </td>
                  </tr>                                    
                  <tr>
                     <td  height="10"></td>
                  </tr>
                  <tr>
                     <td style="padding: 0 15px;">
                        {!! $content !!}                     
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>                  
                  <tr>
                     <td style="text-align:center; color:#fff;background-color:#9357eb; height: 40px;"> Copyright {{date('Y')}} by <a href="#" style="text-align:center; color:#fff;">{{config('app.project.name')}}.</a> All Right Reserved.</td>
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


