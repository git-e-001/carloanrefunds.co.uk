<html>
    <head>
        <style type="text/css">
            table td {
                border: 1px solid black;
                padding: 3px;
            }

            body, table {
                font-family: sans-serif;
            }

            .sig {
                font-family: cursive;
            }

            .signature-container {
                display: inline-block;
                vertical-align: bottom;
                font-weight: normal;
                padding: 0 20px 10px 20px;
                margin-left: 30px;
                margin-top: 40px;
                margin-right: 30px;
                border-bottom: 3px solid #8B8B88;
                min-height: 40px;
                word-wrap: break-word;
                max-width: 60%;
                text-align: center;
            }

            li{
                margin-bottom: 16px;
            }

            .p-spacer{
                display:block;
                color:white;
                line-height: 100%;
            }

            div.indented{
                margin: 0px;
                margin-top: -10px;
                margin-left: 20px;
            }

            div.indented .p-spacer{
                line-height: 60%;
                display:none;
            }

        </style>
    </head>

    <body>
        @yield('content')
    </body>
</html>
