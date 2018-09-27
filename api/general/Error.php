<?php

    class Errors {

        public function getErrorPage($errorCode, $errorTitle, $errorString) {

            $htmlString = '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            
                <!-- bootstrap links -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            
                <!-- title will be error code -->
                <title> ' . $errorCode . ' ' . $errorTitle . ' </title>
            </head>
            <body>
                <div class="container-fluid text-center">
                    <div class="row">
                        <div class="col-12">
                            <h1 style="font-size:128px;">' . $errorCode . '</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2>' . $errorTitle . '</h5>
                        </div>
                    </div>
                    <div class="row w-25">
                        <div class="col-12">
                            <h4>' . $errorString . '</h4>
                        </div>
                    </div>
                </div>
            </body>
            </html>';
            return $htmlString;
        }
    }