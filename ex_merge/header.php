<link rel="stylesheet" type="text/css" href="http://uraman.m-hosting.kr/ex_merge/style.css">
<div id="header-box">
    <div id="header">
        <?
            if(isset($_SESSION['login'])){
                $nickname = get_userinfo_by_id($_SESSION['login'],'nickname');
                echo '<span style="font-weight:bold">반갑습니다, '.$nickname.' 님.</span>  ';
                echo '<input class="button-header-mini" type="button" value="로그아웃" onclick="'."location.href='http://uraman.m-hosting.kr/ex_merge/login/logout_process.php'".'">';
            }else{
                echo '<input class="button-header-mini" type="button" value="로그인" onclick="'."location.href='http://uraman.m-hosting.kr/ex_merge/login/'".'">  ';
                echo '<input class="button-header-mini" type="button" value="회원가입" onclick="'."location.href='http://uraman.m-hosting.kr/ex_merge/join'".'">';
            }
        ?>
    </div>
</div>
