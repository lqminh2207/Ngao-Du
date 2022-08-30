<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MoMo Sandbox</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="./statics/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"/>
    <!-- CSS -->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Initial payment/Khởi tạo thanh toán</h3>
                </div>
                <div class="panel-body">
                    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                          action="{{ route('momoPayment') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">PartnerCode</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="partnerCode" value="<?php echo $partnerCode; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">AccessKey</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="accessKey" value="<?php echo $accessKey;?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">SecretKey</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="secretKey" value="<?php echo $secretKey; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">OrderId</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderId" value="<?php echo $orderId; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">ExtraData</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' type="text" name="extraData" value="<?php echo $extraData?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">OrderInfo</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="orderInfo" value="<?php echo $orderInfo; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">Amount</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="amount" value="<?php echo $amount; ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">IpnUrl</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="ipnUrl" value="<?php echo $ipnUrl; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fxRate" class="col-form-label">RedirectUrl</label>
                                    <div class='input-group date' id='fxRate'>
                                        <input type='text' name="redirectUrl" value="<?php echo $redirectUrl; ?>"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>
                        <div style="margin-top: 1em;">
                            <button type="submit" class="btn btn-primary btn-block">Start MoMo payment....</button>
                        </div>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="./statics/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="./statics/moment/min/moment.min.js"></script>
</html>