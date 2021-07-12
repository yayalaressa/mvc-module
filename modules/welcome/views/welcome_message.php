<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to MS-MVC</title>

    <style type="text/css">
         ::selection {
            background-color: #E13300;
            color: white;
        }
        
         ::-moz-selection {
            background-color: #E13300;
            color: white;
        }
        
        body {
            background-color: #222;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #fff;
        }
        
        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }
        
        h1 {
            color: #fff;
            background-color: transparent;
            border-bottom: 1px solid #fff;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }
        
        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #333;
            border: 1px solid #fff;
            color: #fff;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }
        
        #body {
            margin: 0 15px 0 15px;
        }
        
        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }
        
        #container {
            margin: 10px;
            border: 1px solid #fff;
        }
    </style>
</head>

<body>
    <div id="container">
        <h1>Welcome to MS-MVC</h1>
        <div id="body">
            <p>Halaman ini hanya contoh.</p>
            <p>Jika kamu ingin mengedit halaman ini kamu dapat menemukannya di:</p>
            <code>modules/welcome/views/welcome.php</code>
            <p>Controller yang sesuai untuk halaman ini ditemukan di:</p>
            <code>modules/welcome/controllers/welcome.php</code>
        </div>
    </div>
</body>

</html>