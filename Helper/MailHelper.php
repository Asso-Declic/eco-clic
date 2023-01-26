<?php

class MailHelper
{
    public static function SendMail($destinataire, $HtmlContenu, $objet)
    {
        if (Config::read('mail.enabled')) {
            date_default_timezone_set("Europe/Paris");
            $mail = new PHPMailer(True);
            $body             = $HtmlContenu;
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPOptions = array('tls' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)); // ignorer l'erreur de certificat.
            $mail->Host       = "ssl0.ovh.net";
            $mail->Port       = 465;
            $mail->setLanguage('fr');
            $mail->CharSet = 'UTF-8';
            $mail->Username   = Config::read('mail.SMTPHost');
            $mail->Password   = Config::read('mail.SMTPPassword');
            $mail->From       = Config::read('mail.senderMail'); //adresse d’envoi correspondant au login entré précédemment
            $mail->FromName   = Config::read('mail.senderName'); // nom qui sera affiché
            $mail->Subject    = $objet; // sujet            
            $mail->WordWrap   = 50; // nombre de caractères pour le retour à la ligne automatique
            $mail->MsgHTML($body);
            $mail->SMTPSecure = "ssl";
            $mail->AddAddress($destinataire);
            $mail->IsHTML(true); // envoyer au format html, passer a false si en mode texte 
            $mail->Send();
        }
    }


    public static function SendMailInscriptionUtilisateur($destinataire, $Id)
    {
        $objet = 'Création de votre compte sur la plateforme Eco-clic';
        $HtmlContenu = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd><html xmlns=http://www.w3.org/1999/xhtml xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="x-apple-disable-message-reformatting" /><meta name="apple-mobile-web-app-capable" content="yes" /><meta name="apple-mobile-web-app-status-bar-style" content="black" /><meta name="format-detection" content="telephone=no" /><title></title><link href=https://fonts.googleapis.com/css?family=Open+Sans rel="stylesheet" type="text/css" /><link href=https://fonts.google.com/?query=calibri rel="stylesheet" type="text/css" /><style type="text/css">
        /* Resets */
        .ReadMsgBody { width: 100%; background-color: #ebebeb;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        a[x-apple-data-detectors]{
        color:inherit !important;
        text-decoration:none !important;
        font-size:inherit !important;
        font-family:inherit !important;
        font-weight:inherit !important;
        line-height:inherit !important;
        }
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        .yshortcuts a {border-bottom: none !important;}
        .rnb-del-min-width{ min-width: 0 !important; }
        /* Add new outlook css start */
        .templateContainer{
        max-width:590px !important;
        width:auto !important;
        }
        /* Add new outlook css end */
        /* Image width by default for 3 columns */
        img[class="rnb-col-3-img"] {
        max-width:170px;
        }
        /* Image width by default for 2 columns */
        img[class="rnb-col-2-img"] {
        max-width:264px;
        }
        /* Image width by default for 2 columns aside small size */
        img[class="rnb-col-2-img-side-xs"] {
        max-width:180px;
        }
        /* Image width by default for 2 columns aside big size */
        img[class="rnb-col-2-img-side-xl"] {
        max-width:350px;
        }
        /* Image width by default for 1 column */
        img[class="rnb-col-1-img"] {
        max-width:550px;
        }
        /* Image width by default for header */
        img[class="rnb-header-img"] {
        max-width:590px;
        }
        /* Ckeditor line-height spacing */
        .rnb-force-col p, ul, ol{margin:0px!important;}
        .rnb-del-min-width p, ul, ol{margin:0px!important;}
        /* tmpl-2 preview */
        .rnb-tmpl-width{ width:100%!important;}
        /* tmpl-11 preview */
        .rnb-social-width{padding-right:15px!important;}
        /* tmpl-11 preview */
        .rnb-social-align{float:right!important;}
        /* Ul Li outlook extra spacing fix */
        li{mso-margin-top-alt: 0; mso-margin-bottom-alt: 0;}
        /* Outlook fix */
        table {mso-table-lspace:0pt; mso-table-rspace:0pt;}
        /* Outlook fix */
        table, tr, td {border-collapse: collapse;}
        /* Outlook fix */
        p,a,li,blockquote {mso-line-height-rule:exactly;}
        /* Outlook fix */
        .msib-right-img { mso-padding-alt: 0 !important;}
        @media only screen and (min-width:590px){
        /* mac fix width */
        .templateContainer{width:590px !important;}
        }
        @media screen and (max-width: 360px){
        /* yahoo app fix width "tmpl-2 tmpl-10 tmpl-13" in android devices */
        .rnb-yahoo-width{ width:360px !important;}
        }
        @media screen and (max-width: 380px){
        /* fix width and font size "tmpl-4 tmpl-6" in mobile preview */
        .element-img-text{ font-size:24px !important;}
        .element-img-text2{ width:230px !important;}
        .content-img-text-tmpl-6{ font-size:24px !important;}
        .content-img-text2-tmpl-6{ width:220px !important;}
        }
        @media screen and (max-width: 480px) {
        td[class="rnb-container-padding"] {
        padding-left: 10px !important;
        padding-right: 10px !important;
        }
        /* force container nav to (horizontal) blocks */
        td.rnb-force-nav {
        display: inherit;
        }
        /* fix text alignment "tmpl-11" in mobile preview */
        .rnb-social-text-left {
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
        }
        .rnb-social-text-right {
        width: 100%;
        text-align: center;
        }
        }
        @media only screen and (max-width: 600px) {
        /* center the address &amp; social icons */
        .rnb-text-center {text-align:center !important;}
        /* force container columns to (horizontal) blocks */
        th.rnb-force-col {
        display: block;
        padding-right: 0 !important;
        padding-left: 0 !important;
        width:100%;
        }
        table.rnb-container {
        width: 100% !important;
        }
        table.rnb-btn-col-content {
        width: 100% !important;
        }
        table.rnb-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-last-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-col-2-noborder-onright {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        }
        table.rnb-col-2-noborder-onleft {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-top: 10px;
        padding-top: 10px;
        }
        table.rnb-last-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-1 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        img.rnb-col-3-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xs {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xl {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-1-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-header-img {
        /**max-width:none !important;**/
        width:100% !important;
        margin:0 auto;
        }
        img.rnb-logo-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        td.rnb-mbl-float-none {
        float:inherit !important;
        }
        .img-block-center{text-align:center !important;}
        .logo-img-center
        {
        float:inherit !important;
        }
        /* tmpl-11 preview */
        .rnb-social-align{margin:0 auto !important; float:inherit !important;}
        /* tmpl-11 preview */
        .rnb-social-center{display:inline-block;}
        /* tmpl-11 preview */
        .social-text-spacing{margin-bottom:0px !important; padding-bottom:0px !important;}
        /* tmpl-11 preview */
        .social-text-spacing2{padding-top:15px !important;}
        /* UL bullet fixed in outlook */
        ul {mso-special-format:bullet;}
        }@media screen{body{font-family:\'Open Sans\',\'Arial\',Helvetica,sans-serif;}}@media screen{body{font-family:\'Calibri\',\'Georgia\',serif;}}</style><!--[if gte mso 11]><style type="text/css">table{border-spacing: 0; }table td {border-collapse: separate;}</style><![endif]--><!--[if !mso]><!--><style type="text/css">table{border-spacing: 0;} table td {border-collapse: collapse;}</style> <!--<![endif]--><!--[if gte mso 15]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--></head><body>
        
        <table class="main-template" style="background-color: rgb(239, 239, 239);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
        
            <tbody><tr>
                <td valign="top" align="center">
                <!--[if gte mso 9]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="590" style="width:590px;">
                                <tr>
                                <td align="center" valign="top" width="590" style="width:590px;">
                                <![endif]-->
                    <table class="templateContainer" style="max-width:590px!important; width: 590px;" width="590" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
        
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <table class="rnb-del-min-width rnb-tmpl-width" style="min-width:590px;" name="Layout_39" id="Layout_39" width="100%" cellspacing="0" cellpadding="0" border="0">
                            
                            <tbody><tr>
                                <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                    <a href="#" name="Layout_39"></a>
                                    <table style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                        <tbody><tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif; color:#666666;font-size:13px;font-weight:normal;text-align: center;" height="20" align="center">
                                                <span style="color: rgb(102, 102, 102); text-decoration: underline;">
                                                    <a target="_blank" href="{{ mirror }}" style="text-decoration: underline; color: rgb(102, 102, 102);">Voir la version en ligne</a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_18" id="Layout_18" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_18"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:0px; width:550;;max-width:2480px !important;border-top:20px Solid #ffffff;border-right:20px Solid #ffffff;border-bottom:20px Solid #ffffff;border-left:20px Solid #ffffff;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 0px; " src=https://img.mailinblue.com/1474830/images/rnb/original/5fa527a79b9c82637f73acee.jpg width="550" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
        
                                        </td>
                                    </tr>
                                </tbody></table>
                           </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                    
                        <table name="Layout_8" id="Layout_8" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
                            <td valign="top" align="center"><a href="#" name="Layout_8"></a>
                                <table class="rnb-container" style="height: 0px; background-color: rgb(255, 255, 255); border-radius: 0px; border-collapse: separate; padding: 30px 20px 20px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"><tbody><tr>
                                        <td class="rnb-container-padding" style="font-size: px;font-family: ; color: ;">
        
                                            <table class="rnb-columns-container" style="margin:auto;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody><tr>
        
                                                    <th class="rnb-force-col" style="text-align: center; font-weight: normal" align="center">
        
                                                        <table class="rnb-col-1" cellspacing="0" cellpadding="0" border="0" align="center">
        
                                                            <tbody><tr>
                                                                <td height="10"></td>
                                                            </tr>
        
                                                            <tr>
                                                                <td style="font-family:\'Verdana\',Geneva,sans-serif; color:#999; text-align:center;">
        
                                                                    <span style="color:#999;"><strong><span style="color:#016066;"><span style="font-size:20px;">Création de votre compte<br>
        sur la plateforme Eco-clic</span></span></strong></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th></tr>
                                            </tbody></table></td>
                                    </tr>
        
                                </tbody></table>
        
                            </td>
                        </tr>
        
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_9" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_9"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Bonjour,<br>
        <br>
        Votre demande de création de compte sur la plateforme Eco-clic a été enregistrée. Veuillez valider votre adresse mail via le bouton "confirmer mon adresse mail".</span></span><br>
        &nbsp;</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_38" id="Layout_38" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_38"></a>
                                <table class="mso-button-block rnb-container" style="background-color: rgb(255, 255, 255); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="rnb-container-padding" valign="top" align="left">
        
                                            <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <th class="rnb-force-col" valign="top">
        
                                                        <table valign="top" class="rnb-col-1" width="550" cellspacing="0" cellpadding="0" border="0" align="center">
        
                                                            <tbody><tr>
                                                                <td valign="top">
                                                                    <table class="rnb-btn-col-content" style="margin:auto; border-collapse: separate;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                        <tbody><tr>
                                                                            <td style="font-size:18px; font-family:Arial,Helvetica,sans-serif; color:#ffffff; font-weight:normal; padding-left:20px; padding-right:20px; vertical-align: middle; background-color:#016066;border-radius:15px;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;" width="auto" valign="middle" height="60" bgcolor="#016066" align="center">
                                                                                <span style="color:#ffffff; font-weight:normal;">
                                                                                        <a style="text-decoration:none; color:#ffffff; font-weight:normal;" href="' . Config::read('domaine') . 'setMotDePasse.php?Id=' . $Id . '"><strong>&gt; Confirmer mon adresse mail</strong></a>
                                                                                    </span>
                                                                            </td>
                                                                        </tr></tbody></table>
                                                               </td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th>
                                                </tr>
                                            </tbody></table></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                </tbody></table>
        
                            </td>
                        </tr>
                    </tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_35" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_35"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div>
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Ce message est une réponse automatique, veuillez ne pas répondre à ce mail.</span></span></div>
        
        <div style="text-align: justify;"><span style="color:#000000;"><span style="font-size:16px;">Nous vous remercions de votre compréhension et n</span></span><span style="color:#000000;"><span style="font-size:16px;">otre équipe reste mobilisée pour vous accompagner.</span></span><br>
        &nbsp;</div>
        
        <div style="text-align: justify;">&nbsp;</div>
        
        <div style="text-align: justify;">&nbsp;</div>
        
        <div style="text-align: right;"><span style="font-size:16px;"><span style="color:#000000;">L\'équipe Eco-clic</span></span></div>
        </div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_31" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_31"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 5px solid rgb(8, 69, 63);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"></td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_32" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_32"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"><div style="text-align: center;"><br>
        Association pour le développement et l\'innovation numérique des collectivités<br>
        PAE du Tilloy - 5 rue Jean Monnet - 60006 Beauvais cedex<br>
        Tél. : 03 44 08 40 40 - contact@adico.fr<br>
        www.adico.fr</div>
        
        <div style="text-align: center;">--<br>
        © 2022 Adico</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr></tbody></table>
                    <!--[if gte mso 9]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                </tr>
                </tbody></table>
        
        </body></html>
        ';

        static::SendMail($destinataire, $HtmlContenu, $objet);
    }

    public static function SendMailInscription($destinataire, $Id)
    {
        $objet = 'Création de votre compte sur la plateforme Eco-clic';
        $HtmlContenu = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd><html xmlns=http://www.w3.org/1999/xhtml xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="x-apple-disable-message-reformatting" /><meta name="apple-mobile-web-app-capable" content="yes" /><meta name="apple-mobile-web-app-status-bar-style" content="black" /><meta name="format-detection" content="telephone=no" /><title></title><link href=https://fonts.googleapis.com/css?family=Open+Sans rel="stylesheet" type="text/css" /><link href=https://fonts.google.com/?query=calibri rel="stylesheet" type="text/css" /><style type="text/css">
        /* Resets */
        .ReadMsgBody { width: 100%; background-color: #ebebeb;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        a[x-apple-data-detectors]{
        color:inherit !important;
        text-decoration:none !important;
        font-size:inherit !important;
        font-family:inherit !important;
        font-weight:inherit !important;
        line-height:inherit !important;
        }
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        .yshortcuts a {border-bottom: none !important;}
        .rnb-del-min-width{ min-width: 0 !important; }
        /* Add new outlook css start */
        .templateContainer{
        max-width:590px !important;
        width:auto !important;
        }
        /* Add new outlook css end */
        /* Image width by default for 3 columns */
        img[class="rnb-col-3-img"] {
        max-width:170px;
        }
        /* Image width by default for 2 columns */
        img[class="rnb-col-2-img"] {
        max-width:264px;
        }
        /* Image width by default for 2 columns aside small size */
        img[class="rnb-col-2-img-side-xs"] {
        max-width:180px;
        }
        /* Image width by default for 2 columns aside big size */
        img[class="rnb-col-2-img-side-xl"] {
        max-width:350px;
        }
        /* Image width by default for 1 column */
        img[class="rnb-col-1-img"] {
        max-width:550px;
        }
        /* Image width by default for header */
        img[class="rnb-header-img"] {
        max-width:590px;
        }
        /* Ckeditor line-height spacing */
        .rnb-force-col p, ul, ol{margin:0px!important;}
        .rnb-del-min-width p, ul, ol{margin:0px!important;}
        /* tmpl-2 preview */
        .rnb-tmpl-width{ width:100%!important;}
        /* tmpl-11 preview */
        .rnb-social-width{padding-right:15px!important;}
        /* tmpl-11 preview */
        .rnb-social-align{float:right!important;}
        /* Ul Li outlook extra spacing fix */
        li{mso-margin-top-alt: 0; mso-margin-bottom-alt: 0;}
        /* Outlook fix */
        table {mso-table-lspace:0pt; mso-table-rspace:0pt;}
        /* Outlook fix */
        table, tr, td {border-collapse: collapse;}
        /* Outlook fix */
        p,a,li,blockquote {mso-line-height-rule:exactly;}
        /* Outlook fix */
        .msib-right-img { mso-padding-alt: 0 !important;}
        @media only screen and (min-width:590px){
        /* mac fix width */
        .templateContainer{width:590px !important;}
        }
        @media screen and (max-width: 360px){
        /* yahoo app fix width "tmpl-2 tmpl-10 tmpl-13" in android devices */
        .rnb-yahoo-width{ width:360px !important;}
        }
        @media screen and (max-width: 380px){
        /* fix width and font size "tmpl-4 tmpl-6" in mobile preview */
        .element-img-text{ font-size:24px !important;}
        .element-img-text2{ width:230px !important;}
        .content-img-text-tmpl-6{ font-size:24px !important;}
        .content-img-text2-tmpl-6{ width:220px !important;}
        }
        @media screen and (max-width: 480px) {
        td[class="rnb-container-padding"] {
        padding-left: 10px !important;
        padding-right: 10px !important;
        }
        /* force container nav to (horizontal) blocks */
        td.rnb-force-nav {
        display: inherit;
        }
        /* fix text alignment "tmpl-11" in mobile preview */
        .rnb-social-text-left {
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
        }
        .rnb-social-text-right {
        width: 100%;
        text-align: center;
        }
        }
        @media only screen and (max-width: 600px) {
        /* center the address &amp; social icons */
        .rnb-text-center {text-align:center !important;}
        /* force container columns to (horizontal) blocks */
        th.rnb-force-col {
        display: block;
        padding-right: 0 !important;
        padding-left: 0 !important;
        width:100%;
        }
        table.rnb-container {
        width: 100% !important;
        }
        table.rnb-btn-col-content {
        width: 100% !important;
        }
        table.rnb-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-last-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-col-2-noborder-onright {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        }
        table.rnb-col-2-noborder-onleft {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-top: 10px;
        padding-top: 10px;
        }
        table.rnb-last-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-1 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        img.rnb-col-3-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xs {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xl {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-1-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-header-img {
        /**max-width:none !important;**/
        width:100% !important;
        margin:0 auto;
        }
        img.rnb-logo-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        td.rnb-mbl-float-none {
        float:inherit !important;
        }
        .img-block-center{text-align:center !important;}
        .logo-img-center
        {
        float:inherit !important;
        }
        /* tmpl-11 preview */
        .rnb-social-align{margin:0 auto !important; float:inherit !important;}
        /* tmpl-11 preview */
        .rnb-social-center{display:inline-block;}
        /* tmpl-11 preview */
        .social-text-spacing{margin-bottom:0px !important; padding-bottom:0px !important;}
        /* tmpl-11 preview */
        .social-text-spacing2{padding-top:15px !important;}
        /* UL bullet fixed in outlook */
        ul {mso-special-format:bullet;}
        }@media screen{body{font-family:\'Open Sans\',\'Arial\',Helvetica,sans-serif;}}@media screen{body{font-family:\'Calibri\',\'Georgia\',serif;}}</style><!--[if gte mso 11]><style type="text/css">table{border-spacing: 0; }table td {border-collapse: separate;}</style><![endif]--><!--[if !mso]><!--><style type="text/css">table{border-spacing: 0;} table td {border-collapse: collapse;}</style> <!--<![endif]--><!--[if gte mso 15]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--></head><body>
        
        <table class="main-template" style="background-color: rgb(239, 239, 239);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
        
            <tbody><tr>
                <td valign="top" align="center">
                <!--[if gte mso 9]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="590" style="width:590px;">
                                <tr>
                                <td align="center" valign="top" width="590" style="width:590px;">
                                <![endif]-->
                    <table class="templateContainer" style="max-width:590px!important; width: 590px;" width="590" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
        
                <td valign="top" align="center">
        
                    <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_7400" id="Layout_7400" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_7400"></a>
                                <table width="100%" height="30" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td valign="top" height="30">
                                            <img style="display:block; max-height:30px; max-width:20px;" alt="" src=https://img.mailinblue.com/new_images/rnb/rnb_space.gif width="20" height="30">
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                    </td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <table class="rnb-del-min-width rnb-tmpl-width" style="min-width:590px;" name="Layout_39" id="Layout_39" width="100%" cellspacing="0" cellpadding="0" border="0">
                            
                            <tbody><tr>
                                <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                    <a href="#" name="Layout_39"></a>
                                    <table style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                        <tbody><tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif; color:#666666;font-size:13px;font-weight:normal;text-align: center;" height="20" align="center">
                                                <span style="color: rgb(102, 102, 102); text-decoration: underline;">
                                                    <a target="_blank" href="{{ mirror }}" style="text-decoration: underline; color: rgb(102, 102, 102);">Voir la version en ligne</a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_18" id="Layout_18" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_18"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:0px; width:550;;max-width:2480px !important;border-top:20px Solid #ffffff;border-right:20px Solid #ffffff;border-bottom:20px Solid #ffffff;border-left:20px Solid #ffffff;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 0px; " src=https://img.mailinblue.com/1474830/images/rnb/original/5fa527a79b9c82637f73acee.jpg width="550" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
        
                                        </td>
                                    </tr>
                                </tbody></table>
                           </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->

                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                    
                        <table name="Layout_8" id="Layout_8" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
                            <td valign="top" align="center"><a href="#" name="Layout_8"></a>
                                <table class="rnb-container" style="height: 0px; background-color: rgb(255, 255, 255); border-radius: 0px; border-collapse: separate; padding: 30px 20px 20px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"><tbody><tr>
                                        <td class="rnb-container-padding" style="font-size: px;font-family: ; color: ;">
        
                                            <table class="rnb-columns-container" style="margin:auto;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody><tr>
        
                                                    <th class="rnb-force-col" style="text-align: center; font-weight: normal" align="center">
        
                                                        <table class="rnb-col-1" cellspacing="0" cellpadding="0" border="0" align="center">
        
                                                            <tbody><tr>
                                                                <td height="10"></td>
                                                            </tr>
        
                                                            <tr>
                                                                <td style="font-family:\'Verdana\',Geneva,sans-serif; color:#999; text-align:center;">
        
                                                                    <span style="color:#999;"><strong><span style="color:#016066;"><span style="font-size:20px;">Création de votre compte<br>
        sur la plateforme Eco-clic</span></span></strong></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th></tr>
                                            </tbody></table></td>
                                    </tr>
        
                                </tbody></table>
        
                            </td>
                        </tr>
        
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_9" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_9"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Bonjour,<br>
        <br>
        Votre demande de création de compte sur la plateforme Eco-clic a été enregistrée. Veuillez valider votre adresse mail via le bouton "confirmer mon adresse mail".</span></span><br>
        &nbsp;</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_38" id="Layout_38" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_38"></a>
                                <table class="mso-button-block rnb-container" style="background-color: rgb(255, 255, 255); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="rnb-container-padding" valign="top" align="left">
        
                                            <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <th class="rnb-force-col" valign="top">
        
                                                        <table valign="top" class="rnb-col-1" width="550" cellspacing="0" cellpadding="0" border="0" align="center">
        
                                                            <tbody><tr>
                                                                <td valign="top">
                                                                    <table class="rnb-btn-col-content" style="margin:auto; border-collapse: separate;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                        <tbody><tr>
                                                                            <td style="font-size:18px; font-family:Arial,Helvetica,sans-serif; color:#ffffff; font-weight:normal; padding-left:20px; padding-right:20px; vertical-align: middle; background-color:#016066;border-radius:15px;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;" width="auto" valign="middle" height="60" bgcolor="#016066" align="center">
                                                                                <span style="color:#ffffff; font-weight:normal;">
                                                                                        <a style="text-decoration:none; color:#ffffff; font-weight:normal;" href="' . Config::read('domaine') . '/nouveauMotDePasse.php?Id=' . $Id . '"><strong>&gt; Confirmer mon adresse mail</strong></a>
                                                                                    </span>
                                                                            </td>
                                                                        </tr></tbody></table>
                                                               </td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th>
                                                </tr>
                                            </tbody></table></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                </tbody></table>
        
                            </td>
                        </tr>
                    </tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_35" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_35"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div>
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Ce message est une réponse automatique, veuillez ne pas répondre à ce mail.</span></span></div>
        
        <div style="text-align: justify;"><span style="color:#000000;"><span style="font-size:16px;">Nous vous remercions de votre compréhension et n</span></span><span style="color:#000000;"><span style="font-size:16px;">otre équipe reste mobilisée pour vous accompagner.</span></span><br>
        &nbsp;</div>
        
        <div style="text-align: justify;">&nbsp;</div>
        
        <div style="text-align: justify;">&nbsp;</div>
        
        <div style="text-align: right;"><span style="font-size:16px;"><span style="color:#000000;">L\'équipe Eco-clic</span></span></div>
        </div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_31" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_31"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 5px solid rgb(8, 69, 63);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"></td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_32" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_32"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"><div style="text-align: center;"><br>
        Association pour le développement et l\'innovation numérique des collectivités<br>
        PAE du Tilloy - 5 rue Jean Monnet - 60006 Beauvais cedex<br>
        Tél. : 03 44 08 40 40 - contact@adico.fr<br>
        www.adico.fr</div>
        
        <div style="text-align: center;">--<br>
        © 2022 Adico</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr></tbody></table>
                    <!--[if gte mso 9]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                </tr>
                </tbody></table>
        
        </body></html>
        ';

        static::SendMail($destinataire, $HtmlContenu, $objet);
    }

    public static function SendMailInscriptionAdministrateur($destinataire, $Id)
    {
        $objet = 'Création de votre compte sur la plateforme Eco-clic';
        $HtmlContenu = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd><html xmlns=http://www.w3.org/1999/xhtml xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="x-apple-disable-message-reformatting" /><meta name="apple-mobile-web-app-capable" content="yes" /><meta name="apple-mobile-web-app-status-bar-style" content="black" /><meta name="format-detection" content="telephone=no" /><title></title><link href=https://fonts.googleapis.com/css?family=Open+Sans rel="stylesheet" type="text/css" /><link href=https://fonts.google.com/?query=calibri rel="stylesheet" type="text/css" /><style type="text/css">
        /* Resets */
        .ReadMsgBody { width: 100%; background-color: #ebebeb;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        a[x-apple-data-detectors]{
        color:inherit !important;
        text-decoration:none !important;
        font-size:inherit !important;
        font-family:inherit !important;
        font-weight:inherit !important;
        line-height:inherit !important;
        }
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        .yshortcuts a {border-bottom: none !important;}
        .rnb-del-min-width{ min-width: 0 !important; }
        /* Add new outlook css start */
        .templateContainer{
        max-width:590px !important;
        width:auto !important;
        }
        /* Add new outlook css end */
        /* Image width by default for 3 columns */
        img[class="rnb-col-3-img"] {
        max-width:170px;
        }
        /* Image width by default for 2 columns */
        img[class="rnb-col-2-img"] {
        max-width:264px;
        }
        /* Image width by default for 2 columns aside small size */
        img[class="rnb-col-2-img-side-xs"] {
        max-width:180px;
        }
        /* Image width by default for 2 columns aside big size */
        img[class="rnb-col-2-img-side-xl"] {
        max-width:350px;
        }
        /* Image width by default for 1 column */
        img[class="rnb-col-1-img"] {
        max-width:550px;
        }
        /* Image width by default for header */
        img[class="rnb-header-img"] {
        max-width:590px;
        }
        /* Ckeditor line-height spacing */
        .rnb-force-col p, ul, ol{margin:0px!important;}
        .rnb-del-min-width p, ul, ol{margin:0px!important;}
        /* tmpl-2 preview */
        .rnb-tmpl-width{ width:100%!important;}
        /* tmpl-11 preview */
        .rnb-social-width{padding-right:15px!important;}
        /* tmpl-11 preview */
        .rnb-social-align{float:right!important;}
        /* Ul Li outlook extra spacing fix */
        li{mso-margin-top-alt: 0; mso-margin-bottom-alt: 0;}
        /* Outlook fix */
        table {mso-table-lspace:0pt; mso-table-rspace:0pt;}
        /* Outlook fix */
        table, tr, td {border-collapse: collapse;}
        /* Outlook fix */
        p,a,li,blockquote {mso-line-height-rule:exactly;}
        /* Outlook fix */
        .msib-right-img { mso-padding-alt: 0 !important;}
        @media only screen and (min-width:590px){
        /* mac fix width */
        .templateContainer{width:590px !important;}
        }
        @media screen and (max-width: 360px){
        /* yahoo app fix width "tmpl-2 tmpl-10 tmpl-13" in android devices */
        .rnb-yahoo-width{ width:360px !important;}
        }
        @media screen and (max-width: 380px){
        /* fix width and font size "tmpl-4 tmpl-6" in mobile preview */
        .element-img-text{ font-size:24px !important;}
        .element-img-text2{ width:230px !important;}
        .content-img-text-tmpl-6{ font-size:24px !important;}
        .content-img-text2-tmpl-6{ width:220px !important;}
        }
        @media screen and (max-width: 480px) {
        td[class="rnb-container-padding"] {
        padding-left: 10px !important;
        padding-right: 10px !important;
        }
        /* force container nav to (horizontal) blocks */
        td.rnb-force-nav {
        display: inherit;
        }
        /* fix text alignment "tmpl-11" in mobile preview */
        .rnb-social-text-left {
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
        }
        .rnb-social-text-right {
        width: 100%;
        text-align: center;
        }
        }
        @media only screen and (max-width: 600px) {
        /* center the address &amp; social icons */
        .rnb-text-center {text-align:center !important;}
        /* force container columns to (horizontal) blocks */
        th.rnb-force-col {
        display: block;
        padding-right: 0 !important;
        padding-left: 0 !important;
        width:100%;
        }
        table.rnb-container {
        width: 100% !important;
        }
        table.rnb-btn-col-content {
        width: 100% !important;
        }
        table.rnb-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-last-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-col-2-noborder-onright {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        }
        table.rnb-col-2-noborder-onleft {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-top: 10px;
        padding-top: 10px;
        }
        table.rnb-last-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-1 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        img.rnb-col-3-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xs {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xl {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-1-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-header-img {
        /**max-width:none !important;**/
        width:100% !important;
        margin:0 auto;
        }
        img.rnb-logo-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        td.rnb-mbl-float-none {
        float:inherit !important;
        }
        .img-block-center{text-align:center !important;}
        .logo-img-center
        {
        float:inherit !important;
        }
        /* tmpl-11 preview */
        .rnb-social-align{margin:0 auto !important; float:inherit !important;}
        /* tmpl-11 preview */
        .rnb-social-center{display:inline-block;}
        /* tmpl-11 preview */
        .social-text-spacing{margin-bottom:0px !important; padding-bottom:0px !important;}
        /* tmpl-11 preview */
        .social-text-spacing2{padding-top:15px !important;}
        /* UL bullet fixed in outlook */
        ul {mso-special-format:bullet;}
        }@media screen{body{font-family:\'Open Sans\',\'Arial\',Helvetica,sans-serif;}}@media screen{body{font-family:\'Calibri\',\'Georgia\',serif;}}</style><!--[if gte mso 11]><style type="text/css">table{border-spacing: 0; }table td {border-collapse: separate;}</style><![endif]--><!--[if !mso]><!--><style type="text/css">table{border-spacing: 0;} table td {border-collapse: collapse;}</style> <!--<![endif]--><!--[if gte mso 15]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--></head><body>
        
        <table class="main-template" style="background-color: rgb(239, 239, 239);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
        
            <tbody><tr>
                <td valign="top" align="center">
                <!--[if gte mso 9]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="590" style="width:590px;">
                                <tr>
                                <td align="center" valign="top" width="590" style="width:590px;">
                                <![endif]-->
                    <table class="templateContainer" style="max-width:590px!important; width: 590px;" width="590" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
        
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <table class="rnb-del-min-width rnb-tmpl-width" style="min-width:590px;" name="Layout_39" id="Layout_39" width="100%" cellspacing="0" cellpadding="0" border="0">
                            
                            <tbody><tr>
                                <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                    <a href="#" name="Layout_39"></a>
                                    <table style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                        <tbody><tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif; color:#666666;font-size:13px;font-weight:normal;text-align: center;" height="20" align="center">
                                                <span style="color: rgb(102, 102, 102); text-decoration: underline;">
                                                    <a target="_blank" href="{{ mirror }}" style="text-decoration: underline; color: rgb(102, 102, 102);">Voir la version en ligne</a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_18" id="Layout_18" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_18"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:0px; width:550;;max-width:2480px !important;border-top:20px Solid #ffffff;border-right:20px Solid #ffffff;border-bottom:20px Solid #ffffff;border-left:20px Solid #ffffff;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 0px; " src=https://img.mailinblue.com/1474830/images/rnb/original/5fa527a79b9c82637f73acee.jpg width="550" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
        
                                        </td>
                                    </tr>
                                </tbody></table>
                           </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                    
                        <table name="Layout_8" id="Layout_8" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
                            <td valign="top" align="center"><a href="#" name="Layout_8"></a>
                                <table class="rnb-container" style="height: 0px; background-color: rgb(255, 255, 255); border-radius: 0px; border-collapse: separate; padding: 30px 20px 20px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"><tbody><tr>
                                        <td class="rnb-container-padding" style="font-size: px;font-family: ; color: ;">
        
                                            <table class="rnb-columns-container" style="margin:auto;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody><tr>
        
                                                    <th class="rnb-force-col" style="text-align: center; font-weight: normal" align="center">
        
                                                        <table class="rnb-col-1" cellspacing="0" cellpadding="0" border="0" align="center">
        
                                                            <tbody><tr>
                                                                <td height="10"></td>
                                                            </tr>
        
                                                            <tr>
                                                                <td style="font-family:\'Verdana\',Geneva,sans-serif; color:#999; text-align:center;">
        
                                                                    <span style="color:#999;"><strong><span style="color:#016066;"><span style="font-size:20px;">Création de votre compte<br>
        sur la plateforme Eco-clic</span></span></strong></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th></tr>
                                            </tbody></table></td>
                                    </tr>
        
                                </tbody></table>
        
                            </td>
                        </tr>
        
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                    
                </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_9" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_9"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Bonjour,<br>
        <br>
        Votre demande de création de compte sur la plateforme Eco-clic a été enregistrée. Veuillez valider votre adresse mail via le bouton "confirmer mon adresse mail".</span></span><br>
        &nbsp;</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_38" id="Layout_38" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_38"></a>
                                <table class="mso-button-block rnb-container" style="background-color: rgb(255, 255, 255); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="rnb-container-padding" valign="top" align="left">
        
                                            <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <th class="rnb-force-col" valign="top">
        
                                                        <table valign="top" class="rnb-col-1" width="550" cellspacing="0" cellpadding="0" border="0" align="center">
        
                                                            <tbody><tr>
                                                                <td valign="top">
                                                                    <table class="rnb-btn-col-content" style="margin:auto; border-collapse: separate;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                        <tbody><tr>
                                                                            <td style="font-size:18px; font-family:Arial,Helvetica,sans-serif; color:#ffffff; font-weight:normal; padding-left:20px; padding-right:20px; vertical-align: middle; background-color:#016066;border-radius:15px;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;" width="auto" valign="middle" height="60" bgcolor="#016066" align="center">
                                                                                <span style="color:#ffffff; font-weight:normal;">
                                                                                        <a style="text-decoration:none; color:#ffffff; font-weight:normal;" href="' . Config::read('domaine') . '/Admin/nouveauMotDePasse.php?Id=' . $Id . '"><strong>&gt; Confirmer mon adresse mail</strong></a>
                                                                                    </span>
                                                                            </td>
                                                                        </tr></tbody></table>
                                                               </td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th>
                                                </tr>
                                            </tbody></table></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                </tbody></table>
        
                            </td>
                        </tr>
                    </tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_35" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_35"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div>
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Ce message est une réponse automatique, veuillez ne pas répondre à ce mail.</span></span></div>
        
        <div style="text-align: justify;"><span style="color:#000000;"><span style="font-size:16px;">Nous vous remercions de votre compréhension et n</span></span><span style="color:#000000;"><span style="font-size:16px;">otre équipe reste mobilisée pour vous accompagner.</span></span><br>
        &nbsp;</div>
        
        <div style="text-align: justify;">&nbsp;</div>
        
        <div style="text-align: justify;">&nbsp;</div>
        
        <div style="text-align: right;"><span style="font-size:16px;"><span style="color:#000000;">L\'équipe Eco-clic</span></span></div>
        </div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_31" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_31"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 5px solid rgb(8, 69, 63);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"></td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                    
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_32" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_32"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
        
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
        
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
        
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
        
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"><div style="text-align: center;"><br>
        Association pour le développement et l\'innovation numérique des collectivités<br>
        PAE du Tilloy - 5 rue Jean Monnet - 60006 Beauvais cedex<br>
        Tél. : 03 44 08 40 40 - contact@adico.fr<br>
        www.adico.fr</div>
        
        <div style="text-align: center;">--<br>
        © 2022 Adico</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
        
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                        
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
        
                    </div></td>
            </tr></tbody></table>
                    <!--[if gte mso 9]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                </tr>
                </tbody></table>
        
        </body></html>
        ';

        static::SendMail($destinataire, $HtmlContenu, $objet);
    }

    public static function SendMailMotDePasseOublie($mail, $Nom, $Prenom, $recuperation)
    {
        $objet = 'Mot de passe oublié Ecoclic';
        $HtmlContenu = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd><html xmlns=http://www.w3.org/1999/xhtml xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="x-apple-disable-message-reformatting" /><meta name="apple-mobile-web-app-capable" content="yes" /><meta name="apple-mobile-web-app-status-bar-style" content="black" /><meta name="format-detection" content="telephone=no" /><title></title><link href=https://fonts.googleapis.com/css?family=Open+Sans rel="stylesheet" type="text/css" /><link href=https://fonts.google.com/?query=calibri rel="stylesheet" type="text/css" /><style type="text/css">
        /* Resets */
        .ReadMsgBody { width: 100%; background-color: #ebebeb;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        a[x-apple-data-detectors]{
        color:inherit !important;
        text-decoration:none !important;
        font-size:inherit !important;
        font-family:inherit !important;
        font-weight:inherit !important;
        line-height:inherit !important;
        }
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        .yshortcuts a {border-bottom: none !important;}
        .rnb-del-min-width{ min-width: 0 !important; }
        /* Add new outlook css start */
        .templateContainer{
        max-width:590px !important;
        width:auto !important;
        }
        /* Add new outlook css end */
        /* Image width by default for 3 columns */
        img[class="rnb-col-2-img-side-xl"] {
        max-width:350px;
        }
        /* Image width by default for 1 column */
        img[class="rnb-col-1-img"] {
        max-width:550px;
        }
        /* Image width by default for header */
        img[class="rnb-header-img"] {
        max-width:590px;
        }
        /* Ckeditor line-height spacing */
        .rnb-force-col p, ul, ol{margin:0px!important;}
        .rnb-del-min-width p, ul, ol{margin:0px!important;}
        /* tmpl-2 preview */
        .rnb-tmpl-width{ width:100%!important;}
        /* tmpl-11 preview */
        .rnb-social-width{padding-right:15px!important;}
        /* tmpl-11 preview */
        .rnb-social-align{float:right!important;}
        /* Ul Li outlook extra spacing fix */
        li{mso-margin-top-alt: 0; mso-margin-bottom-alt: 0;}
        /* Outlook fix */
        table {mso-table-lspace:0pt; mso-table-rspace:0pt;}
        /* Outlook fix */
        table, tr, td {border-collapse: collapse;}
        /* Outlook fix */
        p,a,li,blockquote {mso-line-height-rule:exactly;}
        /* Outlook fix */
        .msib-right-img { mso-padding-alt: 0 !important;}
        @media only screen and (min-width:590px){
        /* mac fix width */
        .templateContainer{width:590px !important;}
        }
        @media screen and (max-width: 360px){
        /* yahoo app fix width "tmpl-2 tmpl-10 tmpl-13" in android devices */
        .rnb-yahoo-width{ width:360px !important;}
        }
        @media screen and (max-width: 380px){
        /* fix width and font size "tmpl-4 tmpl-6" in mobile preview */
        .element-img-text{ font-size:24px !important;}
        .element-img-text2{ width:230px !important;}
        .content-img-text-tmpl-6{ font-size:24px !important;}
        .content-img-text2-tmpl-6{ width:220px !important;}
        }
        @media screen and (max-width: 480px) {
        td[class="rnb-container-padding"] {
        padding-left: 10px !important;
        padding-right: 10px !important;
        }
        /* force container nav to (horizontal) blocks */
        td.rnb-force-nav {
        display: inherit;
        }
        /* fix text alignment "tmpl-11" in mobile preview */
        .rnb-social-text-left {
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
        }
        .rnb-social-text-right {
        width: 100%;
        text-align: center;
        }
        }
        @media only screen and (max-width: 600px) {
        /* center the address &amp; social icons */
        .rnb-text-center {text-align:center !important;}
        /* force container columns to (horizontal) blocks */
        th.rnb-force-col {
        display: block;
        padding-right: 0 !important;
        padding-left: 0 !important;
        width:100%;
        }
        table.rnb-container {
        width: 100% !important;
        }
        table.rnb-btn-col-content {
        width: 100% !important;
        }
        table.rnb-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-last-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-col-2-noborder-onright {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        }
        table.rnb-col-2-noborder-onleft {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-top: 10px;
        padding-top: 10px;
        }
        table.rnb-last-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-1 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        img.rnb-col-3-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xs {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xl {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-1-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-header-img {
        /**max-width:none !important;**/
        width:100% !important;
        margin:0 auto;
        }
        img.rnb-logo-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        td.rnb-mbl-float-none {
        float:inherit !important;
        }
        .img-block-center{text-align:center !important;}
        .logo-img-center
        {
        float:inherit !important;
        }
        /* tmpl-11 preview */
        .rnb-social-align{margin:0 auto !important; float:inherit !important;}
        /* tmpl-11 preview */
        .rnb-social-center{display:inline-block;}
        /* tmpl-11 preview */
        .social-text-spacing{margin-bottom:0px !important; padding-bottom:0px !important;}
        /* tmpl-11 preview */
        .social-text-spacing2{padding-top:15px !important;}
        /* UL bullet fixed in outlook */
        ul {mso-special-format:bullet;}
        }@media screen{body{font-family:\'Open Sans\',\'Arial\',Helvetica,sans-serif;}}@media screen{body{font-family:\'Calibri\',\'Georgia\',serif;}}</style><!--[if gte mso 11]><style type="text/css">table{border-spacing: 0; }table td {border-collapse: separate;}</style><![endif]--><!--[if !mso]><!--><style type="text/css">table{border-spacing: 0;} table td {border-collapse: collapse;}</style> <!--<![endif]--><!--[if gte mso 15]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--></head><body>
        
        <table class="main-template" style="background-color: rgb(239, 239, 239);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
        
            <tbody><tr>
                <td valign="top" align="center">
                <!--[if gte mso 9]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="590" style="width:590px;">
                                <tr>
                                <td align="center" valign="top" width="590" style="width:590px;">
                                <![endif]-->
                    <table class="templateContainer" style="max-width:590px!important; width: 590px;" width="590" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
        
                <td valign="top" align="center">
        
                    <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_7400" id="Layout_7400" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_7400"></a>
                                <table width="100%" height="30" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td valign="top" height="30">
                                            <img style="display:block; max-height:30px; max-width:20px;" alt="" src=https://img.mailinblue.com/new_images/rnb/rnb_space.gif width="20" height="30">
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                    </td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <table class="rnb-del-min-width rnb-tmpl-width" style="min-width:590px;" name="Layout_39" id="Layout_39" width="100%" cellspacing="0" cellpadding="0" border="0">
                            
                            <tbody><tr>
                                <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                    <a href="#" name="Layout_39"></a>
                                    <table style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                        <tbody><tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif; color:#666666;font-size:13px;font-weight:normal;text-align: center;" height="20" align="center">
                                                <span style="color: rgb(102, 102, 102); text-decoration: underline;">
                                                    <a target="_blank" href="{{ mirror }}" style="text-decoration: underline; color: rgb(102, 102, 102);">Voir la version en ligne</a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_18" id="Layout_18" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_18"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:0px; width:550;;max-width:2480px !important;border-top:20px Solid #ffffff;border-right:20px Solid #ffffff;border-bottom:20px Solid #ffffff;border-left:20px Solid #ffffff;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 0px; " src=https://img.mailinblue.com/1474830/images/rnb/original/5fa527a79b9c82637f73acee.jpg width="550" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
                                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255);">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_40" id="Layout_40" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_40"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:5px; width:590;;max-width:1809px !important;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 5px; " src=https://img.mailinblue.com/1474830/images/rnb/original/61e19cbd654dca309d4b8d77.jpg width="590" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
                                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                                                            
                        <table name="Layout_8" id="Layout_8" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
                            <td valign="top" align="center"><a href="#" name="Layout_8"></a>
                                <table class="rnb-container" style="height: 0px; background-color: rgb(255, 255, 255); border-radius: 0px; border-collapse: separate; padding: 30px 20px 20px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"><tbody><tr>
                                        <td class="rnb-container-padding" style="font-size: px;font-family: ; color: ;">
                                                            
                                            <table class="rnb-columns-container" style="margin:auto;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody><tr>
                                                            
                                                    <th class="rnb-force-col" style="text-align: center; font-weight: normal" align="center">
                                                            
                                                        <table class="rnb-col-1" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            
                                                            <tbody><tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="font-family:\'Verdana\',Geneva,sans-serif; color:#999; text-align:center;">
                                                            
                                                                    <span style="color:#999;"><strong><span style="color:#08453F;"><span style="font-size:20px;">Vous avez oublié votre mot de passe</span></span></strong></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th></tr>
                                            </tbody></table></td>
                                    </tr>
                                                            
                                </tbody></table>
                                                            
                            </td>
                        </tr>
                                                            
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_9" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_9"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Bonjour ' . $Prenom . ' ' . $Nom . ',</span></span></div>
                                                            
        <div style="text-align: justify;">&nbsp;</div>
                                                            
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Afin de procéder au changement de votre mot de passe, veuillez cliquer sur le bouton "Modifier mon mot de passe".</span></span></div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_38" id="Layout_38" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_38"></a>
                                <table class="mso-button-block rnb-container" style="background-color: rgb(255, 255, 255); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                            <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <th class="rnb-force-col" valign="top">
                                                            
                                                        <table valign="top" class="rnb-col-1" width="550" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            
                                                            <tbody><tr>
                                                                <td valign="top">
                                                                    <table class="rnb-btn-col-content" style="margin:auto; border-collapse: separate;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                        <tbody><tr>
                                                                            <td style="font-size:18px; font-family:Arial,Helvetica,sans-serif; color:#ffffff; font-weight:normal; padding-left:20px; padding-right:20px; vertical-align: middle; background-color:#08453F;border-radius:15px;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;" width="auto" valign="middle" height="60" bgcolor="#08453F" align="center">
                                                                                <span style="color:#ffffff; font-weight:normal;">
                                                                                        <a style="text-decoration:none; color:#ffffff; font-weight:normal;" href="' . Config::read('domaine') . '/changementMdp.php?Id=' . $recuperation . '"><strong>&gt; Modifier mon mot de passe</strong></a>
                                                                                    </span>
                                                                            </td>
                                                                        </tr></tbody></table>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th>
                                                </tr>
                                            </tbody></table></td>
                                    </tr> 
                                    <tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                </tbody></table>
                                                            
                            </td>
                        </tr>
                    </tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_35" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_35"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div>
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Ce message est une réponse automatique, veuillez ne pas répondre à ce mail.</span></span></div>
                                                            
        <div style="text-align: justify;"><span style="color:#000000;"><span style="font-size:16px;">Nous vous remercions de votre compréhension et n</span></span><span style="color:#000000;"><span style="font-size:16px;">otre équipe reste mobilisée pour vous accompagner.</span></span><br>
        &nbsp;</div>
                                                            
        <div style="text-align: justify;">&nbsp;</div>
                                                            
        <div style="text-align: justify;">&nbsp;</div>
                                                            
        <div style="text-align: right;"><span style="font-size:16px;"><span style="color:#000000;">L\'équipe Adico</span></span></div>
        </div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_31" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_31"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 5px solid rgb(8, 69, 63);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"></td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_32" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_32"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"><div style="text-align: center;"><br>
        Association pour le développement et l\'innovation numérique des collectivités<br>
        PAE du Tilloy - 5 rue Jean Monnet - 60006 Beauvais cedex<br>
        Tél. : 03 44 08 40 40 - contact@adico.fr<br>
        www.adico.fr</div>
                                                            
        <div style="text-align: center;">--<br>
        © 2022 Adico</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr></tbody></table>
                    <!--[if gte mso 9]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                </tr>
                </tbody></table>
                                                            
        </body></html>';

        static::SendMail($mail, $HtmlContenu, $objet);
    }

    public static function SendMailMotDePasseOublieAdmin($mail, $Nom, $Prenom, $recuperation)
    {
        $objet = 'Mot de passe oublié Ecoclic';
        $HtmlContenu = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd><html xmlns=http://www.w3.org/1999/xhtml xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta http-equiv="X-UA-Compatible" content="IE=edge" /><meta name="viewport" content="width=device-width, initial-scale=1" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="x-apple-disable-message-reformatting" /><meta name="apple-mobile-web-app-capable" content="yes" /><meta name="apple-mobile-web-app-status-bar-style" content="black" /><meta name="format-detection" content="telephone=no" /><title></title><link href=https://fonts.googleapis.com/css?family=Open+Sans rel="stylesheet" type="text/css" /><link href=https://fonts.google.com/?query=calibri rel="stylesheet" type="text/css" /><style type="text/css">
        /* Resets */
        .ReadMsgBody { width: 100%; background-color: #ebebeb;}
        .ExternalClass {width: 100%; background-color: #ebebeb;}
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
        a[x-apple-data-detectors]{
        color:inherit !important;
        text-decoration:none !important;
        font-size:inherit !important;
        font-family:inherit !important;
        font-weight:inherit !important;
        line-height:inherit !important;
        }
        body {-webkit-text-size-adjust:none; -ms-text-size-adjust:none;}
        body {margin:0; padding:0;}
        .yshortcuts a {border-bottom: none !important;}
        .rnb-del-min-width{ min-width: 0 !important; }
        /* Add new outlook css start */
        .templateContainer{
        max-width:590px !important;
        width:auto !important;
        }
        /* Add new outlook css end */
        /* Image width by default for 3 columns */
        img[class="rnb-col-2-img-side-xl"] {
        max-width:350px;
        }
        /* Image width by default for 1 column */
        img[class="rnb-col-1-img"] {
        max-width:550px;
        }
        /* Image width by default for header */
        img[class="rnb-header-img"] {
        max-width:590px;
        }
        /* Ckeditor line-height spacing */
        .rnb-force-col p, ul, ol{margin:0px!important;}
        .rnb-del-min-width p, ul, ol{margin:0px!important;}
        /* tmpl-2 preview */
        .rnb-tmpl-width{ width:100%!important;}
        /* tmpl-11 preview */
        .rnb-social-width{padding-right:15px!important;}
        /* tmpl-11 preview */
        .rnb-social-align{float:right!important;}
        /* Ul Li outlook extra spacing fix */
        li{mso-margin-top-alt: 0; mso-margin-bottom-alt: 0;}
        /* Outlook fix */
        table {mso-table-lspace:0pt; mso-table-rspace:0pt;}
        /* Outlook fix */
        table, tr, td {border-collapse: collapse;}
        /* Outlook fix */
        p,a,li,blockquote {mso-line-height-rule:exactly;}
        /* Outlook fix */
        .msib-right-img { mso-padding-alt: 0 !important;}
        @media only screen and (min-width:590px){
        /* mac fix width */
        .templateContainer{width:590px !important;}
        }
        @media screen and (max-width: 360px){
        /* yahoo app fix width "tmpl-2 tmpl-10 tmpl-13" in android devices */
        .rnb-yahoo-width{ width:360px !important;}
        }
        @media screen and (max-width: 380px){
        /* fix width and font size "tmpl-4 tmpl-6" in mobile preview */
        .element-img-text{ font-size:24px !important;}
        .element-img-text2{ width:230px !important;}
        .content-img-text-tmpl-6{ font-size:24px !important;}
        .content-img-text2-tmpl-6{ width:220px !important;}
        }
        @media screen and (max-width: 480px) {
        td[class="rnb-container-padding"] {
        padding-left: 10px !important;
        padding-right: 10px !important;
        }
        /* force container nav to (horizontal) blocks */
        td.rnb-force-nav {
        display: inherit;
        }
        /* fix text alignment "tmpl-11" in mobile preview */
        .rnb-social-text-left {
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
        }
        .rnb-social-text-right {
        width: 100%;
        text-align: center;
        }
        }
        @media only screen and (max-width: 600px) {
        /* center the address &amp; social icons */
        .rnb-text-center {text-align:center !important;}
        /* force container columns to (horizontal) blocks */
        th.rnb-force-col {
        display: block;
        padding-right: 0 !important;
        padding-left: 0 !important;
        width:100%;
        }
        table.rnb-container {
        width: 100% !important;
        }
        table.rnb-btn-col-content {
        width: 100% !important;
        }
        table.rnb-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-last-col-3 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        /*border-bottom: 1px solid #eee;*/
        }
        table.rnb-col-2-noborder-onright {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-bottom: 10px;
        padding-bottom: 10px;
        }
        table.rnb-col-2-noborder-onleft {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        /* change left/right padding and margins to top/bottom ones */
        margin-top: 10px;
        padding-top: 10px;
        }
        table.rnb-last-col-2 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        table.rnb-col-1 {
        /* unset table align="left/right" */
        float: none !important;
        width: 100% !important;
        }
        img.rnb-col-3-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xs {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-2-img-side-xl {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-col-1-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        img.rnb-header-img {
        /**max-width:none !important;**/
        width:100% !important;
        margin:0 auto;
        }
        img.rnb-logo-img {
        /**max-width:none !important;**/
        width:100% !important;
        }
        td.rnb-mbl-float-none {
        float:inherit !important;
        }
        .img-block-center{text-align:center !important;}
        .logo-img-center
        {
        float:inherit !important;
        }
        /* tmpl-11 preview */
        .rnb-social-align{margin:0 auto !important; float:inherit !important;}
        /* tmpl-11 preview */
        .rnb-social-center{display:inline-block;}
        /* tmpl-11 preview */
        .social-text-spacing{margin-bottom:0px !important; padding-bottom:0px !important;}
        /* tmpl-11 preview */
        .social-text-spacing2{padding-top:15px !important;}
        /* UL bullet fixed in outlook */
        ul {mso-special-format:bullet;}
        }@media screen{body{font-family:\'Open Sans\',\'Arial\',Helvetica,sans-serif;}}@media screen{body{font-family:\'Calibri\',\'Georgia\',serif;}}</style><!--[if gte mso 11]><style type="text/css">table{border-spacing: 0; }table td {border-collapse: separate;}</style><![endif]--><!--[if !mso]><!--><style type="text/css">table{border-spacing: 0;} table td {border-collapse: collapse;}</style> <!--<![endif]--><!--[if gte mso 15]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--></head><body>
        
        <table class="main-template" style="background-color: rgb(239, 239, 239);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
        
            <tbody><tr>
                <td valign="top" align="center">
                <!--[if gte mso 9]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="590" style="width:590px;">
                                <tr>
                                <td align="center" valign="top" width="590" style="width:590px;">
                                <![endif]-->
                    <table class="templateContainer" style="max-width:590px!important; width: 590px;" width="590" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr>
        
                <td valign="top" align="center">
        
                    <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_7400" id="Layout_7400" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_7400"></a>
                                <table width="100%" height="30" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td valign="top" height="30">
                                            <img style="display:block; max-height:30px; max-width:20px;" alt="" src=https://img.mailinblue.com/new_images/rnb/rnb_space.gif width="20" height="30">
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                    </td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <table class="rnb-del-min-width rnb-tmpl-width" style="min-width:590px;" name="Layout_39" id="Layout_39" width="100%" cellspacing="0" cellpadding="0" border="0">
                            
                            <tbody><tr>
                                <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                    <a href="#" name="Layout_39"></a>
                                    <table style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                        <tbody><tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial,Helvetica,sans-serif; color:#666666;font-size:13px;font-weight:normal;text-align: center;" height="20" align="center">
                                                <span style="color: rgb(102, 102, 102); text-decoration: underline;">
                                                    <a target="_blank" href="{{ mirror }}" style="text-decoration: underline; color: rgb(102, 102, 102);">Voir la version en ligne</a></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1px; line-height:1px; mso-hide: all;" height="10">&nbsp;</td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </div></td>
            </tr><tr>
        
                <td valign="top" align="center">
        
                    <div style="background-color: rgb(255, 255, 255);">
                        
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                        
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_18" id="Layout_18" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_18"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:0px; width:550;;max-width:2480px !important;border-top:20px Solid #ffffff;border-right:20px Solid #ffffff;border-bottom:20px Solid #ffffff;border-left:20px Solid #ffffff;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 0px; " src=https://img.mailinblue.com/1474830/images/rnb/original/5fa527a79b9c82637f73acee.jpg width="550" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
                                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255);">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%; -webkit-backface-visibility: hidden; line-height: 10px;" name="Layout_40" id="Layout_40" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width: 590px;" valign="top" align="center">
                                <a href="#" name="Layout_40"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center">
                                    <tbody><tr>
                                        <td valign="top" align="center">
                                            <table cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <td>
                                                        <div style="border-radius:5px; width:590;;max-width:1809px !important;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;border-collapse: separate;border-radius: 0px;">
                                                            <div><img ng-if="col.img.source != \'url\'" class="rnb-header-img" alt="" style="display:block; float:left; border-radius: 5px; " src=https://img.mailinblue.com/1474830/images/rnb/original/61e19cbd654dca309d4b8d77.jpg width="590" vspace="0" hspace="0" border="0"></div><div style="clear:both;"></div>
                                                            </div></td>
                                                </tr>
                                            </tbody></table>
                                                            
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr></tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                                                            
                        <table name="Layout_8" id="Layout_8" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
                            <td valign="top" align="center"><a href="#" name="Layout_8"></a>
                                <table class="rnb-container" style="height: 0px; background-color: rgb(255, 255, 255); border-radius: 0px; border-collapse: separate; padding: 30px 20px 20px;" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"><tbody><tr>
                                        <td class="rnb-container-padding" style="font-size: px;font-family: ; color: ;">
                                                            
                                            <table class="rnb-columns-container" style="margin:auto;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                <tbody><tr>
                                                            
                                                    <th class="rnb-force-col" style="text-align: center; font-weight: normal" align="center">
                                                            
                                                        <table class="rnb-col-1" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            
                                                            <tbody><tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="font-family:\'Verdana\',Geneva,sans-serif; color:#999; text-align:center;">
                                                            
                                                                    <span style="color:#999;"><strong><span style="color:#08453F;"><span style="font-size:20px;">Vous avez oublié votre mot de passe</span></span></strong></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="10"></td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th></tr>
                                            </tbody></table></td>
                                    </tr>
                                                            
                                </tbody></table>
                                                            
                            </td>
                        </tr>
                                                            
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_9" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_9"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Bonjour ' . $Prenom . ' ' . $Nom . ',</span></span></div>
                                                            
        <div style="text-align: justify;">&nbsp;</div>
                                                            
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Afin de procéder au changement de votre mot de passe, veuillez cliquer sur le bouton "Modifier mon mot de passe".</span></span></div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:590px;" name="Layout_38" id="Layout_38" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" style="min-width:590px;" valign="top" align="center">
                                <a href="#" name="Layout_38"></a>
                                <table class="mso-button-block rnb-container" style="background-color: rgb(255, 255, 255); border-radius: 0px; padding-left: 20px; padding-right: 20px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody><tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                            <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody><tr>
                                                    <th class="rnb-force-col" valign="top">
                                                            
                                                        <table valign="top" class="rnb-col-1" width="550" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            
                                                            <tbody><tr>
                                                                <td valign="top">
                                                                    <table class="rnb-btn-col-content" style="margin:auto; border-collapse: separate;" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                        <tbody><tr>
                                                                            <td style="font-size:18px; font-family:Arial,Helvetica,sans-serif; color:#ffffff; font-weight:normal; padding-left:20px; padding-right:20px; vertical-align: middle; background-color:#08453F;border-radius:15px;border-top:0px None #000;border-right:0px None #000;border-bottom:0px None #000;border-left:0px None #000;" width="auto" valign="middle" height="60" bgcolor="#08453F" align="center">
                                                                                <span style="color:#ffffff; font-weight:normal;">
                                                                                        <a style="text-decoration:none; color:#ffffff; font-weight:normal;" href="' . Config::read('domaine') . '/Admin/changementMdpAdmin.php?Id=' . $recuperation . '"><strong>&gt; Modifier mon mot de passe</strong></a>
                                                                                    </span>
                                                                            </td>
                                                                        </tr></tbody></table>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                        </th>
                                                </tr>
                                            </tbody></table></td>
                                    </tr> 
                                    <tr>
                                        <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                    </tr>
                                </tbody></table>
                                                            
                            </td>
                        </tr>
                    </tbody></table>
                    <!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_35" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_35"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:\'Calibri\',\'Georgia\',serif, sans-serif; color:#999;"><div>
        <div style="text-align: justify;"><span style="font-size:16px;"><span style="color:#000000;">Ce message est une réponse automatique, veuillez ne pas répondre à ce mail.</span></span></div>
                                                            
        <div style="text-align: justify;"><span style="color:#000000;"><span style="font-size:16px;">Nous vous remercions de votre compréhension et n</span></span><span style="color:#000000;"><span style="font-size:16px;">otre équipe reste mobilisée pour vous accompagner.</span></span><br>
        &nbsp;</div>
                                                            
        <div style="text-align: justify;">&nbsp;</div>
                                                            
        <div style="text-align: justify;">&nbsp;</div>
                                                            
        <div style="text-align: right;"><span style="font-size:16px;"><span style="color:#000000;">L\'équipe Adico</span></span></div>
        </div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:5px; mso-hide: all;" height="5">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_31" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_31"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 5px solid rgb(8, 69, 63);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"></td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr><tr>
                                                            
                <td valign="top" align="center">
                                                            
                    <div style="background-color: rgb(255, 255, 255); border-radius: 0px;">
                                                            
                        <!--[if mso]>
                        <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
                        <tr>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        <td valign="top" width="590" style="width:590px;">
                        <![endif]-->
                        <table class="rnb-del-min-width" style="min-width:100%;" name="Layout_32" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td class="rnb-del-min-width" valign="top" align="center">
                                <a href="#" name="Layout_32"></a>
                                <table class="rnb-container" style="background-color: rgb(255, 255, 255); padding-left: 20px; padding-right: 20px; border-collapse: separate; border-radius: 0px; border-bottom: 0px none rgb(200, 200, 200);" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
                                                            
                                                <tbody><tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="rnb-container-padding" valign="top" align="left">
                                                            
                                                        <table class="rnb-columns-container" width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody><tr>
                                                                <th class="rnb-force-col" style="text-align: left; font-weight: normal; padding-right: 0px;" valign="top">
                                                            
                                                                    <table valign="top" class="rnb-col-1" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                                                            
                                                                        <tbody><tr>
                                                                            <td style="font-size:14px; font-family:Arial,Helvetica,sans-serif, sans-serif; color:#3c4858;"><div style="text-align: center;"><br>
        Association pour le développement et l\'innovation numérique des collectivités<br>
        PAE du Tilloy - 5 rue Jean Monnet - 60006 Beauvais cedex<br>
        Tél. : 03 44 08 40 40 - contact@adico.fr<br>
        www.adico.fr</div>
                                                            
        <div style="text-align: center;">--<br>
        © 2022 Adico</div>
        </td>
                                                                        </tr>
                                                                        </tbody></table>
                                                            
                                                                    </th></tr>
                                                        </tbody></table></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size:1px; line-height:20px; mso-hide: all;" height="20">&nbsp;</td>
                                                </tr>
                                            </tbody></table>
                            </td>
                        </tr>
                    </tbody></table><!--[if mso]>
                        </td>
                        <![endif]-->
                                                            
                        <!--[if mso]>
                        </tr>
                        </table>
                        <![endif]-->
                                                            
                    </div></td>
            </tr></tbody></table>
                    <!--[if gte mso 9]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                </tr>
                </tbody></table>
                                                            
        </body></html>';

        static::SendMail($mail, $HtmlContenu, $objet);
    }
}
