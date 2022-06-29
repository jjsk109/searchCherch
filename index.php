<? 
/**
 *  전체 중 교회찾기만 업로드 했습니다 
 *  나중에 필요할 것 같아서요 필기
 * 
 *  1. 지도 아이콘 넣기
 *  2. 리사이즈 센터
 *  3. 클릭 이동 
 *  4. 줌아웃 숫자 표시
 *  5. 
 * 
 */
include_once __DIR__ . "/../header.php"; 
?>
<section class="church">
    <div class="visual">
        <div class="thumb"></div>
        <div class="tit">
            <h2>교회찾기</h2>
            <p>
                교회찾기는 군선교를 통해 그리스도인이 된 전역 장병들이 파송될 교회를 쉽게 검색하여 알 수 있도록 만들어졌습니다
            </p>
        </div>
    </div>
    <div class="col01">
        <dl>
            <dt>거점</dt>
            <dd>거점교회는 청년 공동체와 전담 사역자가 있어 군선교 VISION2030 파송 사역에 동참할 강한 의지가 있는 교회를 지칭합니다.</dd>
        </dl>
        <dl>
            <dt>결연</dt>
            <dd>결연교회는 군선교연합회와 협력하여 군선교를 위해 기도와 물질로 지속적인 섬김을 하는 교회를 지칭합니다.</dd>
        </dl>
    </div>
    <div class="map_r">
        <div id="daumRoughmapContainer1652938770652" class="root_daum_roughmap root_daum_roughmap_landing">
            <div class="map_icon" id="map_icon">
               
            </div>
        </div>
        <div class="inner">
            <div class="pop_box">
                <ul class="menu">
                    <li class="active"><a onclick="changetCategory('C')">전체</a></li>
                    <li><a onclick="changetCategory('P')">거점</a></li>
                    <li><a onclick="changetCategory('A')">결연</a></li>
                </ul>
                <div class="basic_pop">
                    <ul class="tab_btn">
                        <li class="active"><a onclick="changetWay('S')">검색</a></li>
                        <li><a onclick="changetWay('L')">지역별</a></li>
                    </ul>
                    <div class="tab_cont">
                        <div class="tab1 on">
                            <div class="col_1">
                                <div class="search_form_v2">
                                    <input type="search" id='keyword' placeholder="교회명 또는 주소를 입력해주세요.">
                                    <a onclick="searchChurch()"></a>
                                </div>
                                <!-- <div class="result_v2" id="result_v2">
                                    <p>검색결과 <span>0</span> 건</p>
                                </div> -->
                                <div id='res'>
                                    <p class="memo">
                                        교회명 또는 주소를 입력해 <br> 교회를 검색해 보세요.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab2">
                            <div class="search_form_v2">
                                <input type="search" id='keyword2' value="" readonly placeholder="지역을 선택해주세요.">
                                <img class="back1" src="<?= $cfg['baseUrl'] ?>/images/sub/search_icon2.png">
                                <a class="back" class=""></a>
                            </div>
                            <div class="area" id="area">
                                <ul>
                                    <li>
                                        <a>서울</a>
                                    </li>
                                    <li>
                                        <a>부산</a>
                                    </li>
                                    <li>
                                        <a>대구</a>
                                    </li>
                                    <li>
                                        <a>인천</a>
                                    </li>
                                    <li>
                                        <a>광주</a>
                                    </li>
                                    <li>
                                        <a>대전</a>
                                    </li>
                                    <li>
                                        <a>울산</a>
                                    </li>
                                    <li>
                                        <a>세종</a>
                                    </li>
                                    <li>
                                        <a>경기</a>
                                    </li>
                                    <li>
                                        <a>강원</a>
                                    </li>
                                    <li>
                                        <a>충북</a>
                                    </li>
                                    <li>
                                        <a>충남</a>
                                    </li>
                                    <li>
                                        <a>전북</a>
                                    </li>
                                    <li>
                                        <a>전남</a>
                                    </li>
                                    <li>
                                        <a>경북</a>
                                    </li>
                                    <li>
                                        <a>경남</a>
                                    </li>
                                    <li>
                                        <a>제주</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <script charset="UTF-8">
        //검색에 필요한 거점 결연 설정 

        let o_h = 37.4981646510326; // 좌표 초기화 - 강남
        let o_w = 127.028307900881; // 좌표 초기화 - 강남
        let category = 'C';
        let category_arr = []; // 전체 검색 구분
        let imageSrc = "/vision/include/images/sub/map_icon2.svg"; // 거점 비활성화 아이콘
        let imageSrc2 = "/vision/include/images/sub/map_icon3.svg"; // 거점 활성화 아이콘
        let imageSrc3 = "/vision/include/images/sub/map_icon.svg"; // 결연 비활성화 아이콘
        let imageSrc4 = "/vision/include/images/sub/map_icon4.svg"; // 결연 활성화 아이콘
        let way = 'S';
        let markerImage = [];
        let clickImage = [];

        // 지도 중심 설정
        var clat = 37.4981646510326, // 좌표 초기화 - 강남
            clng = 127.028307900881; // 좌표 초기화 - 강남 // 기본값
        let markers = []; // 검색결과 마커 목록
        let info_window_arr = [];
        let mark_posiiton = 0.0005;
        let c_level = 6;
        let selectedMarker = null; // 클릭한 마커를 담을 변수

        // 지도 생성
        let mapContainer = document.getElementById('map_icon'); // 지도를 표시할 div
        let mapOption = {
            center: new kakao.maps.LatLng(clat, clng), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };
        let map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
        // 마커 클러스터러를 생성합니다 
        let clusterer = new kakao.maps.MarkerClusterer({
            map: map, // 마커들을 클러스터로 관리하고 표시할 지도 객체
            averageCenter: true, // 클러스터에 포함된 마커들의 평균 위치를 클러스터 마커 위치로 설정
            minLevel: 10, // 클러스터 할 최소 지도 레벨
            disableClickZoom: true // 클러스터 마커를 클릭했을 때 지도가 확대되지 않도록 설정한다
        });

        // 서치 방식 수정 검색 & 지역별
        function changetWay(c) {
            way = c;
            let str = '';
            document.getElementById('keyword2').value = '';
            document.getElementById('keyword').value = '';
            str += "<ul>";
            for (var i = 0; i < 16; i++) {
                str += "<li><a onclick='selectArea(this," + i + ")'>" + city_box[i] + "</a></li>";
            }
            str += "</ul>";
            $(".pop_box .area").html(str);

            let str2 = '';
            str2 += `   
            <div class="result_v2" id="result_v2">
                <p>검색결과 <span>0</span> 건</p>
            </div>
            <p class="memo">
                교회명 또는 주소를 입력해 <br> 교회를 검색해 보세요.
            </p>`;
            document.getElementById('res').innerHTML = str2;

            resetMarker(null);
            closeAllPopUp();
        }

        // 카테고리 변경 함수
        function changetCategory(c) {
            category = c;
            closeAllPopUp();
            searchChurch();
        }

        // 위치 이동
        function panTo(x, y) {
            // 이동할 위도 경도 위치를 생성합니다
            o_w = x;
            o_h = y;
            var moveLatLon = new kakao.maps.LatLng(y, x);

            // 지도 중심을 부드럽게 이동시킵니다
            // 만약 이동할 거리가 지도 화면보다 크면 부드러운 효과 없이 이동합니다
            map.setCenter(moveLatLon);
        }

        // 리스트 클릭 이벤트 > 무지성으로 개발함 ㅈㅅ
        function selectChurch(x, y, num) {
            closeAllPopUp();
            let ii = 0;
            const li_lists = document.getElementsByClassName('searchlist');
            markers.map((mrk) => {
                mrk.setImage(markerImage[ii]);
                const element = li_lists[ii];
                element.className = 'searchlist';
                mrk.setZIndex(0);
                ii++;
            })

            info_window_arr[num].open(map, markers[num]);
            markers[num].setImage(clickImage[num]);
            markers[num].setZIndex(1);
            map.setLevel(5); // 지도 레벨 설정
            panTo(x, y + mark_posiiton); // 이동 (확대와 순서바뀌면 정상 작동 안함)

            li_lists[num].className = 'searchlist active';
            if(window.innerWidth < 640){
                window.scrollTo({ left: 0, top: 400, behavior: "smooth" });
            }
        }

        // 교회 정보 팝업창 1개 닫기
        function closePopUp(num) {
            markers[num].setImage(markerImage[num]);
            info_window_arr[num].close();
            document.getElementsByClassName('searchlist')[num].className = 'searchlist';
        }
        // 교회 정보 팝업창 모두 닫기
        function closeAllPopUp() {
            info_window_arr.map((itm) => {
                itm.close();
            });
        }
        // 마커,clusterer 지우기 
        function resetMarker(map) {
            clusterer.removeMarker(markers);
            for (var i = 0; i < markers.length; i++) {
                clusterer.removeMarker(markers[i]);
                markers[i].setMap(map);
            }
        }

        function searchChurch(load = 0) {
            // 초기화 
            resetMarker(null);
            closeAllPopUp();
            
            info_window_arr = [];
            markers = [];
            category_arr = [];
            markerImage = [];
            clickImage = [];
         
            // 선언
            let positions = [];
            let id_list = [];
            let min_dir = 5000;
            let x = 0;
            let y = 0;
            let i = 0;
            let result_count = 0;
            let search = '';
            let city_count = 1;

            if (way == 'S') {
                search = document.getElementById('keyword').value;
                city_count = 2;
                c_level = 6;
            } else if (way == 'L') {
                search = document.getElementById('keyword2').value;
                const arr = search.split(" ");
                city_count = arr.length;
                if (city_count == 1) {
                    c_level = 8;
                } else {
                    c_level = 4;
                }
            }
            search = search.trim();
            const obj = {
                category,
                search,
                way,
            }
            if(load !== 1){
                if (!search) {
                    return false;
                }
            }

            $.ajax({
                type: 'post',
                async: false,
                url: `${window.location.origin}/vision/include/page/ajax/ajax.php`,
                data: obj,
                success: function(data) {
                    let map = '';
                    let json = jQuery.parseJSON(data);
                    result_count = json.length;
                    let str = `<div class="list"><div class="result_v2" id="result_v2"><p>검색결과 <span>${result_count}</span> 건</p></div><ul>`;

                    if (json.length > 0) {
                        json.map((church) => {
                            // 좌표 삽입
                            var pos = {
                                title: church.name,
                                latlng: new kakao.maps.LatLng(church.tmp8, church.tmp7),
                                address: church.tmp1,
                                phone: church.tmp2,
                                master: church.tmp3,
                                url: church.tmp4,
                                youtube: church.tmp5,
                                sendCount: church.tmp6,
                            };
                            if (i === 0 ) {
                                y = church.tmp8;
                                x = church.tmp7;
                            }

                            id_list.push({
                                x: church.tmp7,
                                y: church.tmp8
                            });

                            category_arr.push(church.category);

                            if (id_list.length > 1) {
                                dist = Math.sqrt(Math.abs(id_list[i - 1].x * id_list[i].x) + Math.abs(id_list[i - 1].y * id_list[i].y));
                                if (min_dir > dist) {
                                    min_dir = dist;
                                }
                            }

                            positions.push(pos);

                            str += `    <li class='searchlist' onclick="selectChurch(${church.tmp7},${church.tmp8},${i})">
                                            <h3>${church.name}</h3>
                                            <p>${church.tmp1}</p>
                                            <a href="tel:${church.tmp2}">${church.tmp2}</a>
                                        </li>`;
                            // str += ` <img class="icon1" src="<?= $cfg['baseUrl'] ?>/images/sub/map_icon.svg"  />`;
                            i++;
                        });
                    } else {
                        str += ` 
                        <p class="memo">
                            교회명 또는 주소를 입력해 <br> 교회를 검색해 보세요.
                        </p>`;
                    }
                    str += `</ul> </div>`;

                    if (city_count > 1 || search === '세종') {

                        //document.getElementsByClassName('tab2')[0].className = 'tab2 on';
                        if (way == 'S') {
                            document.getElementById('res').innerHTML = str;
                        } else {
                            document.getElementById('area').innerHTML = str;
                        }

                    }
                },
                error: function(data, status, err) {
                    console.error(data);
                    console.error(status);
                    console.error(err);
                    //lert("서버오류!");                
                }
            })


            if (result_count > 0) {

                // 마커 이미지의 이미지 크기 입니다
                let imageSize = new kakao.maps.Size(34, 39);
                c_level = 8;
                map.setLevel(c_level); // 지도 레벨 설정

                // 마커 이미지를 생성합니다
                let ii = 0;

                positions.map((postion) => {
                    let mm = undefined;
                    if (category_arr[ii] == 'P') {
                        markerImage.push(new kakao.maps.MarkerImage(imageSrc, imageSize));
                        clickImage.push(new kakao.maps.MarkerImage(imageSrc2, imageSize));
                        mm = new kakao.maps.MarkerImage(imageSrc, imageSize);
                    } else {
                        markerImage.push(new kakao.maps.MarkerImage(imageSrc3, imageSize));
                        clickImage.push(new kakao.maps.MarkerImage(imageSrc4, imageSize));
                        mm = new kakao.maps.MarkerImage(imageSrc3, imageSize);

                    }

                    // 마커를 생성합니다
                    var marker = new kakao.maps.Marker({
                        map: map, // 마커를 표시할 지도
                        position: postion.latlng, // 마커를 표시할 위치
                        title: postion.title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
                        image: mm // 마커 이미지
                    });

                    marker.setMap(map);
                    markers.push(marker);

                    var iwContent = ` 
                        <div class="comment">
                            <div class="row01">
                                ${category_arr[ii]  == 'P'? "<i>거점</i>": "<i class='se'>결연</i>"}
                                <span>${postion.title}</span>
                                <a class='close_' onclick='closePopUp(${ii})'></a>
                            </div>
                            <div class="row02">
                                ${postion.address? `<dl><dt>교회주소</dt><dd>${postion.address}</dd></dl>`:''}
                                ${postion.master? `<dl><dt>담당</dt><dd>${postion.master}</dd></dl>`:''}
                                ${postion.phone? `<dl><dt>전화번호</dt><dd><a href="tel:${postion.phone}"> ${postion.phone}</a></dd></dl>`:''}
                                ${postion.url? `<dl><dt>홈페이지</dt><dd><a href="${postion.url}" target="_blank">${postion.url}</a></dd></dl>`:''}
                                ${postion.youtube ? `<dl><dt>유튜브</dt><dd><a href="${postion.youtube}" target="_blank">${postion.youtube}</a></dd></dl>` : ''}
                                ${postion.sendCount != 0 ? `  <dl><dt>군인교회 파송수</dt><dd>${postion.sendCount}</dd></dl>` :""}
                            </div>
                        </div>`; // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다

                    iwPosition = new kakao.maps.LatLng(postion.latlng.La, postion.latlng.Ma + mark_posiiton); //인포윈도우 표시 위치입니다



                    iwRemoveable = true;
                    // 인포윈도우를 생성합니다
                    var infowindow = new kakao.maps.InfoWindow({
                        position: iwPosition,
                        content: iwContent,

                    });
                    infowindow.setZIndex(1);
                    info_window_arr.push(infowindow);
                    kakao.maps.event.addListener(marker, 'click', function() {
                        // 닫기 이미지 처음으로  
                        const li_lists = document.getElementsByClassName('searchlist');
                        const list_tag = document.getElementsByClassName('list')[0];

                        closeAllPopUp();
                        let ij = 0;

                        markers.map((mark) => {
                            if (mark.Gb == marker.Gb) {
                                if (li_lists[ij] !== undefined) {
                                    li_lists[ij].className = 'searchlist active';
                                    const li_hight = li_lists[ij].clientHeight * ij;
                                    list_tag.scrollTo({
                                        left: 0,
                                        top: li_hight,
                                        behavior: "smooth"
                                    });
                                }
                                marker.setImage(clickImage[ij]);
                                mark.setZIndex(1);
                            } else {
                                if (li_lists[ij] !== undefined) {
                                    li_lists[ij].className = 'searchlist';
                                }
                                mark.setImage(markerImage[ij]);
                                mark.setZIndex(0);
                            }
                            ij++;
                        })

                        panTo(postion.latlng.La, postion.latlng.Ma + mark_posiiton);
                        infowindow.open(map, marker);

                    }); // 클릭 이벤트 생성


                    kakao.maps.event.addListener(marker, 'touch', function() {
                        markers.map((mak) => {
                            infowindow.close(map, mak);
                        })
                        panTo(postion.latlng.La, postion.latlng.Ma + mark_posiiton);
                        infowindow.open(map, marker);
                    }); // 클릭 이벤트 생성
                    ii++;
                });

                // clusterer 추가 작업 줌아웃을 했을 때 지도에 숫자로 표시 되는 곳
                clusterer.addMarkers(markers);
                kakao.maps.event.addListener(clusterer, 'clusterclick', function(cluster) {
                    // 현재 지도 레벨에서 1레벨 확대한 레벨                    
                    var level = map.getLevel() - 1;

                    // 지도를 클릭된 클러스터의 마커의 위치를 기준으로 확대합니다
                    map.setLevel(level, {
                        anchor: cluster.getCenter()
                    });
                    closeAllPopUp();

                    let ij = 0;
                    markers.map((mark) => {
                        if (li_lists[ij] !== undefined) {
                                li_lists[ij].className = 'searchlist';
                            }
                            mark.setImage(markerImage[ij]);
                            mark.setZIndex(0);
                        ij++;
                    })
                });
                
                if(load === 1){
                    panTo(o_w,o_h)
                }else{
                    panTo(x, y); // 이동 (확대와 순서바뀌면 정상 작동 안함)
                }
            }

        }
        window.onload = () => {
            let w = window.innerWidth;
            let h = window.innerHeight;
            if (w < 1150) {
                mark_posiiton = -0.0002;
            }
            if (w < 600) {
                mark_posiiton = 0.005;
            }

            window.addEventListener('resize', function(event) {
                w = window.innerWidth;
                h = window.innerHeight;

                if (w < 1150) {
                    mark_posiiton = -0.0002;
                } else {
                    mark_posiiton = 0.0005;
                }
                if (w < 600) {
                    mark_posiiton = 0.005;
                }
                map.relayout();
                let moveLatLon = new kakao.maps.LatLng(o_h, o_w);
                map.setCenter(moveLatLon);
            });

            document.getElementById('keyword').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchChurch();
                }
            })
            searchChurch(1);
        }
    </script>
</section>

<? include_once __DIR__ . "/../footer.php"; ?>