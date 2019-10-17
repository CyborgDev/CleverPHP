<?php
    class ECMailer {
        /* Section constantes */
        const CONTENT_TYPE_TEXT_HTML = 'text/html';
        const CHARSET_UTF8 = 'utf8';

        const EC_FAKE_NAME = 'Espace Clients CEGAPE';
        const EC_FAKE_MAIL = 'no-reply.espaceclients@cegape.fr';

        const MAIL_FRAME_BEGINING = '
            <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252"><meta name="Generator" content="Microsoft Word 15 (filtered medium)">
                    <!--[if !mso]>
                        <style>
                            v\:* {behavior:url(#default#VML);}
                            o\:* {behavior:url(#default#VML);}
                            w\:* {behavior:url(#default#VML);}
                            .shape {behavior:url(#default#VML);}
                        </style>
                    <![endif]-->
                    <style>
                        <!--
                            /* Font Definitions */
                            @font-face
                                {font-family:"Cambria Math";
                                panose-1:2 4 5 3 5 4 6 3 2 4;}
                            @font-face
                                {font-family:Calibri;
                                panose-1:2 15 5 2 2 2 4 3 2 4;}
                            @font-face
                                {font-family:Georgia;
                                panose-1:2 4 5 2 5 4 5 2 3 3;}
                            @font-face
                                {font-family:"Franklin Gothic Book";
                                panose-1:2 11 5 3 2 1 2 2 2 4;}
                            /* Style Definitions */
                            p.MsoNormal, li.MsoNormal, div.MsoNormal
                                {margin:0cm;
                                margin-bottom:.0001pt;
                                font-size:11.0pt;
                                font-family:"Calibri",sans-serif;
                                mso-fareast-language:EN-US;}
                            a:link, span.MsoHyperlink
                                {mso-style-priority:99;
                                color:#0563C1;
                                text-decoration:underline;}
                            a:visited, span.MsoHyperlinkFollowed
                                {mso-style-priority:99;
                                color:#954F72;
                                text-decoration:underline;}
                            span.EmailStyle17
                                {mso-style-type:personal-compose;
                                font-family:"Calibri",sans-serif;
                                color:windowtext;}
                            .MsoChpDefault
                                {mso-style-type:export-only;
                                font-family:"Calibri",sans-serif;
                                mso-fareast-language:EN-US;}
                            @page WordSection1
                                {size:612.0pt 792.0pt;
                                margin:70.85pt 70.85pt 70.85pt 70.85pt;}
                            div.WordSection1
                                {page:WordSection1;}
                        -->
                    </style>
                    <!--[if gte mso 9]>
                        <xml>
                            <o:shapedefaults v:ext="edit" spidmax="1026" />
                        </xml>
                    <![endif]-->
                    <!--[if gte mso 9]>
                        <xml>
                            <o:shapelayout v:ext="edit">
                            <o:idmap v:ext="edit" data="1" />
                            </o:shapelayout>
                        </xml>
                    <![endif]-->
                </head>
                <body lang="FR" link="#0563C1" vlink="#954F72">
                    <div class="WordSection1">';
        const MAIL_FRAME_ENDING = '
                        <p class="MsoNormal">
                            <span style="font-size:12.0pt;font-family:&quot;Georgia&quot;,serif;color:#00AEEF;mso-fareast-language:IT">
                                L\'équipe CEGAPE<o:p></o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                Support Logiciel et Juridique<o:p></o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span style="font-size:4.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                <o:p>&nbsp;</o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <b>
                                <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                    Tel&nbsp;: 
                                </span>
                            </b>
                            <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                01 53 29 93 00<b><o:p></o:p></b>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <b>
                                <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                    Mail : 
                                </span>
                            </b>
                            <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                infocegape@cegape.fr<o:p></o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span style="font-size:4.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                <o:p>&nbsp;</o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                CEGAPE<o:p></o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                185 avenue des Grésillons <o:p></o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                92622 Gennevilliers Cedex <o:p></o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <span lang="IT" style="font-size:10.0pt;font-family:&quot;Franklin Gothic Book&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                <o:p>&nbsp;</o:p>
                            </span>
                        </p>
                        <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="602" style="width:451.5pt;border-collapse:collapse">
                            <tr style="page-break-inside:avoid">
                                <td width="602" colspan="5" valign="top" style="width:451.5pt;padding:3.75pt 0cm 3.75pt 0cm">
                                    <p class="MsoNormal" style="line-height:105%">
                                        <span style="font-size:1.0pt;line-height:105%;color:#666E7E;mso-fareast-language:FR">
                                            <img width="600" height="10" style="width:6.25in;height:.1041in" id="Image_x0020_1" src="https://espaceclients.cegape.fr/webroot/pictures/mail_signature_line.png" alt="Ligne bleue">
                                        </span>
                                        <b>
                                            <span style="font-size:1.0pt;line-height:105%;font-family:&quot;Arial&quot;,sans-serif;color:#00AEEF">
                                                <o:p></o:p>
                                            </span>
                                        </b>
                                    </p>
                                </td>
                            </tr>
                            <tr style="page-break-inside:avoid">
                                <td width="293" style="width:219.8pt;padding:3.75pt 0cm 3.75pt 0cm">
                                    <p class="MsoNormal" style="line-height:105%">
                                        <span style="font-size:1.0pt;line-height:105%;color:#666E7E;mso-fareast-language:FR">
                                            <img width="108" height="47" style="width:1.125in;height:.493in" id="Image_x0020_2" src="https://espaceclients.cegape.fr/webroot/pictures/mail_signature_logo_cegape.png" alt="Logo CEGAPE">
                                        </span>
                                        <span style="font-size:1.0pt;line-height:105%;color:#666E7E;mso-fareast-language:IT">
                                            <o:p></o:p>
                                        </span>
                                    </p>
                                </td>
                                <td width="229" style="width:171.7pt;padding:3.75pt 3.75pt 3.75pt 0cm">
                                    <p class="MsoNormal" align="right" style="text-align:right;line-height:105%">
                                        <b>
                                            <u>
                                                <span style="font-size:10.0pt;line-height:105%;font-family:&quot;Arial&quot;,sans-serif;color:#00AEEF;mso-fareast-language:IT">
                                                    <a href="https://www.cegape.fr/"  title="Site internet Ayming France">
                                                        <span style="color:#00AEEF">
                                                            cegape.fr
                                                        </span>
                                                    </a>
                                                </span>
                                            </u>
                                        </b>
                                        <span style="color:#00AEEF;mso-fareast-language:IT">
                                            <o:p></o:p>
                                        </span>
                                    </p>
                                </td>
                                <td width="35" style="width:26.25pt;padding:3.75pt 0cm 3.75pt 0cm">
                                    <p class="MsoNormal" style="line-height:105%">
                                        <a href="https://www.linkedin.com/company/cegape/">
                                            <span style="color:#0563C1;mso-fareast-language:FR;text-decoration:none">
                                                <img border="0" width="24" height="24" style="width:.25in;height:.25in" id="Image_x0020_3" src="https://espaceclients.cegape.fr/webroot/pictures/mail_signature_logo_linkedin.png" alt="Logo LinkedIn">
                                            </span>
                                        </a>
                                        <span style="color:#00AEEF;mso-fareast-language:IT">
                                            <o:p></o:p>
                                        </span>
                                    </p>
                                </td>
                                <td width="35" style="width:26.25pt;padding:3.75pt 0cm 3.75pt 0cm">
                                    <p class="MsoNormal" style="line-height:105%">
                                        <a href="https://twitter.com/ayming_fr">
                                            <b>
                                                <span style="font-size:1.0pt;line-height:105%;font-family:&quot;Arial&quot;,sans-serif;color:#666E7E;mso-fareast-language:FR;text-decoration:none">
                                                    <img border="0" width="24" height="24" style="width:.25in;height:.25in" id="Image_x0020_4" src="https://espaceclients.cegape.fr/webroot/pictures/mail_signature_logo_twitter.png" alt="Logo Twitter">
                                                </span>
                                            </b>
                                        </a>
                                        <b>
                                            <span style="font-size:1.0pt;line-height:105%;font-family:&quot;Arial&quot;,sans-serif;color:#666E7E;mso-fareast-language:IT">
                                                <o:p></o:p>
                                            </span>
                                        </b>
                                    </p>
                                </td>
                                <td width="10" style="width:7.5pt;padding:0cm 0cm 0cm 0cm">
                                    <p class="MsoNormal" style="line-height:105%">
                                        <span style="color:#1F497D;mso-fareast-language:IT">
                                            &nbsp;
                                        </span>
                                        <span style="color:#1F497D;mso-fareast-language:IT">
                                            <o:p></o:p>
                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <p class="MsoNormal">
                            <span style="mso-fareast-language:FR">
                                <o:p>&nbsp;</o:p>
                            </span>
                        </p>
                        <p class="MsoNormal">
                            <o:p>&nbsp;</o:p>
                        </p>
                    </div>
                    <small>Ce mail a été envoyé automatiquement, il est inutile d\'y répondre.</small>
                </body>
            </html>';
        /* ----------------- */

        /* Section variables */
            private $_to;
            private $_subject;
            private $_message;
            private $_headers;
        /* ----------------- */

        public function __construct(string $content_type = self::CONTENT_TYPE_TEXT_HTML, string $charset = self::CHARSET_UTF8){
            $this->_to = array();
            $this->_headers[] = 'MIME-Version: 1.0';
            $this->_headers[] = 'Content-type: '.$content_type.'; charset='.$charset;
            $this->_headers['to'] = 'To: ';
            $this->_headers['from'] = 'From: ';
            $this->_headers['cc'] = 'Cc: ';
        }

        /* Section fonctions */
            private static function valid_email($str) {
                return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
            }

            public function setSubject(string $subject){
                if($subject == NULL || $subject == '') throw new Exception("L'objet du mail est trop court.", 1);
                if(strlen($subject) > 255) throw new Exception("L'objet du mail est trop long.", 2);
                $this->_subject = $subject;
            }

            public function setMessage(string $message){
                if($message == NULL || $message == '') throw new Exception("Le message du mail est trop court.", 3);
                $this->_message = self::MAIL_FRAME_BEGINING.$message.self::MAIL_FRAME_ENDING;
            }

            public function setSender(string $email, string $name = NULL){
                if(!self::valid_email($email)) throw new Exception("L'adresse mail n'a pas le bon format.");
                $stampSender = '';
                if($name != NULL){
                    $stampSender = $name.' <'.$email.'>';
                } else {
                    $stampSender = ' <'.$email.'>';
                }

                $this->_headers['from'] = $this->_headers['from'].$stampSender;
            }

            public function addNewRecipient(string $email, string $name = NULL){
                if(!self::valid_email($email)) throw new Exception("L'adresse mail n'a pas le bon format.");
                $this->_to[] = $email;
                $stampRecipient = '';
                if($name != NULL){
                    $stampRecipient = $name.' <'.$email.'>';
                } else {
                    $stampRecipient = ' <'.$email.'>';
                }

                if(strlen($this->_headers['to']) == 4){
                    $this->_headers['to'] = $this->_headers['to'].$stampRecipient;
                } else {
                    $this->_headers['to'] = $this->_headers['to'].', '.$stampRecipient;
                }
            }

            public function addNewCarbonCopy(string $email, string $name = NULL){
                if(!self::valid_email($email)) throw new Exception("L'adresse mail n'a pas le bon format.");
                $stampCarbonCopy = '';
                if($name != NULL){
                    $stampCarbonCopy = $name.' <'.$email.'>';
                } else {
                    $stampCarbonCopy = ' <'.$email.'>';
                }

                if(strlen($this->_headers['cc']) == 4){
                    $this->_headers['cc'] = $this->_headers['cc'].$stampCarbonCopy;
                } else {
                    $this->_headers['cc'] = $this->_headers['cc'].', '.$stampCarbonCopy;
                }
            }

            public function send(){
                if(strlen($this->_headers['to']) == 4 || count($this->_to) == 0) throw new Exception("Aucun destinataire detecté.", 101);
                if(strlen($this->_headers['from']) == 7) throw new Exception("Aucun expediteur detecté.", 102);
                if(strlen($this->_headers['cc']) <= 4) unset($this->_headers['cc']);
                if($this->_subject == NULL || strlen($this->_subject) == '') throw new Exception("Aucun objet detecté.", 103);
                if($this->_message == NULL || strlen($this->_message) == '') throw new Exception("Aucun message detecté.", 104);

                return mail(implode(', ', $this->_to), $this->_subject, $this->_message, implode("\r\n", $this->_headers));
            }
        /* ----------------- */
    }
?>