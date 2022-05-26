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

    <p>
        Thank you for completing our application process. You have now asked us to investigate the following loans to determine whether they were irresponsibly lent to you, and if they were make a complaint to the lender on your behalf. Please check this list carefully and notify us immediately if there are any errors.
    </p>

    <br>
    <table cellpadding="0" cellspacing="0" style="width:100%">
        <tr>
            <th>Lender</th>
            <th>Loan Date</th>
            <th>Agreement Number</th>
            <th>Loan Amount</th>
            <th>Complained Before</th>
            <th>Single Payment Loan</th>
            <th>Number Rollovers</th>
        </tr>
        @foreach ($customer->loans as $loan_number => $display_loan)
            <tr>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->lender_id > 0 ? $display_loan->lender->name : $display_loan->lender_name}}</td>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->date->format('M Y')}}</td>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->agreement_id}}</td>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->capital}}</td>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->previously_claimed ? 'Yes' : 'No'}}</td>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->single_repayment ? 'Yes' : 'No'}}</td>
                <td style="border:1px solid #ddd;padding:5px;">{{$display_loan->rollovers}}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <br>

    <p>
        <b style="text-decoration: underline">IMPORTANT</b><br>
        <b>Before we can begin to review your claims, we will need to verify your identity. Therefore, to ensure that your claim is not delayed, we would request that you send this straight away. The normal identity documents we ask for are:</b>
    </p>
    <br>
    <ul>
        <li><b>Passport</b></li>
        <li><b>Photo Driving Licence</b></li>
    </ul>
    <br>
    <p>
        <b>
            If you do not have either of these, please call or email us and we will discuss with you what we will be able to accept.
        </b>
    </p>
    <br>
    <p>
        <b>
            You can either photograph your ID on a smart phone or scan it and email to <a href="mailto:claimsteam@carloanrefunds.co.uk">claimsteam@carloanrefunds.co.uk</a>. Alternatively, you can photocopy it and put it in the post to ‘Freepost REDBRIDGE FINANCE’.
        </b>
    </p>
    <br>
    <p>
        <b>
            Please note that we will not be able to start reviewing your claims until we receive this and any deadlines for making claims that may be missed while we are waiting for you to send this will not be our responsibility.
        </b>
    </p>
    <br>
    <p>
        We may need other documentation before we can work on specific cases as different lenders have different requirements. If this is the case we will email you separately to request this
    </p>
    <br>
    <p>
        It would also be useful at this stage for you to send us any documentation you may have about your loans. This may include loan agreements, emails or letters from lenders, or even bank statements showing loans going in and payments going out. We understand that these may no longer be available, so please don’t worry if you do not have them, it is simply that the more information we have, the stronger the case we can create. This can all be emailed to us at claimsteam@carloanrefunds.co.uk
    </p>

    <br>

    <p>
        Finally, this email is only a confirmation that we have received your claim application. As we review and process each of your claims you will receive a separate email about this. Please keep a look out for these emails as they may require your action before we can continue. We will also advise you when we have submitted a claim to each lender, and of course keep you updated as each claim progresses.
    </p>

    <br>
    <p>
        In the meantime, if you have any questions about your claims, or want to talk to us about them, please do not hesitate to contact us on 01284 544733. It is also important that we can contact you quickly and easily and therefore if your email address or phone numbers change please let us know.
    </p>

    <br>

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
