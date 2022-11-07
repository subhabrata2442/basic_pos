<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
    style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">

<head>
    <meta http-equiv="Content-Security-Policy"
        content="script-src 'none'; connect-src 'none'; object-src 'none'; form-action 'none';">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <!-- fab -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- fab -->
    <title>Fire Fighter</title>

</head>

<body style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;padding:0;Margin:0">
    <table
        style="width: 100%; max-width: 600px; margin: 100px auto 0; border-spacing: 0px; background-color: #f2f4f6; border-collapse: collapse;">
        <thead>
            <tr style="padding: 0;">
                <th style="padding: 10px 0; background-color: #f5f5f5;">
                    <a href="#" target="_blank"
                        style="display: block; text-decoration: none; display: inline-block;"><img
                            src="{{ asset('assets/img/firefighter_logo.png') }}" alt="firefighter logo"
                            width="100"></a>
                </th>
            </tr>
        </thead>
    </table>
    <table
        style="width: 100%; max-width: 600px; margin: 0 auto; border-spacing: 0px; background-color: #ffffff; border-collapse: collapse;">
        <tbody>
            <tr>
                <td colspan="4">
                    <table
                        style="width: 100%; border-collapse: collapse; text-align: center; max-width: 500px; margin: 0 auto;">
                        <tr>
                            <td style="padding: 30px 0 10px 0;">
                                <h3 style="font-size: 30px; font-weight: 600; color: #ec8b16; margin: 0;">Your OTP</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 15px; color: #17132a; margin: 0; padding: 0;">
                                    <strong>Hello</strong>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 15px; color: #17132a; margin: 0; padding: 0;"><strong>Please use
                                        the verification code below on the FireFighter website</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3
                                    style="font-size: 60px; letter-spacing: 7px; font-weight: 600; color: #ec8b16; margin: 0; padding: 10px 0;">
                                    {{ $otp }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 15px; color: #17132a; margin: 0; padding: 0;"><strong>if you didn't
                                        request this, you can ignore this email or let us know</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 15px; color: #17132a; margin: 0; padding: 0;">
                                    <strong>Thanks!</strong>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 10px;">
                                <p style="font-size: 15px; color: #17132a; margin: 0; padding: 0;"><strong>FireFighter
                                        team</strong></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%; max-width: 600px; margin: 0 auto; border-spacing: 0px; border-collapse: collapse;">
        <tfoot>
            <tr>
                <td style="padding: 10px; background-color: #17132a;">
                    <p style="font-size: 14px; color: #fff; padding-top: 0px; margin: 0; text-align: center;">&copy;
                        Copyright FireFighter, All rights reserved.</p>
                </td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
