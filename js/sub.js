const content_box = Array(

    ['강남구', '강동구', '강북구', '강서구', '관악구', '광진구', '구로구', '금천구', '노원구', '도봉구', '동대문구', '동작구', '마포구', '서대문구', '서초구', '성동구', '성북구', '송파구', '양천구', '영등포구', '용산구', '은평구', '종로구', '중구', '중랑구'],
    ['강서구', '금정구', '기장군', '남구', '동구', '동래구', '부산진구', '북구', '사상구', '사하구', '서구', '수영구', '연제구', '영도구', '중구', '해운대구'],
    ['남구', '달서구', '달성군', '동구', '북구', '서구', '수성구', '중구'],
    ['강화군', '계양구', '남동구', '동구', '미추홀구', '부평구', '서구', '연수구', '옹진군', '중구'],
    ['광산구', '남구', '동구', '북구', '서구'],
    ['대덕구', '동구', '서구', '유성구', '중구'],
    ['남구', '동구', '북구', '울주군', '중구'],
    [],
    ['가평군', '고양시', '고양시 덕양구', '고양시 일산동구', '고양시 일산서구', '과천시', '광명시', '광주시', '구리시', '군포시', '김포시', '남양주시', '동두천시', '부천시', '성남시', '성남시 분당구', '성남시 수정구', '성남시 중원구', '수원시', '수원시 권선구', '수원시 영통구', '수원시 장안구', '수원시 팔달구', '시흥시', '안산시', '안산시 단원구', '안산시 상록구', '안성시', '안양시', '안양시 동안구', '안양시 만안구', '양주시', '양평군', '여주시', '연천군', '오산시', '용인시', '용인시 기흥구', '용인시 수지구', '용인시 처인구', '의왕시', '의정부시', '이천시', '파주시', '평택시', '포천시', '하남시', '화성시'],
    ['강릉시', '고성군', '동해시', '삼척시', '속초시', '양구군', '양양군', '영월군', '원주시', '인제군', '정선군', '철원군', '춘천시', '태백시', '평창군', '홍천군', '화천군', '횡성군'],
    ['괴산군', '단양군', '보은군', '영동군', '옥천군', '음성군', '제천시', '증평군', '진천군', '청주시', '청주시 상당구', '청주시 서원구', '청주시 청원구', '청주시 흥덕구', '충주시'],
    ['계룡시', '공주시', '금산군', '논산시', '당진시', '보령시', '부여군', '서산시', '서천군', '아산시', '예산군', '천안시', '천안시 동남구', '천안시 서북구', '청양군', '태안군', '홍성군'],
    ['고창군', '군산시', '김제시', '남원시', '무주군', '부안군', '순창군', '완주군', '익산시', '임실군', '장수군', '전주시', '전주시 덕진구', '전주시 완산구', '정읍시', '진안군'],
    ['강진군', '고흥군', '곡성군', '광양시', '구례군', '나주시', '담양군', '목포시', '무안군', '보성군', '순천시', '신안군', '여수시', '영광군', '영암군', '완도군', '장성군', '장흥군', '진도군', '함평군', '해남군', '화순군'],
    ['경산시', '경주시', '고령군', '구미시', '군위군', '김천시', '문경시', '봉화군', '상주시', '성주군', '안동시', '영덕군', '영양군', '영주시', '영천시', '예천군', '울릉군', '울진군', '의성군', '청도군', '청송군', '칠곡군', '포항시', '포항시 남구', '포항시 북구'],
    ['거제시', '거창군', '고성군', '김해시', '남해군', '밀양시', '사천시', '산청군', '양산시', '의령군', '진주시', '창녕군', '창원시', '창원시 마산합포구', '창원시 마산회원구', '창원시 성산구', '창원시 의창구', '창원시 진해구', '통영시', '하동군', '함안군', '함양군', '합천군'
    ],
    ['서귀포시', '제주시']

);
const city_box = Array(
    ['서울'], ['부산'], ['대구'], ['인천'], ['광주'], ['대전'], ['울산'], ['세종'], ['경기'], ['강원'], ['충북'], ['충남'], ['전북'], ['전남'], ['경북'], ['경남'], ['제주']
)

function selectCity(prop) {
    setLocationInput(' '+prop.innerText);
    searchChurch();
};

function setLocationInput(keyword){
    document.getElementById('keyword2').value += keyword;
}

function selectArea(prop, sNum) {
    setLocationInput(prop.innerText);
    searchChurch();
    var str = "";
    for (var i = 0; i < content_box[sNum].length; i++) {
        str += "<li><a  onclick='selectCity(this)'>" + content_box[sNum][i] + "</a></li>";
    }

    $(".pop_box .area>ul").html(str);
};


$(function () {
    sub_top_visual_ini();
    tab_generator(".basic_tab_list", ".select_wrapper");
    file_ini();
    tab_ini();
    church_ini();
    church_ini2();
    img_ini();
})

