<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


$select = G5_TIME_YMD;
list($year, $month, $date) = explode('-', $select);
$start = '01';
$end = date('t', strtotime($select . ' 00:00:00'));


$sqls = " SELECT * FROM g5_write_tournament WHERE ((wr_3 <= '{$year}-{$month}-{$start}') AND (wr_4 >= '{$year}-{$month}-{$start}')) ";
$results = sql_query($sqls);
?>

<style>
#bo_list .bo_list_box {}
#bo_list .bo_list_box li { padding:0; border:1px solid #ddd; border-left:3px solid #09C; box-shadow:0 0 10px rgba(0,0,0,0.1); margin:5px 0; display:flex; }
#bo_list .bo_list_box li .bo_tits { width:300px; font-size:21px; color:#333; font-family:'GS_M'; height:60px; line-height:60px; text-align:center; }
#bo_list .bo_list_box li .bo_date { width:calc(100% - 750px); height:60px; line-height:60px; font-size:14px; border-left:1px solid #ddd; border-right:1px solid #ddd; text-align:center; }
#bo_list .bo_list_box li .bo_btns { width:450px; line-height:60px; text-align:center; }
#bo_list .bo_list_box li .bo_btns a { display:inline-block; vertical-align:middle; background-color:#09C; color:#fff; width:90px; height:30px; line-height:30px; text-align:center; border-radius:5px; }
#bo_list .bo_list_box .empty_table { text-align:center; display:block; }
</style>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->
    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
      <ul class="bo_list_box">
        <?php for ($i=0; $rows = sql_fetch_array($results); $i++) { ?>
        <li>
            <div class="bo_tits">
              <a href=""><?php echo $rows['wr_subject'] ?></a>
              <p class="bo_date">참가접수기간 : <?php echo $rows['wr_6'] ?> ~ <?php echo $rows['wr_7'] ?></p>
            </div>
            
            <section style="display:none;">
            <table>
            <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <thead>
            <tr>
                <?php if ($is_checkbox) { ?>
                <th scope="col" class="all_chk chk_box">
                    <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" class="selec_chk">
                    <label for="chkall">
                        <span></span>
                        <b class="sound_only">현재 페이지 게시물  전체선택</b>
                    </label>
                </th>
                <?php } ?>
                <th scope="col">순위</th>
                <th scope="col">구분</th>
                <th scope="col">이름</th>
                <th scope="col">팀</th>
                <th scope="col">이름</th>
                <th scope="col">팀</th>
            </tr>
            </thead>
            <tbody>
            <?php
			for ($i=0; $i<count($list); $i++) {
				if ($i%2==0) $lt_class = "even";
				else $lt_class = "";
			?>
            <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?>">
				<?php if ($is_checkbox) { ?>
                <td class="td_chk chk_box">
                    <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" class="selec_chk">
                    <label for="chk_wr_id_<?php echo $i ?>">
                        <span></span>
                        <b class="sound_only"><?php echo $list[$i]['subject'] ?></b>
                    </label>
                </td>
                <?php } ?>
                <td class="td_num2">
                <?php
                if ($list[$i]['is_notice']) // 공지사항
                    echo '<strong class="notice_icon">공지</strong>';
                else if ($wr_id == $list[$i]['wr_id'])
                    echo "<span class=\"bo_current\">열람중</span>";
                else
                    echo $list[$i]['num'];
                 ?>
                </td>
    
                <td class="td_subject" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                    <?php
                    if ($is_category && $list[$i]['ca_name']) {
                    ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <div class="bo_tit"><a href="<?php echo $list[$i]['href'] ?>"><?php echo $list[$i]['subject'] ?></a></div>
                </td>
                <td class="td_name sv_use"><?php echo $list[$i]['name'] ?></td>
                <td class="td_num"><?php echo $list[$i]['wr_hit'] ?></td>
                <td class="td_datetime"><?php echo $list[$i]['datetime2'] ?></td>
                <td class="td_datetime"><?php echo $list[$i]['datetime2'] ?></td>
            </tr>
            <?php } ?>
            <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
            </tbody>
            </table>
            </section>
        </li>
        <?php } ?>
        <?php if ($i == 0) { echo '<li class="empty_table">종료된 대회결과가 없습니다.</li>'; } ?>
      </ul>
    </div>
	
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
        	<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn" title="관리자"><i class="fa fa-cog fa-spin fa-fw"></i><span class="sound_only">관리자</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">정보입력</span></a></li><?php } ?>
        </ul>	
        <?php } ?>
    </div>
    <?php } ?>   
    </form>

    <!-- 게시판 검색 시작 { -->
    <div class="bo_sch_wrap">
        <fieldset class="bo_sch">
            <h3>검색</h3>
            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <?php echo get_board_sfl_select_options($sfl); ?>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <div class="sch_bar">
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </div>
            <button type="button" class="bo_sch_cls" title="닫기"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>
            </form>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <script>
    jQuery(function($){
        // 게시판 검색
        $(".btn_bo_sch").on("click", function() {
            $(".bo_sch_wrap").toggle();
        })
        $('.bo_sch_bg, .bo_sch_cls').click(function(){
            $('.bo_sch_wrap').hide();
        });
    });
    </script>
    <!-- } 게시판 검색 끝 --> 
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });
});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
