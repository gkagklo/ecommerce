<html>
    <head>
        <title>Recover Password</title>
    </head>
    <body>
        <table>
            <tr><td> Dear {{ $username }} ! </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td> Your account has been successfully updated. <br>
            Your account information is as below with new password:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td> Username: {{ $username }} </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>New Password: {{ $password }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td> Thanks & Regards,</td></tr>
            <tr><td> E-com Website </td></tr>
        </table>
    </body>
</html>