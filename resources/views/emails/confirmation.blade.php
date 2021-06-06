<html>
    <head>
        <title>Register Email</title>
        <style>
        .button {
            background-color: orange;
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
          }
          </style>
    </head>
    <body>
        <table align="center">
            <tr><td><h1>Welcome to E-com Website</h1></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td> Dear {{ $name }}, </td></tr>
            <tr><td>Thank you for creating an account.</td></tr>
            <tr><td>Please click on below link to activate your account:</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>
            <a href="{{ url('confirm/'.$code) }}">
            <button  type="submit" class="button" style="text-align: center">Confirm Account</button></a>
        </td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td> Thanks & Regards,</td></tr>
            <tr><td> E-com Website </td></tr>
        </table>
    </body>
</html>