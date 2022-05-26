<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Your Message Subject or Title</title>

    <style type="text/css">
        .ExternalClass {width:100%;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
            line-height: 100%;
        }
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        table td {border-collapse:collapse;}
        p {margin:0; padding:0; margin-bottom:0;}
        h1, h2, h3, h4, h5, h6 {
           color: black;
           line-height: 100%;
        }
        a, a:link {
           color:#2A5DB0;
           text-decoration: underline;
        }
        body, #body_style {
            background:#FFF;
            min-height:1000px;
            color:#000;
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
        }
        span.yshortcuts { color:#FFF; background-color:none; border:none;}
        span.yshortcuts:hover,
        span.yshortcuts:active,
        span.yshortcuts:focus {color:#FFF; background-color:none; border:none;}
        a:visited { color: #3c96e2; text-decoration: none}
        a:focus   { color: #3c96e2; text-decoration: underline}
        a:hover   { color: #3c96e2; text-decoration: underline}
        @media only screen and (max-device-width: 480px) {
               body[yahoo] #container1 {display:block !important}
               body[yahoo] p {font-size: 10px}
        }
        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px)  {
               body[yahoo] #container1 {display:block !important}
               body[yahoo] p {font-size: 12px}
        }
    </style>
</head>
<body style="background:#FFFFF; min-height:1000px; color:#000;font-family:Arial, Helvetica, sans-serif; font-size:12px" alink="#FF0000" link="#FF0000" bgcolor="#FFFFFF" text="#000000" yahoo="fix">
    <div id="body_style" style="padding:15px">



        <p style="margin-top:0">Hi {{$customer->first_name}},<br><br></p>

        <p style="margin-top:0">Thank you for starting an application with Redbridge Finance to claim compensation for the potentially unfair rollovers on your payday loans.<br><br></p>

        <p style="margin-top:0">Sadly you left before finishing the application process and as a result we cannot begin the claims process for you.<br><br></p>

        <p style="margin-top:0">Don’t worry though, if you follow the link below it will take you right back to where you left off.<br><br></p>

        <p style="margin-top:0"><a href="https://carloanrefunds.co.uk/resume/{{urlencode($customer->resume_token)}}" style="color:#F00" target ="_blank" title="Email on Acid">https://carloanrefunds.co.uk/resume/{{urlencode($customer->resume_token)}}</a><br><br></p>

        <p style="margin-top:0">We look forward to receiving the completed claim application soon. In the meantime, if you have any questions please do not hesitate to contact us on 01284 724651.<br><br></p>



        <table cellpadding="0" cellspacing="0" border="0" bgcolor="#FFF" width="600">
            <tr>
                <td width="600">Kind Regards<br><br></td>
            </tr>
            <tr>
                <td width="600" style="font-family: cursive;">Claims Team<br><br></td>
            </tr>
            <tr>
                <td width="600">Claims Team<br><br></td>
            </tr>
            <tr>
                <td width="600">
                    <img src="https://carloanrefunds.co.uk/images/logo.png" alt="" title="" width="308" style="display:block" border="0"/>
                </td>
            </tr>
            <tr>
                <td width="600">
                    <br>Redbridge Finance Limited
                    <br>The Cart Lodge
                    <br>Suffolk Hall
                    <br>The Street
                    <br>Bulmer
                    <br>CO10 7EW<br><br>
                </td>
            </tr>
            <tr>
                <td width="600">Redbridge Finance Limited is Registered in England & Wales with Company Number 10625599. Registered Office: The Cart Lodge, Suffolk Hall, The Street, Bulmer, CO10 7EW.<br><br></td>
            </tr>
            <tr>
                <td width="600">Firm Reference Number: 836097.  VAT Number 270 5830 08.  ICO Registration Number ZA533663<br><br></td>
            </tr>
            <tr>
                <td width="600">The information contained in this message is for the intended addressee only and may contain confidential and/or privileged information. If you are not the intended addressee, please delete this message and notify the sender; do not copy or distribute this message or disclose its contents to anyone. Any views or opinions expressed in this message are those of the author and do not necessarily represent those of Redbridge Finance Limited. No reliance may be placed on this message without written confirmation from an authorised representative of the company<br></td>
            </tr>
        </table>
    </div>
</body>
</html>
