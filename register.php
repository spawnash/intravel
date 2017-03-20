<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>註冊</title>
<!--
Holiday Template
http://www.templatemo.com/tm-475-holiday
-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700" rel='stylesheet' type='text/css'>
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">  
	<link href="css/flexslider.css" rel="stylesheet">
	<link href="css/templatemo-style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
	<!-- Header -->
    <?php include_once 'php/menu.php'; ?>
	
	<!-- white bg -->
	<section class="section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">註冊</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 thumbnail">
                <!-- contact form -->
                    <form class="form-horizontal" id="register_form" method="post" action="php/add_member.php">
                        <div class="form-group">
                            <label for="username" class="col-sm-4 control-label">帳號</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="username" id="username" placeholder="請輸入您的帳號" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">密碼</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="請設定密碼" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="col-sm-4 control-label">密碼確認</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="confirm_password" placeholder="請再次輸入一樣的密碼" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">暱稱</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name" id="name" placeholder="請輸入您的暱稱" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-default">確認</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</section>
    <?php include_once 'php/footer.php'?>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>			<!-- flexslider js -->
	<script type="text/javascript" src="js/templatemo-script.js"></script>      		<!-- Templatemo Script -->
    <script>
        $(document).on("ready", function(){

            $("#username").on("keyup", function(){
            if($(this).val() != '')
            {
                //$.ajax 是 jQuery 的方法，裡面使用的是物件。
                $.ajax({
                    type : "POST",	//表單傳送的方式 同 form 的 method 屬性
                    url : "php/check_username.php",  //目標給哪個檔案 同 form 的 action 屬性
                    data : {	//為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
                        n : $(this).val()	//代表要傳一個 n 變數值為，username 文字方塊裡的值
                    },
                    dataType : 'html' //設定該網頁回應的會是 html 格式
                }).done(function(data) {
                    //成功的時候
                    //console.log(data); //透過 console 看回傳的結果
                    if(data == "yes")
                    {
                        alert("帳號有重複，不可以註冊");
                        $("#username").parent().parent().removeClass("has-success").addClass("has-error");
                        //把註冊按鈕加上 disabled 不能按，在bootstrap裡 disabled 類別可以讓該元素無法操作
                        //$("#register_form button").attr('disabled', true);
                        $("#register_form button[type='submit']").addClass('disabled');
                    }
                    else
                    {
                        //如果為 yes username 文字方塊的復元素先移除 has-error 類別，再加入 has-success 類別
                        $("#username").parent().parent().removeClass("has-error").addClass("has-success");
                        //把註冊按鈕 disabled 類別移除，讓他可以按註冊
                        //$("#register_form button").attr('disabled', false);
                        $("#register_form button[type='submit']").removeClass('disabled');
                    }

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //失敗的時候
                    alert("有錯誤產生，請看 console log");
                    console.log(jqXHR.responseText);
                });
            }
            else
            {
                //若為空字串，就移除 has-error 跟 has-success 類別
                $("#username").parent().parent().removeClass("has-success").removeClass("has-error");
                $("#register_form button[type='submit']").removeClass('disabled');
                //$("#register_form button").attr('disabled', false);
            }
            });



            $("#register_form").on("submit", function() {
                if($("#password").val() != $("#confirm_password").val())
                {
                    $("#password").parent().parent().addClass('has-error');
                    $("#confirm_password").parent().parent().addClass('has-error');

                    alert("密碼確認錯誤")
                }
                else
                {
                    $.ajax({
                        type : "POST",	//表單傳送的方式 同 form 的 method 屬性
                        url : "php/add_user.php",  //目標給哪個檔案 同 form 的 action 屬性
                        data : {	//為要傳過去的資料，使用物件方式呈現，因為變數key值為英文的關係，所以用物件方式送。ex: {name : "輸入的名字", password : "輸入的密碼"}
                            un : $("#username").val(),
                            pw : $("#password").val(),
                            n : $("#name").val()
                        },
                        dataType : 'html' //設定該網頁回應的會是 html 格式
                    }).done(function(data) {
                        //成功的時候
                        console.log(data); //透過 console 看回傳的結果
                        if(data == "yes")
                        {
                            alert("註冊成功,請按確認");
                            window.location.href = "admin/index.php";
                        }
                        else
                        {
                            alert("註冊失敗");
                        }

                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        //失敗的時候
                        alert("有錯誤產生，請看 console log");
                        console.log(jqXHR.responseText);
                    });
                }
                return false;
            });
        });
    </script>
</body>
</html>
