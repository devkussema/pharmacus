@extends('default.email')

@section('conteudo')
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        @include('components._emailLogo')
        <!-- HERO -->
        <tr>
            <td align="center" style="padding: 0px 10px 0px 10px;">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top"
                            style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #ff4c52; font-family: 'Poppins', sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 2px; line-height: 48px;">
                            <h1 style="font-size: 36px; font-weight: 600; margin: 0;">Saudações</h1>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <!-- COPY BLOCK -->
        <tr>
            <td align="center" style="padding: 0px 10px 0px 10px;">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Olá,</p>
                            <p style="margin: 0;">Você está a um passo de começar a usar nosso serviço.
                                Clique no botão abaixo para confirmar seu e-mail e concluir o processo de criação de conta:
                            </p>
                        </td>
                    </tr>
                    <!-- BULLETPROOF BUTTON -->
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 3px;" bgcolor="#ff4c52">
                                                    <a href="#" target="_blank"
                                                        style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 12px 50px; border-radius: 2px; border: 1px solid #ff4c52; display: inline-block;">
                                                        Confirmar
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 20px 30px; color: #aaaaaa; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0; text-align: center;">
                                Se você não solicitou esta criação de conta, por favor, ignore este e-mail.
                            </p>
                        </td>
                    </tr>
                    <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left"
                            style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 0px 0px; color: #666666; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Saudações,<br>A equipa de software</p>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
        <!-- FOOTER -->
        <tr>
            <td align="center" style="padding: 10px 10px 50px 10px;">
                <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
            {{-- O footer --}}
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
            </td>
        </tr>
    </table>
@endsection
