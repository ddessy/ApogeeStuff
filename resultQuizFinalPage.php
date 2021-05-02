<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
  <div style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
      <div class="panel-heading">
        <div class="panel-title">Приключване на анкетата</div>

      </div>

      <div style="padding-top:30px" class="panel-body">

        Ако искаш да ти изпратим информация за твоя стил на учене и на играене, въведи тук твоя е-мейл адрес:
      </div>
      <div style="padding-top:5px" class="panel-body">

        <div style="display:none" id="send-result-alert" class="alert alert-danger col-sm-12"></div>
        <form id="sendResultForm" class="form-horizontal" role="form" action="sendMail.php" method="post">
          <div id="sendResultForm-error"
               style="font-size: 85%;color: #ff0000; padding-bottom: 10px;margin-top: -10px;"></div>
          <div style="margin-bottom: 25px" class="inputs">
            <input id="sendResultForm-email" type="text" class="form-control" name="email" value="" placeholder="email">
          </div>
          <div class="input-group">
            <button type="submit" class="btn" id="reg_user" name="reg_user"
                    style="margin-bottom: 15px;background-color: rgb(63, 81, 181);border-color: rgb(63, 81, 181);color:#fff;padding: 6px 40px;">Submit
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
</body>
</html>
