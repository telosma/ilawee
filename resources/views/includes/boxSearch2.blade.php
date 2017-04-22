<div class="s4-wpcell-plain ms-webpartzone-cell ms-webpart-cell-vertical ms-fullWidth ">
<div class="ms-webpart-chrome ms-webpart-chrome-vertical ms-webpart-chrome-fullWidth">
    <div width="100%" class="ms-WPBody">
        <div class="box-container">
            <div class="box-search FormSimple">
                <div class="box-search-c">
                    <div class="title">
                        Tìm kiếm văn bản
                        <div class="right">
                            <a href="#" class="advance" id="timkiemdongian" >Tìm kiếm đơn giản</a>
                            <a href="#" class="simple" id="timkiemnangcao" >Tìm kiếm nâng cao</a>
                        </div>
                         <div style="float: right;display:none;" id="chonlai">
                             <a onclick="resetform();" id="resetForm" href="javascript:;" style="text-transform: none; font-weight: normal; text-decoration: underline; color: rgb(200, 26, 29); padding-right: 6px;"><span>Chọn lại điều kiện</span> </a>
                        </div>
                    </div>
                    {!! Form::open(['url' => '', 'method' => 'get']) !!}  {{-- 'route' => 'route.name' || 'action' => 'Controller@method'--}}
                        <ul>
                            <li>
                                {!! Form::label('Keyword', 'Từ khóa tìm kiếm') !!}
                                <div class="input">
                                    {!! Form::text('Keyword', 'Từ khóa tìm kiếm', [
                                        'data' => 'Từ khóa tìm kiếm',
                                        'onblur' => 'if(this.value=="") this.value="Từ khóa tìm kiếm";',
                                        'onfocus' => 'if(this.value=="Từ khóa tìm kiếm") this.value="";',
                                    ]) !!}
                                </div>

                            </li>
                            <li>
                                <div class="option">
                                    {!! Form::label('stemp', 'Chính xác cụm từ trên') !!}
                                    {!! Form::radio('stemp', '1', ['id' => 'oneAndAll']) !!}
                                    {!! Form::label('stemp', 'Có tất cả từ trên') !!}
                                    {!! Form::radio('stemp', '0', ['id' => 'oneOrAll']) !!}
                                </div>
                            </li>
                            <li>
                                <label>Tìm trong</label>
                                <div class="input">
                                    <input id="rdtoanvan" name="TimTrong1" type="radio" value="VBPQFulltext" />
                                    <span>Tất cả &nbsp;&nbsp;</span>
                                    <input id="rdtieude" name="TimTrong1" type="radio" value="Title" />
                                    <span>Tiêu đề</span>
                                    <input id="rdtrichyeu" name="TimTrong1" type="radio" value="Title1" checked="checked"/>
                                    <span>Trích yếu</span>
                                </div>
                            </li>
                            <li class="advance" id="LoaiVanBanDiv">
                                <label>Loại văn bản</label>
                                <div class="input">
                                    <select name="LoaiVanBan" id="LoaiVanBan" class="mutil" multiple="multiple">

                                        <option value="15" >
                                            Hiến pháp</option>

                                        <option value="16" >
                                            Bộ luật</option>

                                        <option value="17" >
                                            Luật</option>

                                        <option value="19" >
                                            Pháp lệnh</option>

                                        <option value="2" >
                                            Lệnh</option>

                                        <option value="18" >
                                            Nghị quyết</option>

                                        <option value="3" >
                                            Nghị quyết liên tịch</option>

                                        <option value="20" >
                                            Nghị định</option>

                                        <option value="21" >
                                            Quyết định</option>

                                        <option value="22" >
                                            Thông tư</option>

                                        <option value="23" >
                                            Thông tư liên tịch</option>

                                        <option value="24" >
                                            Chỉ thị</option>

                                    </select>
                                </div>
                            </li>
                            <li class="advance" id="CoQuanBanHanhDiv">
                                <label>
                                    Cơ quan ban hành</label>
                                <div class="input">

                                    <select name="CoQuanBanHanh" id="CoQuanBanHanh" class="mutil" multiple="multiple">

                                        <option value="469"  >
                                            Thủ tướng</option>

                                        <option value="456"  >
                                            Ủy ban Thường vụ Quốc hội</option>

                                        <option value="55"  >
                                            Quốc hội</option>

                                        <option value="54"  >
                                            Chủ tịch nước</option>

                                        <option value="1"  >
                                            Chính phủ</option>

                                        <option value="57"  >
                                            Thủ tướng Chính phủ</option>

                                        <optgroup label="Các Bộ, cơ quan ngang Bộ">

                                            <option  value="3">Bộ Công an</option>

                                            <option  value="170">Bộ Công Thương.</option>

                                            <option  value="13">Bộ Giáo dục và Đào tạo</option>

                                            <option  value="274">Bộ Giao thông vận tải</option>

                                            <option  value="17">Bộ Kế hoạch và Đầu tư</option>

                                            <option  value="14">Bộ Khoa học và Công nghệ</option>

                                            <option  value="19">Bộ Lao động - Thương binh và Xã hội</option>

                                            <option  value="23">Bộ Ngoại giao</option>

                                            <option  value="360">Bộ Nội vụ</option>

                                            <option  value="27">Bộ Nông nghiệp và Phát triển nông thôn</option>

                                            <option  value="31">Bộ Quốc phòng</option>

                                            <option  value="40">Bộ Tài chính</option>

                                            <option  value="41">Bộ Tài nguyên và Môi trường</option>

                                            <option  value="169">Bộ Thông tin và Truyền thông</option>

                                            <option  value="435">Bộ Văn hóa - Thể thao và Du lịch</option>

                                            <option  value="49">Bộ Xây dựng</option>

                                            <option  value="50">Bộ Y tế</option>

                                            <option  value="62">Ngân hàng Nhà nước</option>

                                            <option  value="61">Thanh tra Chính phủ</option>

                                            <option  value="64">Uỷ ban Dân tộc</option>

                                            <option  value="166">Văn phòng Chính phủ</option>

                                            <option disabled value="4">Bộ Công nghiệp</option>

                                            <option disabled value="6">Bộ Công nghiệp nặng</option>

                                            <option disabled value="7">Bộ Công nghiệp thực phẩm</option>

                                            <option disabled value="8">Bộ Cơ khí và luyện kim</option>

                                            <option disabled value="9">Bộ Giao thông và Bưu điện</option>

                                            <option disabled value="16">Bộ Kinh tế đối ngoại</option>

                                            <option disabled value="28">Bộ Năng lượng</option>

                                            <option disabled value="29">Bộ Nội thương</option>

                                            <option disabled value="32">Bộ Thuỷ lợi</option>

                                            <option disabled value="36">Bộ Thương binh và xã hội</option>

                                            <option disabled value="37">Bộ Thương mại</option>

                                            <option disabled value="43">Bộ Văn hoá</option>

                                            <option disabled value="45">Bộ Văn hoá và Thông tin</option>

                                            <option disabled value="46">Bộ Văn hoá, Thông tin và Thể thao</option>

                                            <option disabled value="51">Bộ Điện lực</option>

                                            <option disabled value="65">Uỷ ban Thể dục thể thao</option>

                                            <option disabled value="205">Ngân hàng Nhà nước Việt Nam</option>

                                            <option disabled value="53">Bộ Đại học, Trung học chuyên nghiệp và Dạy nghề</option>

                                            <option disabled value="52">Bộ Đại học và Trung học chuyên nghiệp</option>

                                            <option disabled value="63">Uỷ ban Dân số, Gia đình và Trẻ em</option>

                                            <option disabled value="47">Bộ Văn hoá, Thông tin, Thể thao và Du lịch</option>

                                            <option disabled value="44">Bộ Văn hoá - Thông tin</option>

                                            <option disabled value="38">Bộ Thương mại và Du lịch</option>

                                            <option disabled value="48">Bộ Vật tư</option>

                                            <option disabled value="39">Bộ Thương nghiệp</option>

                                            <option disabled value="33">Bộ Thuỷ lợi và Kiến trúc</option>

                                            <option disabled value="34">Bộ Thuỷ sản</option>

                                            <option disabled value="35">Bộ Thông tin</option>

                                            <option disabled value="15">Bộ Khoa học, Công nghệ và Môi trường</option>

                                            <option disabled value="11">Bộ Giao thông vận tải và Bưu điện</option>

                                            <option disabled value="2">Bộ Bưu chính, Viễn thông</option>

                                            <option disabled value="5">Bộ Công nghiệp nhẹ</option>

                                            <option disabled value="18">Bộ Lao động</option>

                                            <option disabled value="20">Bộ Lâm nghiệp</option>

                                            <option disabled value="22">Bộ Mỏ và Than</option>

                                            <option disabled value="24">Bộ Ngoại thương</option>

                                            <option disabled value="25">Bộ Nông nghiệp</option>

                                            <option disabled value="26">Bộ Nông nghiệp và Công nghiệp thực phẩm</option>

                                        </optgroup>
                                        <optgroup label="Các cơ quan khác">

                                            <option  value="60">Toà án nhân dân tối cao</option>

                                            <option  value="58">Viện kiểm sát nhân dân tối cao</option>

                                            <option  value="59">Kiểm toán Nhà nước</option>

                                            <option  value="159">Uỷ ban Trung ương Mặt trận Tổ quốc Việt Nam</option>

                                            <option  value="131">Tổng Liên đoàn Lao động Việt Nam</option>

                                            <option  value="111">Trung ương Đoàn thanh niên cộng sản Hồ Chí Minh</option>

                                            <option disabled value="100">Hội Nông dân Việt Nam</option>

                                            <option disabled value="98">Hội Liên hiệp phụ nữ Việt Nam</option>

                                            <option disabled value="177">Hội Cựu chiến binh Việt Nam</option>

                                        </optgroup>
                                    </select>

                                </div>
                            </li>

                            <li class="advance" id="TinhTrangHieuLucDiv">
                                <label>Tình trạng hiệu lực</label>
                                <div class="input">
                                    <select name="TrangThaiHieuLuc" id="TrangThaiHieuLuc" class="mutil" multiple="multiple">

                                        <option value="7">Ngưng hiệu lực một phần</option>

                                        <option value="6">Ngưng hiệu lực</option>

                                        <option value="5">Chưa xác định</option>

                                        <option value="4">Hết hiệu lực một phần</option>

                                        <option value="3">Hết hiệu lực toàn bộ</option>

                                        <option value="2">Còn hiệu lực</option>

                                        <option value="1">Chưa có hiệu lực</option>

                                    </select>
                                </div>
                            </li>
                            <li class="date">
                                <label>
                                    Thời gian ban hành</label>
                                <label class="fix">
                                    Từ ngày</label>
                                <div class="input">
                                    <input type="text" id="TuNgay" name="fromyear" class="datePicker" value="" />
                                </div>
                                <label class="fix">
                                    Đến ngày</label>
                                <div class="input" style="padding-right: 0px;">
                                    <input type="text" id="DenNgay" name="toyear" class="datePicker" value="" />
                                </div>
                            </li>
                            <li class="submit">
                                <label>
                                    Sắp xếp theo
                                </label>
                                <div class="input">
                                    <select name="order" id="order">
                                     <option value="VBPQNgayBanHanh" >
                                            Ngày ban hành</option>
                                        <option value="Rank" >Kết quả
                                            chính xác</option>
                                        <option value="VBPQNgaycohieuluc" >
                                            Ngày hiệu lực</option>

                                        <option value="VBPQNgayHetHieuLuc" >
                                            Ngày hết hiệu lực</option>

                                    </select>
                                </div>
                                <div class="input" style="width: 20%;">
                                    <select name="TypeOfOrder" id="TypeOfOrder">
                                      <option value="False"  selected>Mới đến cũ</option>
                                        <option value="True" >Cũ đến mới</option>

                                    </select>
                                </div>
                                <div class="input" style="width: 22%;">
                                    <a href="javascript:;" class="button" id="searchSubmit"><span>Tìm kiếm</span> </a>
                                </div>

                                <div class="input" style="width: 5px; padding-top: 3px;">
                                    <a href="javascript:;" rel="balloon1042">
                                        <img src="images/faq_question_icon.gif" />
                                    </a>
                                </div>
                                <div id="balloon1042" class="balloonstyle">
                                    <div>
                                        <b>C&aacute;ch thức t&igrave;m kiếm</b></div>
                                    <div>
                                        &nbsp;</div>
                                   <div>
                                      1. Nhập từ khóa cần tìm kiếm vào ô text "Từ khóa tìm kiếm"</div>
                                    <div>
                                        2. Lựa chọn một trong 2 option:</br>
                                        - Chính xác cụm từ trên: kết quả trả về chứa chính xác cụm từ được nhập theo đúng thứ tự hiển thị của các từ khóa</br>
                                        - Có tất cả từ trên: kết quả trả về chứa tất cả các từ trong cụm từ khóa, không quan tâm vị trí hiển thị
                                    </div>
                                    <div>
                                       3. Tìm trong: lựa chọn từ khóa cần tìm nằm trong thuộc tính nào của văn bản:</br>
                                        - Tiêu đề: bao gồm số ký hiệu và Loại văn bản
                                        </br>
                                        - Trích yếu: nội dung trích yếu của văn bản.
                                    </div>
                                    <div>
                                       4. Ngoài ra, có thể tìm kiếm theo nhiều tiêu chí hơn thông qua Tìm kiếm nâng cao.</div>
                                    <div>
                                        &nbsp;
                                    </div>
                                    <br />
                                </div>
                            </li>
                        </ul>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="ms-clear"></div>
    </div>
    <div class="ms-PartSpacingVertical"></div>
</div>