const sub_top_visual_ini = function () {
    $('.visual .thumb').addClass('active');
}
const tab_generator = function (ul, select_wrapper) {
    $('<div class="' + select_wrapper.replace('.', "") + '"></div>').insertAfter($(ul));
    $(select_wrapper).html("<label></label><select></select>");
    $(select_wrapper + ' label').text($(ul + ' li.on').text());
    $(ul + ' li').each(function (e) {
        var link = $('> a', this).attr('href')
        var title = $('> a', this).text();
        if ($(this).hasClass('on')) {
            var selected = "selected ";
        } else {
            var selected = "";
        }
        $(select_wrapper + ' select').append("<option " + selected + " value='" + link + "'>" + title + "</option>");
    })
    $(select_wrapper + ' select').bind("change", function () {
        var link = $('option:selected', this).val();
        location.href = link;
    })
}
const file_ini = function () {
    $("#file").on('change', function () {
        var fileName = $("#file").val();
        $(".upload_name").val(fileName);
    });
}
const tab_ini = function () {
    $(".tab_btn>li").click(function () {
        var sNum = $(this).index();

        $(this).addClass("active").siblings().removeClass("active");
        $(".tab_cont>div").eq(sNum).addClass("on").siblings().removeClass("on");
    })
}
const church_ini = function () {
    $(".pop_box .menu li").click(function () {
        var sNum = $(this).index();
        $(this).addClass("active").siblings().removeClass("active");
    });
    $(".pop_box .tab1 .list>ul>li").click(function () {

        if ($(".pop_box .menu li:eq(0)").hasClass("active")) {
            $("section.church").addClass("a");
            $("section.church").removeClass("b");
            $(".map_init .row01 i").text("거점")
        } else {
            $(".map_init .row01 i").text("결연")
            $("section.church").addClass("b");
            $("section.church").removeClass("a");
        }
    });
    $(".map_init .row01 a").click(function () {
        $("section.church").removeClass("a");
        $("section.church").removeClass("b");
    });
}
const church_ini2 = function () {
    // $("section.church .tab_btn li").click(function () {
    //     var sNum = $(this).text();
    
    // });
    // $("section.church .pop_box .menu li").click(function () {
    //     var sNum = $(this).text();
    

    // });
    $("section.church .pop_box .area li").click(function () {
        var sTxt = $(this).text();
        var sNum = $(this).index();
        var str = "";
        searchChurch();
        setLocationInput(this.innerText);
        str = '<ul>';
        for (var i = 0; i < content_box[sNum].length; i++) {
            str += "<li><a  onclick='selectCity(this)'>" + content_box[sNum][i] + "</a></li>";
        }
        str = '</ul>';
        $(".pop_box .area").html(str);

    });

    $(".tab2 .search_form_v2 .back").click(function () {
        var str = "";
        document.getElementById('keyword2').value = '';
        str += "<ul>";
        for (var i = 0; i < 16; i++) {
            str += "<li><a  onclick='selectArea(this," + i + ")'>" + city_box[i] + "</a></li>";
        }
        str += "</ul>";
        $(".pop_box .area").html(str);
    });

    $(".tab2 .search_form_v2 .back1").click(function () {
        const input_text = document.getElementById('keyword2');
        const in_array = input_text.value.split(" ");
        var str = "";
        if(in_array.length == 1){
            document.getElementById('keyword2').value = '';
            str += "<ul>";
            for (var i = 0; i < 16; i++) {
                str += "<li><a  onclick='selectArea(this," + i + ")'>" + city_box[i] + "</a></li>";
            }
            str += "</ul>";
            
        }else{
            input_text.value = in_array[0];
            searchChurch();
            let num_index = -1;
            for (let index = 0; index < city_box.length; index++) {
                if(city_box[index][0]  == in_array[0]){
                    num_index = index;
                }
                
            }

            str = '<ul>';
            for (var i = 0; i < content_box[num_index].length; i++) {
                str += "<li><a  onclick='selectCity(this)'>" + content_box[num_index][i] + "</a></li>";
            }
            str += '</ul>';
        }
        
        $(".pop_box .area").html(str);
    });

}
const img_ini = function () {
    $(window).bind("resize", function () {
        if ($(this).width() < 768) {
            $(".r_img").attr("src", "/vision/include/images/sub/m_vision_img.svg");
            $(".r_img_v2").attr("src", "/vision/include/images/sub/m_vision_img2.svg");
        } else {
            $(".r_img").attr("src", "/vision/include/images/sub/vision_img.svg");
            $(".r_img_v2").attr("src", "/vision/include/images/sub/vision_img2.svg");
        }
    }).trigger("resize");
}


function clip(){
    var url = '';
	var textarea = document.createElement("textarea");
	document.body.appendChild(textarea);
	url = window.document.location.href;
	textarea.value = url;
	textarea.select();
	document.execCommand("copy");
	document.body.removeChild(textarea);
    alert('URL이 복사되었습니다.\n채팅방에 붙여 넣어 공유해 보세요.');
}