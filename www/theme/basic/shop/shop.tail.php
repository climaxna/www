<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
    return;
}

$admin = get_admin("super");

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>

    </div>
    <!-- } 콘텐츠 끝 -->

<!-- 하단 시작 { -->
</div>

<div id="ft">
    <div class="ft_wr">
        <ul class="ft_ul">
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice">고객센터</a></li>
        </ul>
        
        <ul class="ft_customer">
          <li>
            <h2>고객만족센터</h2>
            <h3><i class="fa fa-phone" aria-hidden="true"></i> 1877.7727</h3>
            <div>
              <p>평일 오전 10:00 ~ 오후 06:00</p>
              <p>점심 오후 12:00 ~ 오후 01:00</p>
              <p>휴무 토/일/공휴일은 휴무</p>
            </div>
          </li>
          
          <li>
            <h2>은행계좌안내</h2>
            <div>
              <p><img src="/theme/basic/img/nh.png" /></p>
              <p>예금주 : 박재근[유황시대]</p>
              <p>351-1161-4227-83</p>
              <p>
                 <select>
                   <option>인터넷뱅킹 바로가기</option>
                 </select>
              </p>
            </div>
          </li>
          
          <li id="notice"><?php echo latest('theme/basic', notice, 6, 24); ?></li>
          
          <li id="quick">
            <h2>빠른메뉴</h2>
            <div>
			  <a href="">자주 묻는 질문</a>
              <a href="">고객만족센터</a>
              <a href="">회원등급안내</a>
            </div>
          </li>
        </ul>

        <div class="ft_info">
            <h3><img src="/theme/basic/img/logo.png" /></h3>
            <div>
            <span><font>회사명</font> <?php echo $default['de_admin_company_name']; ?></span> | 
            <span><font>대표</font> <?php echo $default['de_admin_company_owner']; ?></span> | 
            <span><font>대표전화</font> <?php echo $default['de_admin_company_tel']; ?></span>
            
            <br>
            
            <span><font>주소</font> <?php echo $default['de_admin_company_addr']; ?></span>
            
            <br>
            
            <span><font>사업자 등록번호</font> <?php echo $default['de_admin_company_saupja_no']; ?> <a href="">사업자등록확인</a></span> | 
            <span><font>통신판매업신고번호</font> <?php echo $default['de_admin_tongsin_no']; ?></span>
            
            <br>
            
            <span><font>개인정보 보호책임자</font> <?php echo $default['de_admin_info_name']; ?></span>
            </div> 
        </div>
        
        <div class="ft_copy">Copyright &copy; <b>2001-2013 <?php echo $default['de_admin_company_name']; ?></b>. All Rights Reserved.</div>

        <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
        <script>
        
        $(function() {
            $("#top_btn").on("click", function() {
                $("html, body").animate({scrollTop:0}, '500');
                return false;
            });
        });
        </script>
    </div>


</div>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
<!-- } 하단 끝 -->

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
